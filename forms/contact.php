<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Cargar PHPMailer
require 'path/to/vendor/autoload.php'; // Ajusta la ruta según tu estructura de carpetas

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Crear una instancia de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Servidor SMTP (por ejemplo, smtp.gmail.com)
        $mail->SMTPAuth = true;
        $mail->Username = 'henryjavierhuillcaayala@gmail.com'; // Tu correo
        $mail->Password = '48569459'; // Tu contraseña
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Encriptación TLS
        $mail->Port = 587; // Puerto SMTP

        // Remitente y destinatario
        $mail->setFrom($email, $name); // Remitente (correo y nombre del formulario)
        $mail->addAddress('henryjavierhuillcaayala@gmail.com'); // Destinatario (reemplaza con tu correo)

        // Contenido del correo
        $mail->isHTML(true); // Habilitar contenido HTML
        $mail->Subject = $subject; // Asunto del correo
        $mail->Body    = "Nombre: $name <br> Correo: $email <br> Mensaje: $message"; // Cuerpo en HTML
        $mail->AltBody = "Nombre: $name \n Correo: $email \n Mensaje: $message"; // Versión en texto plano

        // Enviar el correo
        $mail->send();
        echo json_encode(['status' => 'success', 'message' => 'Your message has been sent. Thank you!']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => "Error al enviar el correo: {$mail->ErrorInfo}"]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>