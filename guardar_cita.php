<?php
// 1. Incluimos la configuración unificada
include 'config.php';

// 2. Leemos los datos que envía el JavaScript
$json = file_get_contents('php://input');
$d = json_decode($json, true);

if ($d) {
    // 3. Escapamos los datos para evitar errores con tildes o caracteres especiales
    $fecha        = mysqli_real_escape_string($conexion, $d['fecha']);
    $especialista = mysqli_real_escape_string($conexion, $d['especialista']);
    $nombre       = mysqli_real_escape_string($conexion, $d['nombre']);
    $telefono     = mysqli_real_escape_string($conexion, $d['telefono']);
    $email        = mysqli_real_escape_string($conexion, $d['email']);
    $mascota      = mysqli_real_escape_string($conexion, $d['mascota']);
    $especie      = mysqli_real_escape_string($conexion, $d['especie']);
    $edad         = mysqli_real_escape_string($conexion, $d['edad']);
    $motivo       = mysqli_real_escape_string($conexion, $d['motivo']);

    // 4. Comprobar si ESE especialista concreto ya está ocupado en ESA fecha/hora
    $check = mysqli_query($conexion, "SELECT id FROM citas WHERE fecha_cita = '$fecha' AND especialista = '$especialista'");

    if (mysqli_num_rows($check) > 0) {
        // Si ya existe una fila, enviamos error al JS
        echo json_encode(["status" => "error", "msg" => "Este especialista ya tiene una cita reservada a esta hora."]);
        exit;
    } else {
        // 5. Si está libre, procedemos con la inserción incluyendo el estado 'Pendiente'
        $sql = "INSERT INTO citas (fecha_cita, especialista, nombre_cliente, telefono, email, nombre_mascota, especie_mascota, edad_mascota, motivo, estado) 
                VALUES ('$fecha', '$especialista', '$nombre', '$telefono', '$email', '$mascota', '$especie', '$edad', '$motivo', 'Pendiente')";
        
        if (mysqli_query($conexion, $sql)) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "msg" => mysqli_error($conexion)]);
        }
    }
} else {
    echo json_encode(["status" => "error", "msg" => "No se recibieron datos"]);
}

// 6. Cerramos la conexión siempre al final
mysqli_close($conexion);
?>