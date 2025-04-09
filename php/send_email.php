<?php
// Limpiar cualquier salida previa
while (ob_get_level()) ob_end_clean();

// Establecer cabeceras primero
header('Content-Type: application/json; charset=utf-8');

// Desactivar visualización de errores (activar solo en desarrollo)
ini_set('display_errors', 0);
error_reporting(0);

try {
    // Validar método HTTP
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método no permitido', 405);
    }

    // Obtener datos limpios
    $data = [
        'name' => filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS),
        'email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL),
        'subject' => filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_SPECIAL_CHARS),
        'message' => filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS)
    ];

    // Validar campos requeridos
    if (empty($data['name']) || empty($data['email']) || empty($data['message'])) {
        throw new Exception('Todos los campos obligatorios deben completarse', 400);
    }

    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Correo electrónico no válido', 400);
    }

    // Configurar y enviar correo (ejemplo básico)
    $to = 'tuemail@dominio.com';
    $subject = $data['subject'] ?: 'Nuevo mensaje desde el sitio web';
    $message = "Nombre: {$data['name']}\nEmail: {$data['email']}\nMensaje: {$data['message']}";
    $headers = "From: {$data['email']}";

    if (!mail($to, $subject, $message, $headers)) {
        throw new Exception('Error al enviar el correo', 500);
    }

    // Respuesta exitosa
    echo json_encode([
        'success' => true,
        'message' => 'Mensaje enviado con éxito'
    ]);

} catch (Exception $e) {
    // Respuesta de error
    http_response_code($e->getCode() ?: 500);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage(),
        'error' => $e->getCode()
    ]);
}

exit; // Asegurar que no se envíe nada más