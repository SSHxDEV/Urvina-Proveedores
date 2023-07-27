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

}
