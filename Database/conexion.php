<?php
$host = '198.59.144.12'; 
$dbname = 'bytekodc_bd_betsy';
$username = 'bytekodc_betsy';
$password = 'J0pnQV1M!@d2';


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