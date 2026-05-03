<?php
// Usamos $conexion para que coincida con admin_vethache.php
$conexion = mysqli_connect("localhost", "root", "", "vethache_db");

if (!$conexion) {
    die("Error de conexión con la base de datos: " . mysqli_connect_error());
}
?>