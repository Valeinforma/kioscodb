<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "kioscodb";
//quitamos cadena de conexion


$cnn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$cnn) {
    die('Error de conexión a la base de datos.');
}

if (!mysqli_set_charset($cnn, 'utf8mb4')) {
    die('Error al establecer charset utf8mb4.');
}

// Activa el reporte de errores de MySQLi como excepciones
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
?>
