<?php
// ==============================
// INICIO DE SESIÓN
// ==============================
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit;
}

// ==============================
// CONEXIÓN A LA BASE DE DATOS
// ==============================
$conexion = mysqli_connect("localhost", "root", "", "vethache_db");

if (!$conexion) {
    die("Error de conexión con la base de datos.");
}

// ==============================
// LÓGICA DE ACCIONES (POST/GET)
// ==============================

// Confirmar cita
if (isset($_GET['confirmar_cita'])) {
    $id_confirmar = intval($_GET['confirmar_cita']);
    $sql_update = "UPDATE citas SET estado = 'Confirmada' WHERE id = $id_confirmar";
    mysqli_query($conexion, $sql_update);
    header("Location: admin_vethache.php");
    exit;
}

// Borrar pedido de plan
if (isset($_GET['borrar'])) {
    $id_borrar = intval($_GET['borrar']);
    mysqli_query($conexion, "DELETE FROM pedidos WHERE id = $id_borrar");
    header("Location: admin_vethache.php");
    exit;
}

// Borrar cita
if (isset($_GET['borrar_cita'])) {
    $id_c = intval($_GET['borrar_cita']);
    mysqli_query($conexion, "DELETE FROM citas WHERE id = $id_c");
    header("Location: admin_vethache.php");
    exit;
}

// ==============================
// CONSULTAS PARA ESTADÍSTICAS
// ==============================

// Estadísticas de PLANES
$total_pedidos = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT COUNT(*) as total FROM pedidos"))['total'];
$total_caninos = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT COUNT(*) as total FROM pedidos WHERE tipo_plan='canino'"))['total'];
$total_felinos = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT COUNT(*) as total FROM pedidos WHERE tipo_plan='felino'"))['total'];

