
<?php
//$xml = simplexml_load_file('test/T31_Importe-error.xml');
$xml = simplexml_load_file('test/T31_ValorU-error.xml');
//$xml = simplexml_load_file('test/T31_Cantidad-error.xml');
$ns = $xml->getNamespaces(true);
$xml->registerXPathNamespace('c', $ns['cfdi']);
$xml->registerXPathNamespace('t', $ns['tfd']);


//EMPIEZO A LEER LA INFORMACION DEL CFDI E IMPRIMIRLA



// Array de XML Costos
$valorUArray = [];
foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Conceptos//cfdi:Concepto') as $Concepto) {
    $valorUArray[] = (string)$Concepto['ValorUnitario'];;
}

// Array de BD Costos
$costosArray = [];
foreach ($costos as $costo) {
    $costosArray[] = number_format($costo->costo, 2, '.', '');;
}

// Imprimir ARRAYS
var_dump($costosArray);
echo "<hr>";
var_dump($valorUArray);
echo "<hr>";

// Comparar valores, sin orden especifico
$excluded_costo = array_diff($valorUArray, $costosArray);
$excluded_costo = implode(', ', $excluded_costo);

// Imprimir comprobacion
if (!empty($excluded_costo)) {
    echo "Los arrays de costo son diferentes.";
    echo $excluded_costo;
}

echo "<br>";
echo "<hr>";
echo "<br>";

// Array de XML Importes
$valorIArray = [];
foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Conceptos//cfdi:Concepto') as $Concepto) {
    $valorIArray[] = (string)$Concepto['Importe'];;
}

// Array de BD Importes
$importeArray = [];
foreach ($importes as $importe) {
    $importeArray[] = number_format($importe->importe, 2, '.', '');;
}

// Imprimir ARRAYS
var_dump($importeArray);
echo "<hr>";
var_dump($valorIArray);
echo "<hr>";

// Comparar valores, sin orden especifico
$excluded_importe = array_diff($valorIArray, $importeArray);
$excluded_importe = implode(', ', $excluded_importe);

// Imprimir comprobacion
if (!empty($excluded_importe)) {

    echo "Los arrays de importe son diferentes.";
    echo $excluded_importe;
}



echo "<br>";
echo "<hr>";
echo "<br>";

// Array de XML Cantidades
$valorCArray = [];
foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Conceptos//cfdi:Concepto') as $Concepto) {
    $valorCArray[] = (string)$Concepto['Cantidad'];;
}

// Array de BD Cantidades
$cantidadArray = [];
foreach ($cantidades as $cantidad) {
    $cantidadArray[] = number_format($cantidad->cantidad, 2, '.', '');;
}

// Imprimir ARRAYS
var_dump($cantidadArray);
echo "<hr>";
var_dump($valorCArray);
echo "<hr>";

// Comparar valores, sin orden especifico
$excluded_cantidad = array_diff($valorCArray, $cantidadArray);
$excluded_cantidad = implode(', ', $excluded_cantidad);

// Imprimir comprobacion
if (!empty($excluded_cantidad)) {
    echo "Los arrays de cantidad son diferentes.";
    echo $excluded_cantidad;
}

