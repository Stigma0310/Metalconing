<?php
// Incluir las clases necesarias de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Si usas Composer, puedes cargar PHPMailer de esta manera:
require '../vendor/autoload.php'; // Si no usas Composer, incluye los archivos manualmente.

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $nombre = $_POST['nombres'];
    $celular = $_POST['celular'];
    $email = $_POST['email'];
    $asunto = $_POST['asunto'];
    $mensaje = $_POST['mensaje'];

    // Crear una nueva instancia de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();                                           // Usar SMTP
        $mail->Host = 'smtp.gmail.com';                              // Servidor SMTP de Gmail (puedes usar otro servidor)
        $mail->SMTPAuth = true;                                      // Activar autenticación SMTP
        $mail->Username = 'l3nn1n1@gmail.com';                     // Tu dirección de correo
        $mail->Password = 'iabf kvoj qgjl qhnk';                           // Tu contraseña o contraseña de aplicación (si usas Gmail)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;          // Habilitar cifrado TLS
        $mail->Port = 587;                                           // Puerto SMTP

        // Remitente y destinatario
        $mail->setFrom($email, $nombre);                             // Dirección de correo del usuario que envía el mensaje
        $mail->addAddress('administracionmci@metalconing.com', 'Contacto');   // Dirección de correo de destino

        // Contenido del correo
        $mail->isHTML(true);                                         // Establecer el correo en formato HTML
        $mail->Subject = "Nuevo mensaje de contacto: $asunto";        // Asunto del correo
        $mail->Body    = "Nombre: $nombre<br>Email: $email<br>Celular: $celular<br><br>Mensaje: <br>$mensaje";  // Cuerpo HTML
        $mail->AltBody = "Nombre: $nombre\nEmail: $email\nCelular: $celular\n\nMensaje:\n$mensaje";  // Cuerpo en texto plano

        // Enviar el correo
        if ($mail->send()) {
            // Si el mensaje se envió correctamente, redirigir a la página principal
            header('Location: ../index.html'); // Cambia a la URL de tu página principal
            exit; // Importante para detener la ejecución del script después de la redirección
        } else {
            echo 'No se pudo enviar el mensaje';
        }

    } catch (Exception $e) {
        echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
    }
}
?>
