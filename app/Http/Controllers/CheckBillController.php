<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use RealRashid\SweetAlert\Facades\Alert;

class CheckBillController extends Controller
{
    public function DocsView(){
        return view('facturas.consulta.docs-view');
    }

    public function Lista(){
        session_start();
        if(isset($_SESSION['usuario'])){
            if(isset($_SESSION['usuario'])){
                $data=array();
                $facturas = DB::select("SELECT * FROM PRVfacturas WHERE ID_usuario = {$_SESSION['usuario']->ID}");
                foreach ($facturas as $factura) {
                    $ModFecha = Date::parse($factura->fecha_modificacion);
                    $IngFecha = Date::parse($factura->fecha_ingreso);
                    $IFecha = $IngFecha->format('l, j F Y H:i:s');
                    $MFecha = $ModFecha->format('l, j F Y H:i:s');
                    $factura->IFecha = $IFecha;
                    $factura->MFecha = $MFecha;
                    array_push($data, $factura);
                }


            }
        return view('facturas.consulta.factura-list')->with('data',$data);
        }else {
            return redirect()->route('login', app()->getLocale());
        }
    }

    public function ShowFactura($language, $factura){
        session_start();
        if(isset($_SESSION['usuario'])){
            if(isset($_SESSION['usuario'])){
                $data=array();
                $facturas = DB::select("SELECT TOP 1 * FROM PRVfacturas WHERE ID_usuario = {$_SESSION['usuario']->ID} AND ID = {$factura}");
                foreach ($facturas as $factura) {
                    $ModFecha = Date::parse($factura->fecha_modificacion);
                    $IngFecha = Date::parse($factura->fecha_ingreso);
                    $IFecha = $IngFecha->format('l, j F Y H:i:s');
                    $MFecha = $ModFecha->format('l, j F Y H:i:s');
                    $factura->IFecha = $IFecha;
                    $factura->MFecha = $MFecha;
                    array_push($data, $factura);
                }
            }
        return view('facturas.consulta.factura-show')->with('data',$data);
        }else {
            return redirect()->route('login', app()->getLocale());
        }

    }

