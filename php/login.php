<?php
session_start();
require_once 'C:/laragon/www/ProyectoConsultoria/Database/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);

    if (empty($username) || empty($password)) {
        $_SESSION['error'] = 'Por favor ingrese usuario y contraseña';
        header('Location: ../Templates/login.php');
        exit;
    }

    try {
        $stmt = $pdo->prepare("SELECT id, username, password, rol, nombre_completo FROM usuarios WHERE username = :username AND activo = 1");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() === 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Depuración (opcional)
            // echo "Password ingresado: $password<br>";
            // echo "Password en BD: " . $user['password'] . "<br>";

            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['rol'] = $user['rol'];
                $_SESSION['nombre'] = $user['nombre_completo'];

                if ($remember) {
                    setcookie('remember_user', $user['username'], time() + 86400 * 30, '/');
                }

                $update = $pdo->prepare("UPDATE usuarios SET ultimo_login = NOW() WHERE id = :id");
                $update->bindParam(':id', $user['id']);
                $update->execute();

                // Redirigir según rol
                if ($user['rol'] === 'admin') {
                    header('Location: ../php/admin/dashboard.php');
                } else {
                    header('Location: ../user/dashboard.php');
                }
                exit;
            }
        }

        $_SESSION['error'] = 'Usuario o contraseña incorrectos';
        header('Location: ../Templates/login.php');
        exit;

    } catch (PDOException $e) {
        $_SESSION['error'] = 'Error en el sistema. Por favor intente más tarde.';
        header('Location: ../Templates/login.php');
        exit;
    }
} else {
    header('Location: ../Templates/login.php');
    exit;
}
