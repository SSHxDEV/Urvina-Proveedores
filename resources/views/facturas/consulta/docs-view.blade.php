
<?php
// Ruta del archivo en la unidad E:
$nombreArchivo = $_GET['archivo'];



if(isset($_GET['receptor'])){
    $emisor = $_GET['emisor'];
    $receptor = $_GET['receptor'];
    $rutaArchivo = 'E:\PRV/'.$receptor.'/'.$emisor.'/'.$nombreArchivo.'.xml';
}else{
    $rutaArchivo = 'E:\PRV/'.$nombreArchivo;
}

// Leer el contenido del archivo
$contenido = file_get_contents($rutaArchivo);
highlight_file($rutaArchivo);

// Devolver el contenido
echo $contenido;


?>

