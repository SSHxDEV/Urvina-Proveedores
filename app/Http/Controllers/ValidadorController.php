<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpCfdi\SatEstadoCfdi\Soap\SoapConsumerClient;
use PhpCfdi\SatEstadoCfdi\Soap\SoapClientFactory;
use PhpCfdi\SatEstadoCfdi\Consumer;

class ValidadorController extends Controller
{
    public function Individual(){
        $xml = simplexml_load_file("FA34012.xml");
        $ns = $xml->getNamespaces(true);
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

    }
}
