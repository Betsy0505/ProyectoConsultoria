<?php

$host = 'localhost'; 
$dbname = 'bytekod_consultoria';
$username = 'root';
$password = '';

try {
    $conn = new mysqli($host, $username, $password, $dbname);
    
    // Verificar conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }
    
    // Establecer el charset
    $conn->set_charset("utf8mb4");
    
} catch (Exception $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}

?>