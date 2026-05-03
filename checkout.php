<?php
// ==============================
// RECOGIDA DE DATOS POR URL
// ==============================
// Se obtienen los parámetros enviados desde la página anterior.
// Si no existen, se asigna un valor por defecto.
$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : 'No especificado';
$plan = isset($_GET['plan']) ? $_GET['plan'] : 'No especificado';
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <!-- Configuración básica -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Finalizar Compra - Vethache</title>

    <!-- Hoja de estilos principal -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Estilos específicos de esta página -->
    <style>

        .form-compra {
            max-width: 600px;
            margin: 150px auto;
            padding: 40px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border-top: 8px solid #7B569E;
        }

        .resumen-plan {
            background: #f4eef9;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            color: #7B569E;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .btn-finalizar {
            background: #7B569E;
            color: white;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 50px;
            font-weight: bold;
            cursor: pointer;
            font-size: 1.1rem;
        }

    </style>

</head>

<body>

    <!-- ==============================
         CONTENIDO PRINCIPAL DEL FORMULARIO
         Esta sección permite al usuario completar la contratación
    =============================== -->
    <main>

        <section class="form-compra">

            <h1>Finalizar Contratación</h1>

            <!-- Resumen del plan seleccionado -->
            <div class="resumen-plan">
                Has seleccionado:
                Plan <?php echo ucfirst($tipo) . " " . ucfirst($plan); ?>
            </div>

            <!-- Formulario que envía los datos al archivo de procesamiento -->
            <form action="procesar_pago.php" method="POST">

                <!-- Datos ocultos del plan seleccionado -->
                <input type="hidden" name="tipo" value="<?php echo htmlspecialchars($tipo); ?>">
                <input type="hidden" name="plan" value="<?php echo htmlspecialchars($plan); ?>">

                <h2>Datos del Propietario</h2>

                <label>Nombre completo</label>
                <input type="text" name="nombre_cliente" required>

                <label>Correo electrónico</label>
                <input type="email" name="email_cliente" required>

                <h2>Datos de la Mascota</h2>

                <label>Nombre de la mascota</label>
                <input type="text" name="nombre_mascota" required>

                <label>Raza (opcional)</label>
                <input type="text" name="raza_mascota">

                <!-- Botón de envío del formulario -->
                <button type="submit" class="btn-finalizar">
                    Confirmar y Pagar
                </button>

            </form>

        </section>

    </main>

</body>

</html>
