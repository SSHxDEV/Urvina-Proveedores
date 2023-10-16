<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use PhpCfdi\SatEstadoCfdi\Soap\SoapConsumerClient;
use PhpCfdi\SatEstadoCfdi\Soap\SoapClientFactory;
use PhpCfdi\SatEstadoCfdi\Consumer;
use ZipArchive;
use Jenssegers\Date\Date;
use Carbon\Carbon;
use DateTime;

class SupervisionController extends Controller
{
    public function Lista($language, $receptor){
        session_start();
        if($receptor == "USI"){
            Date::setLocale('es');
            $data=array();
                $facturas = DB::select("SELECT * from PRVfacturas where receptor='USI970814616'");
                foreach ($facturas as $factura) {
                    $ModFecha = Date::parse($factura->fecha_modificacion);
                    $IngFecha = Date::parse($factura->fecha_ingreso);
                    $IFecha = $IngFecha->format('l, j F Y H:i:s');
                    $MFecha = $ModFecha->format('l, j F Y H:i:s');
                    $factura->IFecha = $IFecha;
                    $factura->MFecha = $MFecha;
                    array_push($data, $factura);
                }
            return view('supervision.consulta')->with('data', $data)->with('receptor',$receptor);
        }
        if($receptor == "COELI"){
            $data=array();
                $facturas = DB::select("SELECT * from PRVfacturas where receptor='CME980528JB6'");
                foreach ($facturas as $factura) {
                    $ModFecha = Date::parse($factura->fecha_modificacion);
                    $IngFecha = Date::parse($factura->fecha_ingreso);
                    $IFecha = $IngFecha->format('l, j F Y H:i:s');
                    $MFecha = $ModFecha->format('l, j F Y H:i:s');
                    $factura->IFecha = $IFecha;
                    $factura->MFecha = $MFecha;
                    array_push($data, $factura);
                }
            return view('supervision.consulta')->with('data', $data)->with('receptor',$receptor);
        }
        return redirect()->route('home', app()->getLocale());
    }

    public function proveedores($language, $receptor){
        session_start();
        if($receptor == "USI"){
            Date::setLocale('es');
                $data=array();
                $proveedores = DB::select("SELECT * from PRVfacturas where receptor='USI970814616'");
                $usuariosAgregados = array();
                foreach ($proveedores as $proveedor) {
                    $ID_usuario = $proveedor->ID_usuario;


                    // Verificar si el ID_usuario ya se ha agregado
                    if (!in_array($ID_usuario, $usuariosAgregados)) {
                        $Usuario = DB::select("SELECT * from PRVusuarios where ID=$ID_usuario");

                        foreach($Usuario as $user){
                            $ModFecha = Date::parse($user->fecha_modificacion);
                            $IngFecha = Date::parse($user->fecha_ingreso);
                            $FechaI = $IngFecha->format('l, j F Y H:i:s');
                            $FechaM = $ModFecha->format('l, j F Y H:i:s');
                        }
                        $proveedor->Usuario = $Usuario;
                        $proveedor->FechaI = $FechaI;
                        $proveedor->FechaM = $FechaM;

                        // Agregar el ID_usuario al arreglo de usuarios agregados
                        array_push($usuariosAgregados, $ID_usuario);

                        // Agregar la factura al arreglo de datos
                        array_push($data, $proveedor);
                    }
                }
            return view('supervision.proveedores')->with('data', $data)->with('receptor',$receptor);
        }
        if($receptor == "COELI"){
                $data=array();
                $proveedores = DB::select("SELECT * from PRVfacturas where receptor='CME980528JB6'");
                $usuariosAgregados = array();

                foreach ($proveedores as $proveedor) {
                    $ID_usuario = $proveedor->ID_usuario;


                    // Verificar si el ID_usuario ya se ha agregado
                    if (!in_array($ID_usuario, $usuariosAgregados)) {
                        $Usuario = DB::select("SELECT * from PRVusuarios where ID=$ID_usuario");

                        foreach($Usuario as $user){
                            $ModFecha = Date::parse($user->fecha_modificacion);
                            $IngFecha = Date::parse($user->fecha_ingreso);
                            $FechaI = $IngFecha->format('l, j F Y H:i:s');
                            $FechaM = $ModFecha->format('l, j F Y H:i:s');
                        }
                        $proveedor->Usuario = $Usuario;
                        $proveedor->FechaI = $FechaI;
                        $proveedor->FechaM = $FechaM;

                        // Agregar el ID_usuario al arreglo de usuarios agregados
                        array_push($usuariosAgregados, $ID_usuario);

                        // Agregar la factura al arreglo de datos
                        array_push($data, $proveedor);
                    }
                }

            return view('supervision.proveedores')->with('data', $data)->with('receptor',$receptor);
        }
        return redirect()->route('home', app()->getLocale());

    }

