
<?php

// Ruta del archivo en la unidad E:
$nombreArchivo = $_GET['archivo'];
$rutaArchivo = 'E:\PRV/'.$nombreArchivo;
// Leer el contenido del archivo
$contenido = file_get_contents($rutaArchivo);
highlight_file($rutaArchivo);

// Devolver el contenido
echo $contenido;


?>

