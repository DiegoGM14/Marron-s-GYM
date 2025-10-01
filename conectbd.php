<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$host = "localhost";
$usuario = "ejasyjrp_marrongym";
$password = '{a;aI$moE,wz';
$baseDatos = "ejasyjrp_marrongym";

function obtenerConexion() {
    global $host, $usuario, $password, $baseDatos;

    try {
        $conexion = new mysqli($host, $usuario, $password, $baseDatos);
        $conexion->set_charset("utf8");
        return $conexion;
    } catch (mysqli_sql_exception $e) {
        return null;
    }
}
?>
