<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use PhpCfdi\SatEstadoCfdi\Soap\SoapConsumerClient;
use PhpCfdi\SatEstadoCfdi\Soap\SoapClientFactory;
use PhpCfdi\SatEstadoCfdi\Consumer;
use ZipArchive;

class ValidadorController extends Controller
{
    public function Form(){
        session_start();
        if(isset($_SESSION['usuario'])){
            if(isset($_SESSION['usuario'])){

            }
        return view('facturas.factura-indiv.form');
    }else {
        return redirect()->route('login', app()->getLocale());
    }
    }
    public function FormZip(){
        session_start();
        if(isset($_SESSION['usuario'])){
            if(isset($_SESSION['usuario'])){

            }
        return view('facturas.factura-zip.form');
    }else {
        return redirect()->route('login', app()->getLocale());
    }
    }
    public function Individual(){
        if(isset($_FILES['xmlFile']) && $_FILES['xmlFile']['error'] === UPLOAD_ERR_OK) {
        $xmlContent = file_get_contents($_FILES['xmlFile']['tmp_name']);
        $xml = simplexml_load_string($xmlContent);
        $ns = $xml->getNamespaces(true);
        if( isset($ns['cfdi'])){
        $xml->registerXPathNamespace('c', $ns['cfdi']);
        $xml->registerXPathNamespace('t', $ns['tfd']);
        $uuid='';
        $emisor='';
        $receptor='';
        $total='';
        $sello='';

        //EMPIEZO A LEER LA INFORMACION DEL CFDI E IMPRIMIRLA
        foreach ($xml->xpath('//cfdi:Comprobante') as $cfdiComprobante){
            $total= (string)$cfdiComprobante['Total'];
        }
        foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Emisor') as $Emisor){
        $emisor= (string)$Emisor['Rfc'];
        }

        foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Receptor') as $Receptor){
        $receptor= (string)$Receptor['Rfc'];

        }

        //ESTA ULTIMA PARTE ES LA QUE GENERABA EL ERROR
        foreach ($xml->xpath('//t:TimbreFiscalDigital') as $tfd) {
        $sello= (string)$tfd['SelloCFD'];
        $uuid= (string)$tfd['UUID'];
        }

        $udsello=substr($sello,-8);

        // creamos la fábrica dándole los parámetros de los objetos \SoapClient que fabricará
        $factory = new SoapClientFactory([
            'user_agent' => 'Mozilla/5.0 (X11; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0'
        ]);

        // le pasamos la fábrical al cliente
        $client = new SoapConsumerClient($factory);

        // creamos el consumidor del servicio para poder hacer las consultas
        $consumer = new Consumer($client);

        // consumimos el webservice!
        $response = $consumer->execute('https://verificacfdi.facturaelectronica.sat.gob.mx/default.aspx?&id='.$uuid.'&re='.$emisor.'&rr='.$receptor.'&tt='.$total.'&fe='.$udsello);
        $encontrada = (string)$response->document();
        if(str_contains($encontrada, "found")){
            return view('facturas.factura-indiv.confirmacion')->with('response',$response)->with('uuid',$uuid)->with('emisor',$emisor)->with('receptor',$receptor)->with('total',$total);
         }

         Alert::error(__('No se encontro'), __('Su factura no es valida para este portal'));



    } else{
        Alert::error(__('No es una factura valida'), __('Su factura no es valida para este portal'));
        return redirect()->back();
    }
    return view('facturas.factura-indiv.confirmacion')->with('response',$response)->with('uuid',$uuid)->with('emisor',$emisor)->with('receptor',$receptor)->with('total',$total);

    }

}
public function ZIP(){

    if (isset($_FILES['zipFile']) && $_FILES['zipFile']['error'] === UPLOAD_ERR_OK) {
        $zipFile = $_FILES['zipFile']['tmp_name'];
        $zip = new ZipArchive();

        if ($zip->open($zipFile) === true) {
            $destinationFolder = 'facturas/';
            // Crear la carpeta de destino si no existe, la carpeta es por Usuario
            if (!is_dir($destinationFolder)) {
                mkdir($destinationFolder, 777, true);
            }
            // Extraer los archivos del ZIP a un directorio temporal
            $tempDir = 'temp/';
            $zip->extractTo($tempDir);
            $zip->close();

            // Leer los archivos extraídos
            $files = scandir($tempDir);

            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    $filePath = $tempDir . $file;
                    $TFilePath = $destinationFolder. $file;
                    $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);

                    if ($fileExtension === 'xml') {
                        // Acciones específicas para archivos XML
                        $xmlContent = file_get_contents($filePath);
                        // Realizar operaciones con el XML
                        $xml = simplexml_load_string($xmlContent);
                        $ns = $xml->getNamespaces(true);
                        if( isset($ns['cfdi'])){
                        $xml->registerXPathNamespace('c', $ns['cfdi']);
                        $xml->registerXPathNamespace('t', $ns['tfd']);
                        $uuid='';
                        $emisor='';
                        $receptor='';
                        $total='';
                        $sello='';

                        //EMPIEZO A LEER LA INFORMACION DEL CFDI E IMPRIMIRLA
                        foreach ($xml->xpath('//cfdi:Comprobante') as $cfdiComprobante){
                            $total= (string)$cfdiComprobante['Total'];
                        }
                        foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Emisor') as $Emisor){
                        $emisor= (string)$Emisor['Rfc'];
                        }

                        foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Receptor') as $Receptor){
                        $receptor= (string)$Receptor['Rfc'];

                        }

                        //ESTA ULTIMA PARTE ES LA QUE GENERABA EL ERROR
                        foreach ($xml->xpath('//t:TimbreFiscalDigital') as $tfd) {
                        $sello= (string)$tfd['SelloCFD'];
                        $uuid= (string)$tfd['UUID'];
                        }

                        $udsello=substr($sello,-8);

                        // creamos la fábrica dándole los parámetros de los objetos \SoapClient que fabricará
                        $factory = new SoapClientFactory([
                            'user_agent' => 'Mozilla/5.0 (X11; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0'
                        ]);

                        // le pasamos la fábrical al cliente
                        $client = new SoapConsumerClient($factory);

                        // creamos el consumidor del servicio para poder hacer las consultas
                        $consumer = new Consumer($client);

                        // consumimos el webservice!
                        $response = $consumer->execute('https://verificacfdi.facturaelectronica.sat.gob.mx/default.aspx?&id='.$uuid.'&re='.$emisor.'&rr='.$receptor.'&tt='.$total.'&fe='.$udsello);
                        $encontrada = (string)$response->document();
                        if(str_contains($encontrada, "found")){
                           //Crear registro en la base de datos

                           //Copiar y mover el archivo a carpeta de facturas
                           rename($filePath, $TFilePath);
                        }
                        rename($filePath, $TFilePath);



                    } else{

                    }

                        if (basename($filePath, ".xml") !== basename($_FILES['xmlFile']['name'], ".xml")) {
                            // Eliminar el archivo XML que no coincide con el nombre del XML
                            chmod($filePath, 0777 );
                            unlink($filePath);

                        }
                    } elseif ($fileExtension === 'pdf') {
                        // Acciones específicas para archivos PDF
                        if (basename($filePath, ".pdf") !== basename($_FILES['xmlFile']['name'], ".xml")) {
                            // Eliminar el archivo PDF que no coincide con el nombre del XML
                            chmod($filePath, 0777 );
                            unlink($filePath);

                        }
                    } else {
                        // Otros tipos de archivos no deseados
                        // Eliminar el archivo no deseado
                        chmod($filePath, 0777 );
                        unlink($filePath);


                    }
                }
            }

            // Eliminar el directorio temporal
             //rmdir($tempDir);
        } else {
            echo 'No se pudo abrir el archivo ZIP.';
        }
    }

}
}
