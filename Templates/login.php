<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Elegante</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <h1>Bienvenido</h1>
            <p>Ingresa tus credenciales para continuar</p>
        </div>

        <div class="login-body">

            <?php
                session_start();
                if (isset($_SESSION['error'])) {
                    echo '<div style="color: red; margin-bottom: 10px;">' . $_SESSION['error'] . '</div>';
                    unset($_SESSION['error']); // Limpia el mensaje después de mostrarlo
                }
            ?>

            <form action="../php/login.php" method="POST">
                <div class="input-group">
                    <label for="username">Usuario</label>
                    <input type="text" id="username" name="username" placeholder="Ingresa tu usuario" required>
                </div>
                
                <div class="input-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>
                </div>
                
                <div class="remember-forgot">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Recordarme</label>
                    </div>
                    <div class="forgot-password">
                        <a href="#">¿Olvidaste tu contraseña?</a>
                    </div>
                </div>
                
                <button type="submit" class="login-button">Iniciar Sesión</button>
            </form>
        </div>
    </div>
</body>
</html>