// Estadísticas de CITAS
$total_citas = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT COUNT(*) as total FROM citas"))['total'];
$total_pendientes = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT COUNT(*) as total FROM citas WHERE estado='Pendiente'"))['total'];
$total_confirmadas = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT COUNT(*) as total FROM citas WHERE estado='Confirmada'"))['total'];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Admin Vethache - Gestión</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .admin-container { padding: 40px; max-width: 1200px; margin: 0 auto; }
        table { width: 100%; border-collapse: collapse; background: white; box-shadow: 0 10px 30px rgba(0,0,0,0.1); border-radius: 15px; overflow: hidden; margin-bottom: 40px; }
        th { background: #7B569E; color: white; padding: 18px; text-align: left; }
        td { padding: 15px; border-bottom: 1px solid #eee; font-size: 14px; }
        .badge { padding: 5px 12px; border-radius: 20px; font-weight: bold; font-size: 11px; text-transform: uppercase; }
        .canino { background: #e3f2fd; color: #1976d2; }
        .felino { background: #f3e5f5; color: #7b1fa2; }
        .btn-borrar { color: #e74c3c; cursor: pointer; transition: 0.3s; font-size: 18px; }
        .btn-borrar:hover { color: #c0392b; transform: scale(1.2); }
        .stats { display: flex; gap: 20px; margin-bottom: 20px; }
        .stat-card { background: white; padding: 20px; border-radius: 15px; flex: 1; box-shadow: 0 5px 15px rgba(0,0,0,0.05); border-left: 5px solid #7B569E; }
        .confirmada-row { background-color: #d4edda !important; }
    </style>
</head>
<body style="background: #f0f2f5;">

    <div class="admin-container">

        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 30px;">
            <h1 style="color: #7B569E; font-weight: 800; margin:0;">Panel de Control Vethache</h1>
            <a href="index.html" style="text-decoration:none; color:#666;">
                <i class="fas fa-sign-out-alt"></i> Salir
            </a>
        </div>

        <h2 style="color:#7B569E; margin-bottom: 15px;">Contratación Planes de Salud</h2>
        
        <div class="stats">
            <div class="stat-card">
                <span style="color:#666;">Total Pedidos</span>
                <h2 style="margin:5px 0;"><?php echo $total_pedidos; ?></h2>
            </div>
            <div class="stat-card" style="border-left-color: #1976d2;">
                <span style="color:#666;">Planes Caninos</span>
                <h2 style="margin:5px 0;"><?php echo $total_caninos; ?></h2>
            </div>
            <div class="stat-card" style="border-left-color: #7b1fa2;">
                <span style="color:#666;">Planes Felinos</span>
                <h2 style="margin:5px 0;"><?php echo $total_felinos; ?></h2>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Mascota</th>
                    <th>Tipo</th>
                    <th>Plan</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $res_pedidos = mysqli_query($conexion, "SELECT * FROM pedidos ORDER BY fecha_compra DESC");
                while($fila = mysqli_fetch_assoc($res_pedidos)): ?>
                <tr>
                    <td><?php echo date('d/m/Y H:i', strtotime($fila['fecha_compra'])); ?></td>
                    <td>
                        <strong><?php echo $fila['nombre_cliente']; ?></strong><br>
                        <small style="color:#888;"><?php echo $fila['email_cliente']; ?></small>
                    </td>
                    <td><?php echo $fila['nombre_mascota']; ?></td>
                    <td><span class="badge <?php echo $fila['tipo_plan']; ?>"><?php echo $fila['tipo_plan']; ?></span></td>
                    <td><strong><?php echo strtoupper($fila['categoria_plan']); ?></strong></td>
                    <td style="text-align:center;">
                        <a href="admin_vethache.php?borrar=<?php echo $fila['id']; ?>" onclick="return confirm('¿Eliminar?')" class="btn-borrar">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h2 style="color:#7B569E; margin-bottom: 15px;">Gestión de Citas Médicas</h2>

        <div class="stats">
            <div class="stat-card" style="border-left-color: #3498db;">
                <span style="color:#666;">Total de Citas</span>
                <h2 style="margin:5px 0;"><?php echo $total_citas; ?></h2>
            </div>
            <div class="stat-card" style="border-left-color: #f1c40f;">
                <span style="color:#666;">Citas Pendientes</span>
                <h2 style="margin:5px 0;"><?php echo $total_pendientes; ?></h2>
            </div>
            <div class="stat-card" style="border-left-color: #2ecc71;">
                <span style="color:#666;">Citas Confirmadas</span>
                <h2 style="margin:5px 0;"><?php echo $total_confirmadas; ?></h2>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Fecha/Hora</th>
                    <th>Paciente y Mascota</th>
                    <th>Teléfono</th>
                    <th>Especialista</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $res_citas = mysqli_query($conexion, "SELECT * FROM citas ORDER BY fecha_cita DESC");
                while($c = mysqli_fetch_assoc($res_citas)): 
                    $clase_confirmada = ($c['estado'] == 'Confirmada') ? 'class="confirmada-row"' : '';
                ?>
                <tr <?php echo $clase_confirmada; ?>>
                    <td><?php echo date('d/m/Y H:i', strtotime($c['fecha_cita'])); ?></td>
                    <td>
                        <strong><?php echo $c['nombre_cliente']; ?></strong><br>
                        <small><?php echo $c['nombre_mascota']; ?> (<?php echo $c['especie_mascota']; ?>)</small>
                    </td>
                    <td><?php echo $c['telefono']; ?></td>
                    <td><?php echo $c['especialista']; ?></td>
                    <td>
                        <span style="font-weight:bold; color: <?php echo ($c['estado'] == 'Confirmada') ? '#28a745' : '#e67e22'; ?>;">
                            <?php echo $c['estado']; ?>
                        </span>
                    </td>
                    <td style="text-align:center;">
                        <?php if($c['estado'] == 'Pendiente'): ?>
                            <a href="admin_vethache.php?confirmar_cita=<?php echo $c['id']; ?>" style="color: #28a745; margin-right: 15px; font-size: 18px;" title="Confirmar Cita">
                                <i class="fas fa-check-circle"></i>
                            </a>
                        <?php endif; ?>
                        <a href="admin_vethache.php?borrar_cita=<?php echo $c['id']; ?>" onclick="return confirm('¿Eliminar cita?')" class="btn-borrar">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

    </div>
</body>
</html>
