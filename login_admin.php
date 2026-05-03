<?php
session_start();

$usuario_correcto = "admin";
$password_correcta = "vethache2026";

if (isset($_POST['usuario']) && isset($_POST['password'])) {

    if ($_POST['usuario'] === $usuario_correcto && $_POST['password'] === $password_correcta) {

        $_SESSION['admin'] = true;
        header("Location: admin_vethache.php");
        exit;

    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>

<html lang="es">
<head>
<meta charset="UTF-8">
<title>Login Administrador</title>
<link rel="stylesheet" href="css/style.css">

<style>
body{
background:#f0f2f5;
display:flex;
justify-content:center;
align-items:center;
height:100vh;
font-family:Arial;
}

.login-box{
background:white;
padding:40px;
border-radius:15px;
box-shadow:0 10px 30px rgba(0,0,0,0.1);
width:320px;
}

.login-box h2{
text-align:center;
margin-bottom:25px;
color:#7B569E;
}

.login-box input{
width:100%;
padding:10px;
margin-bottom:15px;
border-radius:8px;
border:1px solid #ccc;
}

.login-box button{
width:100%;
padding:10px;
background:#7B569E;
color:white;
border:none;
border-radius:8px;
cursor:pointer;
}

.error{
color:red;
text-align:center;
margin-bottom:10px;
}
</style>

</head>

<body>

<div class="login-box">

<h2>Panel Admin</h2>

<?php if(isset($error)){ echo "<p class='error'>$error</p>"; } ?>

<form method="POST">

<input type="text" name="usuario" placeholder="Usuario" required>

<input type="password" name="password" placeholder="Contraseña" required>

<button type="submit">Entrar</button>

</form>

</div>

</body>
</html>

