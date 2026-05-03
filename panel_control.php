<?php
include 'config.php';
// La consulta recupera todos los campos, incluido el teléfono
$sql = "SELECT * FROM citas ORDER BY fecha_cita DESC";
$resultado = mysqli_query($conexion, $sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Citas - Vethache</title>
    <style>
        body { font-family: sans-serif; padding: 20px; background: #f4f7f6; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 0 20px rgba(0,0,0,0.1); }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #7B569E; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        .paciente-nombre { color: #333; font-weight: bold; display: block; }
        .mascota-info { color: #666; font-size: 0.9em; }
    </style>
</head>
<body>
    <h1 style="color: #7B569E;">Listado de Citas Recibidas</h1>
    <table>
        <thead>
            <tr>
                <th>Fecha/Hora</th>
                <th>Paciente y Mascota</th>
                <th>Teléfono</th> <th>Especialista</th>
                <th>Motivo</th>
            </tr>
        </thead>
        <tbody>
            <?php while($fila = mysqli_fetch_assoc($resultado)): ?>
            <tr>
                <td><?php echo $fila['fecha_cita']; ?></td>
                <td>
                    <span class="paciente-nombre"><?php echo $fila['nombre_cliente']; ?></span>
                    <span class="mascota-info"><?php echo $fila['nombre_mascota']; ?> (<?php echo $fila['especie_mascota']; ?>)</span>
                </td>
                <td><?php echo $fila['telefono']; ?></td> <td><?php echo $fila['especialista']; ?></td>
                <td><?php echo $fila['motivo']; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>