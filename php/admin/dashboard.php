<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Mostrar bienvenida al usuario
echo "¡Hola admin " . $_SESSION['nombre'] . "! Has iniciado sesión correctamente.";
?>
<br>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Enlace a Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Contenedor principal -->
    <div class="container-fluid">
        <div class="row">
            <!-- Barra lateral (Sidebar) -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="position-sticky">
                    <h4 class="text-center mt-3">Menú</h4>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-cliente" href="#clientes" data-bs-toggle="tab">
                                Registrar Cliente
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-servicio" href="#servicios" data-bs-toggle="tab">
                                Agregar Servicios
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Contenido principal -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-4">
                <!-- Header -->
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Bienvenido al Dashboard</h1>
                </div>

                <!-- Pestañas (Tabs) -->
                <div class="tab-content">
                    <!-- Sección de Registrar Cliente -->
                    <div class="tab-pane fade show active" id="clientes">
                        <h3>Registrar Cliente</h3>
                        <form action="../registro_cliente.php" method="POST">
                            <div class="mb-3">
                                <label for="nombre_cliente" class="form-label">Nombre Completo</label>
                                <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente" required>
                            </div>
                            <div class="mb-3">
                                <label for="email_cliente" class="form-label">Correo</label>
                                <input type="text" class="form-control" id="email_cliente" name="email_cliente" required>
                            </div>
                            <div class="mb-3">
                                <label for="usuario_cliente" class="form-label">Usuario</label>
                                <input type="text" class="form-control" id="usuario_cliente" name="usuario_cliente" required>
                            </div>
                            <div class="mb-3">
                                <label for="pwd_cliente" class="form-label">Contraseña</label>
                                <input type="text" class="form-control" id="pwd_cliente" name="pwd_cliente" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Registrar Cliente</button>
                        </form>
                    </div>

                    <!-- Sección de Agregar Servicios -->
                    <div class="tab-pane fade" id="servicios">
                        <h3>Agregar Servicio</h3>
                        <form action="../agregar_servicio.php" method="POST">
                            <div class="mb-3">
                                <label for="nombre_servicio" class="form-label">Nombre del Servicio</label>
                                <input type="text" class="form-control" id="nombre_servicio" name="nombre_servicio" required>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion_servicio" class="form-label">Descripción del Servicio</label>
                                <textarea class="form-control" id="descripcion_servicio" name="descripcion_servicio" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Agregar Servicio</button>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Enlace a Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