    public function UploadFaltante(Request $request){
        session_start();
        if(isset($_SESSION['usuario'])){

                $qfactura = DB::select("SELECT TOP 1 * FROM PRVfacturas WHERE ID_usuario = {$_SESSION['usuario']->ID} AND ID = {$request->factura}");
                $factura = $qfactura[0];
                $PublicDir = 'facturas/'.$_SESSION['usuario']->RFC.'/';
                $targetDir = 'E:\PRV/'.$_SESSION['usuario']->RFC.'/';
                $targetFile = '';
                $publicFile = '';
                $uploadOk = 1;




                // Si no hay problemas, mover el archivo a la carpeta "facturas"

                    if(isset($request->PDFsello)){


                        $nombrePDF = $_FILES['PDFsello']['name'];
                        $nombre_archivo = preg_replace('/[^A-Za-z0-9\-]/', '', pathinfo($nombrePDF, PATHINFO_FILENAME)); // Elimina caracteres no deseados
                        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
                        $targetFile = $targetDir . $nombre_archivo . $fileType;
                        $publicFile = $PublicDir . $nombre_archivo . $fileType;
                        // Verificar si es un archivo PDF
                        if ($fileType != "pdf") {
                            Alert::error(__('Archivo invalido'), __('Solo se aceptan archivos PDF'));
                            return redirect()->back();
                        }
                        // Verificar si el archivo ya existe
                        if (file_exists($targetFile)) {
                            Alert::error(__('Factura Repetida'), __('Esta factura ya ha sido subida anteriormente'));
                            return redirect()->back();
                        }
                        if (file_exists($publicFile)) {
                            Alert::error(__('Factura Repetida'), __('Esta factura ya ha sido subida anteriormente'));
                            return redirect()->back();
                        }

                        // Verificar el tamaño máximo del archivo (opcional)
                        if ($_FILES["PDFsello"]["size"] > 5242880) { // 5 MB (puedes ajustar este valor)
                            Alert::error(__('El archivo es demasiado grande.'), __('El tamaño máximo permitido es de 5 MB.'));
                            return redirect()->back();
                        }
                        if($nombre_archivo !== $factura->PDF){
                        move_uploaded_file($_FILES["PDFsello"]["tmp_name"], $targetFile);
                        move_uploaded_file($_FILES["PDFsello"]["tmp_name"], $publicFile);
                        DB::table('PRVfacturas')->where('factura',$factura->factura)->update(array('PDFsello'=>$nombre_archivo, 'descripcion'=>'Subido Exitosamente',));
                        }
                        Alert::success(__('El archivo se subio correctamente.'), __('Su archivo PDF sera revisado.'));
                        return redirect()->back();
                    }
                    if(isset($request->PDF)){

                        $nombrePDF = $_FILES['PDF']['name'];
                        $nombre_archivo = preg_replace('/[^A-Za-z0-9\-]/', '', pathinfo($nombrePDF, PATHINFO_FILENAME)); // Elimina caracteres no deseados
                        $fileType = strtolower(pathinfo($nombrePDF, PATHINFO_EXTENSION));
                        $targetFile = $targetDir . $nombre_archivo . $fileType;
                        $publicFile = $PublicDir . $nombre_archivo . $fileType;
                        // Verificar si es un archivo PDF
                        if ($fileType != "pdf") {
                            Alert::error(__('Archivo invalido'), __('Solo se aceptan archivos PDF'));
                            return redirect()->back();
                        }
                        // Verificar si el archivo ya existe
                        if (file_exists($targetFile)) {
                            Alert::error(__('Factura Repetida'), __('Esta factura ya ha sido subida anteriormente'));
                            return redirect()->back();
                        }
                        if (file_exists($publicFile)) {
                            Alert::error(__('Factura Repetida'), __('Esta factura ya ha sido subida anteriormente'));
                            return redirect()->back();
                        }
                        // Verificar el tamaño máximo del archivo (opcional)
                        if ($_FILES["PDF"]["size"] > 5242880) { // 5 MB (puedes ajustar este valor)
                            Alert::error(__('El archivo es demasiado grande.'), __('El tamaño máximo permitido es de 5 MB.'));
                            return redirect()->back();
                        }
                        if($nombre_archivo == $factura->factura){

                            move_uploaded_file($_FILES["PDF"]["tmp_name"], $targetFile);
                            move_uploaded_file($_FILES["PDF"]["tmp_name"], $publicFile);
                            DB::table('PRVfacturas')->where('factura',$factura->factura)->update(array('PDFsello'=>$nombre_archivo,'descripcion'=>'Subido Exitosamente',));

                        }
                        Alert::success(__('El archivo se subio correctamente.'), __('Su PDF sellado sera revisado.'));
                        return redirect()->back();

                    }




        }else {
            return redirect()->route('login', app()->getLocale());
        }


    }

    public function AddBuyOrder(Request $request){
        //LINK XML $rutaArchivo = 'E:\PRV/'.$receptor.'/'.$emisor.'/'.$nombreArchivo.'.xml';
    $xml = simplexml_load_file('E:\PRV/'.$request->receptoroc.'/'.$request->emisoroc.'/'.$request->facturaoc.'.xml');

    $ns = $xml->getNamespaces(true);
    $xml->registerXPathNamespace('c', $ns['cfdi']);
    $xml->registerXPathNamespace('t', $ns['tfd']);
    // DATOS FACTURA OBTENIDA DE BD
    $costos = DB::select("SELECT costo from compratcalc where mov='Entrada Compra' and movid= '$request->OrdenCompra'");
    $importes = DB::select("SELECT importe from compratcalc where mov='Entrada Compra' and movid= '$request->OrdenCompra'");
    $cantidades = DB::select("SELECT cantidad from compratcalc where mov='Entrada Compra' and movid= '$request->OrdenCompra'");
                    // Confirmar que hay registros de Entrada de compra
                    if(count($costos)==0){
                        $errorinfo = 'Error : No se encuentra la entrada de compra';
                        DB::table('PRVfacturas')
                        ->where('ID', $request->registroid)
                        ->update(['OrdenCompra' => $request->OrdenCompra, 'descripcion' => 'Agregue Orden de Compra', 'errores'=>$errorinfo]);
                        Alert::error(__($errorinfo), __('Asegúrese de que la entrada sea correcta o intente nuevamente en otro momento'));
                        return redirect()->back();
                    }

                    // Array de XML Costos
                    $valorUArray = [];
                    foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Conceptos//cfdi:Concepto') as $Concepto) {
                        $valorUArray[] = (string)$Concepto['ValorUnitario'];
                    }

