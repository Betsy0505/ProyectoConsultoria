<?php
$host = '198.59.144.12'; 
$dbname = 'bytekodc_bd_betsy';
$username = 'bytekodc_betsy';
$password = 'J0pnQV1M!@d2';


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>