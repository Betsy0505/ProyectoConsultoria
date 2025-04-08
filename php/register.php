<?php
session_start();
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $email = trim($_POST['email']);
    $nombre = trim($_POST['nombre']);

    if (empty($username) || empty($password) || empty($email)) {
        $_SESSION['error'] = 'Todos los campos son obligatorios';
        header('Location: ../register.html');
        exit;
    }

    if (strlen($password) < 8) {
        $_SESSION['error'] = 'La contraseña debe tener al menos 8 caracteres';
        header('Location: ../register.html');
        exit;
    }

    try {
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE username = :username OR email = :email");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            $_SESSION['error'] = 'El nombre de usuario o email ya está en uso';
            header('Location: ../register.html');
            exit;
        }
        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $insert = $pdo->prepare("INSERT INTO usuarios (username, password, email, nombre_completo) 
                                VALUES (:username, :password, :email, :nombre)");
        $insert->bindParam(':username', $username);
        $insert->bindParam(':password', $hashedPassword);
        $insert->bindParam(':email', $email);
        $insert->bindParam(':nombre', $nombre);
        $insert->execute();
        
        $_SESSION['success'] = 'Registro exitoso. Por favor inicie sesión.';
        header('Location: ../login.html');
        exit;
        
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Error en el registro. Por favor intente más tarde.';
        header('Location: ../register.html');
        exit;
    }
} else {
    header('Location: ../register.html');
    exit;
}
?>