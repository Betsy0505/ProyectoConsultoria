<?php
// Conexión a la base de datos
include '../Database/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre_cliente'];
    $correo = $_POST['email_cliente'];
    $usuario = $_POST['usuario_cliente'];
    $contrasena = $_POST['pwd_cliente'];
    $rol = "admin";
    $activo = 1;

    // Encriptar la contraseña
    $hash = password_hash($contrasena, PASSWORD_DEFAULT);

    try {
        $sql = "INSERT INTO usuarios (nombre_completo, email, username, password, rol, activo) 
                VALUES (:nombre, :correo, :usuario, :password, :username, :activo)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nombre' => $nombre,
            ':correo' => $correo,
            ':usuario' => $usuario,
            ':password' => $hash,
            ':username' => $rol,
            ':activo' => $activo
        ]);

        // C:/laragon/www/ProyectoConsultoria

        echo "✅ Cliente registrado correctamente con rol admin.";
        echo "<br><a href='../Templates/login.php'>Volver al dashboard</a>";

    } catch (PDOException $e) {
        echo "❌ Error al registrar el cliente: " . $e->getMessage();
    }
}
?>
