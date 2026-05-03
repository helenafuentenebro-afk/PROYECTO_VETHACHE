<?php
// ==============================
// CONFIGURACIÓN DE ENVÍO DE CORREO
// Sistema basado en PHPMailer mediante SMTP (Gmail)
// ==============================

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/phpmailer/Exception.php';
require __DIR__ . '/phpmailer/PHPMailer.php';
require __DIR__ . '/phpmailer/SMTP.php';

/* ====== CONFIGURACIÓN ====== */
$correo_envia   = "remisionesvethache@gmail.com";  
$app_password   = "zuci fwry mqfk npvk";           
$correo_recibe  = "vethache@gmail.com";            
/* =========================== */

// ==============================
// RECOGIDA DE DATOS DEL FORMULARIO
// Se utilizan operadores de coalescencia para evitar errores si no existen
// ==============================

$nombre   = $_POST['nombre']   ?? '';
$telefono = $_POST['telefono'] ?? '';
$correo   = $_POST['correo']   ?? '';
$mascota  = $_POST['mascota']  ?? '';
$motivo   = $_POST['motivo']   ?? '';

// ==============================
// CONSTRUCCIÓN DEL MENSAJE
// ==============================

$mensaje  = "Nombre: $nombre\n";
$mensaje .= "Teléfono: $telefono\n";
$mensaje .= "Correo: $correo\n";
$mensaje .= "Mascota: $mascota\n";
$mensaje .= "Motivo: $motivo\n";

$mail = new PHPMailer(true);

try {

  // ==============================
  // CONFIGURACIÓN SMTP
  // ==============================

  $mail->isSMTP();
  $mail->Host       = 'smtp.gmail.com';
  $mail->SMTPAuth   = true;
  $mail->Username   = $correo_envia;
  $mail->Password   = $app_password;
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  $mail->Port       = 587;

  // Remitente y destinatario
  $mail->setFrom($correo_envia, 'Formulario Vethache');
  $mail->addAddress($correo_recibe);

  // Asunto y cuerpo del mensaje
  $mail->Subject = 'Nueva remisión recibida';
  $mail->Body    = $mensaje;

  // ==============================
  // GESTIÓN DE ARCHIVOS ADJUNTOS
  // Se comprueba que existan archivos sin errores
  // ==============================

  if (!empty($_FILES['archivos']['name'][0])) {

    for ($i = 0; $i < count($_FILES['archivos']['name']); $i++) {

      if ($_FILES['archivos']['error'][$i] === UPLOAD_ERR_OK) {

        $mail->addAttachment(
          $_FILES['archivos']['tmp_name'][$i],
          $_FILES['archivos']['name'][$i]
        );

      }
    }
  }

  // Envío del correo
  $mail->send();

  // ==============================
  // MENSAJE DE ÉXITO
  // ==============================

  echo '
  <!DOCTYPE html>
  <html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviado</title>
  </head>
  <body style="display:flex;justify-content:center;align-items:center;min-height:100vh;font-family:Arial;background:#f5f5f5;">
    <div style="background:white;padding:30px;border-radius:12px;text-align:center;box-shadow:0 10px 30px rgba(0,0,0,.1);">
      <h2 style="color:#2e7d32;">Formulario enviado correctamente</h2>
      <p>En breve nos pondremos en contacto.</p>
      <a href="formulario.html" style="display:inline-block;margin-top:10px;padding:10px 15px;background:#2e7d32;color:white;text-decoration:none;border-radius:8px;">
        Enviar otro formulario
      </a>
    </div>
  </body>
  </html>
  ';

  exit;

} catch (Exception $e) {

  // ==============================
  // MENSAJE DE ERROR
  // ==============================

  echo '
  <!DOCTYPE html>
  <html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
  </head>
  <body style="display:flex;justify-content:center;align-items:center;min-height:100vh;font-family:Arial;background:#fff3f3;">
    <div style="background:white;padding:30px;border-radius:12px;text-align:center;box-shadow:0 10px 30px rgba(0,0,0,.1);">
      <h2 style="color:#c62828;">No se pudo enviar el formulario</h2>
      <p>'.$mail->ErrorInfo.'</p>
      <a href="formulario.html" style="color:#c62828;font-weight:bold;">Volver al formulario</a>
    </div>
  </body>
  </html>
  ';

  exit;
}
