<?php
include 'config.php';

$sql = "SELECT fecha_cita as start, especialista FROM citas";
$result = mysqli_query($conexion, $sql);

$eventos = [];
while($row = mysqli_fetch_assoc($result)) {
    $row['title'] = "RESERVADO";
    $row['backgroundColor'] = "#cccccc";
    $eventos[] = $row;
}

echo json_encode($eventos);
?>