<?php
$conexion = mysqli_connect("localhost", "root", "", "vethache_db");

$nombre = $_POST['nombre_cliente'];
$email = $_POST['email_cliente'];
$mascota = $_POST['nombre_mascota'];
$tipo = $_POST['tipo'];
$plan = $_POST['plan'];

$sql = "INSERT INTO pedidos (nombre_cliente, email_cliente, nombre_mascota, tipo_plan, categoria_plan) 
        VALUES ('$nombre', '$email', '$mascota', '$tipo', '$plan')";

$exito = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>¡Gracias! - Vethache</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; padding-top: 120px; }
        .confirm-box { 
            max-width: 700px; margin: 0 auto; background: white; padding: 60px; 
            border-radius: 40px; text-align: center; box-shadow: 0 20px 50px rgba(0,0,0,0.05);
            border-bottom: 10px solid #7B569E;
        }
        .check-anim { font-size: 100px; color: #7B569E; margin-bottom: 20px; }
    </style>
</head>
<body>
    <nav class="navbar-vethache">
        <div class="nav-container">
            <div class="nav-izq">
                <img src="img/logo.png" alt="Logo" class="logo-navbar">
                <span class="nav-marca">CLINICA VETHACHE</span>
            </div>
        </div>
    </nav>

    <div class="confirm-box">
        <i class="fas fa-check-circle check-anim"></i>
        <h1>¡Todo listo, <?php echo $nombre; ?>!</h1>
        <p style="font-size: 1.2rem; color: #555; line-height: 1.6;">
            Hemos registrado con éxito el <strong>Plan <?php echo strtoupper($plan); ?></strong> 
            para <strong><?php echo $mascota; ?></strong>. <br>
            Te hemos enviado un correo de bienvenida a <em><?php echo $email; ?></em>.
        </p>
        <br><br>
        <a href="index.html" class="btn-plan activo" style="text-decoration:none;">Volver a Inicio</a>
    </div>

    <footer style="text-align:center; padding: 50px; color: #aaa;">
        <p>2026 © Vethache Veterinaria</p>
    </footer>
</body>
</html>