                    // Array de BD Costos
                    $costosArray = [];
                    foreach ($costos as $costo) {
                        $costosArray[] = number_format($costo->costo, 2, '.', '');
                    }

                    // Comparar valores, sin orden especifico
                    $excluded_costo = array_diff($valorUArray, $costosArray);
                    $excluded_costo = implode(', ', $excluded_costo);

                    // Imprimir comprobacion
                    if (!empty($excluded_costo)) {
                        $errorinfo = 'Los valores unitarios no coinciden en Orden de Compra | Datos incorrectos: '.$excluded_costo;
                        DB::table('PRVfacturas')
                        ->where('ID', $request->registroid)
                        ->update(['OrdenCompra' => $request->OrdenCompra, 'descripcion' => 'Agregue Orden de Compra', 'errores'=>$errorinfo]);
                        Alert::error(__('Los valores unitarios no coinciden en Orden de Compra'), __('Datos incorrectos: '.$excluded_costo));
                        return redirect()->back();
                    }

                    // Array de XML Importes
                    $valorIArray = [];
                    foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Conceptos//cfdi:Concepto') as $Concepto) {
                        $valorIArray[] = (string)$Concepto['Importe'];
                    }

                    // Array de BD Importes
                    $importeArray = [];
                    foreach ($importes as $importe) {
                        $importeArray[] = number_format($importe->importe, 2, '.', '');
                    }

                    // Comparar valores, sin orden especifico
                    $excluded_importe = array_diff($valorIArray, $importeArray);
                    $excluded_importe = implode(', ', $excluded_importe);

                    // Imprimir comprobacion
                    if (!empty($excluded_importe)) {
                        $errorinfo = 'Los importes no coinciden en Orden de Compra | Datos incorrectos: '.$excluded_importe;
                        DB::table('PRVfacturas')
                        ->where('ID', $request->registroid)
                        ->update(['OrdenCompra' => $request->OrdenCompra, 'descripcion' => 'Agregue Orden de Compra', 'errores'=>$errorinfo]);
                        Alert::error(__('Los importes no coinciden en Orden de Compra'), __('Datos incorrectos: '.$excluded_importe));
                        return redirect()->back();
                    }

                    // Array de XML Cantidades
                    $valorCArray = [];
                    foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Conceptos//cfdi:Concepto') as $Concepto) {
                        $valorCArray[] = (string)$Concepto['Cantidad'];;
                    }

                    // Array de BD Cantidades
                    $cantidadArray = [];
                    foreach ($cantidades as $cantidad) {
                        $cantidadArray[] = number_format($cantidad->cantidad, 2, '.', '');
                    }

                    // Comparar valores, sin orden especifico
                    $excluded_cantidad = array_diff($valorCArray, $cantidadArray);
                    $excluded_cantidad = implode(', ', $excluded_cantidad);

                    // Imprimir comprobacion
                    if (!empty($excluded_cantidad)) {
                        $errorinfo = 'Las cantidades no coinciden en Orden de Compra | Datos incorrectos: '.$excluded_cantidad;
                        DB::table('PRVfacturas')
                        ->where('ID', $request->registroid)
                        ->update(['OrdenCompra' => $request->OrdenCompra, 'descripcion' => 'Agregue Orden de Compra', 'errores'=>$errorinfo]);
                        Alert::error(__('Las cantidades no coinciden en Orden de Compra'), __('Datos incorrectos: '.$excluded_cantidad));
                        return redirect()->back();
                    }


        // Actualizar el campo OrdenCompra en la base de datos con el valor enviado desde el formulario
        $estatus="Aceptado";
        DB::table('PRVfacturas')
        ->where('ID', $request->registroid)
        ->update(['OrdenCompra' => $request->OrdenCompra, 'descripcion' => 'Subido Exitosamente', 'errores'=>'', 'estatus'=>$estatus]);

        Alert::success(__('Registrado correctamente.'), __('Se ha registrado su Orden de Compra.'));
        return redirect()->route('facturas-list', app()->getLocale());

    }
    // Cron Job de Entradas de Compra (Actualiza los campos verificando facturas y la base de datos)
    public function CronJobFEC(){
        // Listar facturas con estado de Vigente

    }

}