    public function ShowUserListBill($language, $IdUser){
        session_start();
        Date::setLocale('es');
            $data=array();
                $facturas = DB::select("SELECT * from PRVfacturas where ID_usuario=$IdUser");
                foreach ($facturas as $factura) {
                    $ModFecha = Date::parse($factura->fecha_modificacion);
                    $IngFecha = Date::parse($factura->fecha_ingreso);
                    $IFecha = $IngFecha->format('l, j F Y H:i:s');
                    $MFecha = $ModFecha->format('l, j F Y H:i:s');
                    $factura->IFecha = $IFecha;
                    $factura->MFecha = $MFecha;
                    array_push($data, $factura);
                }
            return view('supervision.consulta')->with('data', $data);
    }

    public function SupShowFactura($language, $IdFactura){
        session_start();
        Date::setLocale('es');
        if(isset($_SESSION['usuario'])){
            if(isset($_SESSION['usuario'])){
                $data=array();
                $facturas = DB::select("SELECT TOP 1 * FROM PRVfacturas WHERE ID = $IdFactura");
                foreach ($facturas as $factura) {
                    $ModFecha = Date::parse($factura->fecha_modificacion);
                    $IngFecha = Date::parse($factura->fecha_ingreso);
                    // Utiliza una expresión regular para extraer el número de días
                    if (preg_match('/(\d+) DIAS/', $factura->CondicionesDePago, $matches)) {
                        $numeroDeDias = $matches[1];
                    } else {
                        $numeroDeDias = 'No es posible calcular';
                    }
                    $FechaFactura = Date::parse($factura->fechaFactura);
                    $FechaFactura->add($numeroDeDias.' day');
                    $formatFF= $FechaFactura->format('l, j F Y');
                    $IFecha = $IngFecha->format('l, j F Y H:i:s');
                    $MFecha = $ModFecha->format('l, j F Y H:i:s');
                    $factura->IFecha = $IFecha;
                    $factura->MFecha = $MFecha;
                    $factura->Vencimiento = $formatFF;
                    array_push($data, $factura);
                }
            }
        return view('supervision.detalles-factura')->with('data',$data);
        }else {
            return redirect()->route('login', app()->getLocale());
        }

    }

    public function UploadFaltante(Request $request){
        session_start();
        if(isset($_SESSION['usuario'])){

                $qfactura = DB::select("SELECT TOP 1 * FROM PRVfacturas WHERE  ID = {$request->factura}");
                $factura = $qfactura[0];
                $targetDir = 'E:\PRV/'.$factura->receptor.'/'.$factura->emisor.'/';
                $targetFile = '';
                $publicFile = '';
                $uploadOk = 1;




                // Si no hay problemas, mover el archivo a la carpeta "facturas"

                    if(isset($request->PDFsello)){


                        $nombrePDF = $_FILES['PDFsello']['name'];


                        $fileType = strtolower(pathinfo($nombrePDF, PATHINFO_EXTENSION));

                        $targetFile = $targetDir . $nombrePDF;

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

                        if($nombrePDF == $factura->factura.'.pdf'){
                            $nombreArchivo = 'T31.pdf'; // Reemplaza con tu cadena variable que contiene el nombre del archivo

                        // Quita la extensión ".pdf" de la cadena
                        $nombreArchivoSinExtension = str_replace('.pdf', '', $nombreArchivo);
                        move_uploaded_file($_FILES["PDFsello"]["tmp_name"], $targetFile);
                        DB::table('PRVfacturas')->where('factura',$factura->factura)->update(array('PDFsello'=>$nombreArchivoSinExtension, 'descripcion'=>'Revision de Entrada de Compra',));
                        }
                        Alert::success(__('El archivo se subio correctamente.'), __('Su archivo PDF sera revisado.'));
                        return redirect()->back();
                    }

        }else {
            return redirect()->route('login', app()->getLocale());
        }




    }

    public function DeleteFactura($language, $IdFactura){
        session_start();
        if($_SESSION['usuario']->rol == 'finanzas'){
         $factura = DB::delete("DELETE FROM PRVfacturas WHERE ID = $IdFactura");
        }
        return redirect()->back();
    }

    public function actualizarEstatus(Request $request)
    {


        // Aquí debes escribir la lógica para actualizar el campo Cambio de Estatus en tu modelo

        // Por ejemplo, suponiendo que tienes un modelo llamado 'TuModelo':
        DB::table('PRVfacturas')->where('ID', $request->id)->update(['estatus'=>$request->estatus,'descripcion'=>'Aceptado y aprobado','errores'=>NULL]);
        return response()->json('Estatus actualizado');
    }
}
