<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "kioscodb";

//$db_host = "192.185.194.188";
//$db_user = "d26com_usr_general";
//$db_pass = "Isp203040";
//$db_name = "d26com_db_valentino";

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
