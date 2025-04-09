<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Estilos personalizados -->
    <style>
        :root {
            --sidebar-width: 280px;
            --topbar-height: 60px;
            --primary-color: #4e73df;
            --secondary-color: #f8f9fc;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fb;
            overflow-x: hidden;
        }
        
        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #fff;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            transition: all 0.3s;
            z-index: 1000;
        }
        
        .sidebar-header {
            height: var(--topbar-height);
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            background: var(--primary-color);
            color: white;
        }
        
        .sidebar .nav-link {
            padding: 1rem 1.5rem;
            color: #4a4b65;
            border-left: 3px solid transparent;
            transition: all 0.3s;
        }
        
        .sidebar .nav-link:hover {
            color: var(--primary-color);
            background-color: rgba(78, 115, 223, 0.05);
        }
        
        .sidebar .nav-link.active {
            color: var(--primary-color);
            border-left: 3px solid var(--primary-color);
            font-weight: 600;
            background-color: rgba(78, 115, 223, 0.1);
        }
        
        .sidebar .nav-link i {
            margin-right: 0.5rem;
            width: 20px;
            text-align: center;
        }
        
        /* Main content */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            transition: all 0.3s;
        }
        
        .topbar {
            height: var(--topbar-height);
            background: white;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
        }
        
        .welcome-message {
            background: var(--primary-color);
            color: white;
            padding: 1rem;
            border-radius: 0.35rem;
            margin-bottom: 1.5rem;
        }
        
        /* Cards */
        .card {
            border: none;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            margin-bottom: 1.5rem;
        }
        
        .card-header {
            background-color: #f8f9fc;
            border-bottom: 1px solid #e3e6f0;
            padding: 1rem 1.35rem;
        }
        
        /* Formularios */
        .form-control {
            border-radius: 0.35rem;
            padding: 0.75rem 1rem;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                z-index: 1050;
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .topbar {
                justify-content: space-between;
            }
        }
        
        /* Toggle button */
        #sidebarToggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #4a4b65;
        }
        
        @media (max-width: 992px) {
            #sidebarToggle {
                display: block;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="sidebar-header">
            <h4 class="mb-0">Consultoría Bytekod</h4>
        </div>
        <div class="position-sticky pt-3">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#clientes" data-bs-toggle="tab">
                        <i class="fas fa-user-plus"></i> Registrar Cliente
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#servicios" data-bs-toggle="tab">
                        <i class="fas fa-cogs"></i> Agregar Servicios
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href='../login.php'>
                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Topbar -->
        <div class="topbar">
            <button id="sidebarToggle" class="btn">
                <i class="fas fa-bars"></i>
            </button>
            <h1 class="h4 mb-0">Dashboard Administrativo</h1>
        </div>

        <!-- Welcome Message -->
        <div class="welcome-message">
            <h4><i class="fas fa-user-shield"></i> ¡Hola <?php echo $_SESSION['nombre']; ?>!</h4>
            <p class="mb-0">Has iniciado sesión correctamente como administrador.</p>
        </div>

        <!-- Tabs Content -->
        <div class="tab-content">
            <!-- Registrar Cliente -->
            <div class="tab-pane fade show active" id="clientes">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-user-plus me-2"></i>Registrar Nuevo Cliente</h5>
                    </div>
                    <div class="card-body">
                        <form action="../registro_cliente.php" method="POST">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nombre_cliente" class="form-label">Nombre Completo</label>
                                    <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email_cliente" class="form-label">Correo Electrónico</label>
                                    <input type="email" class="form-control" id="email_cliente" name="email_cliente" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="usuario_cliente" class="form-label">Usuario</label>
                                    <input type="text" class="form-control" id="usuario_cliente" name="usuario_cliente" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="pwd_cliente" class="form-label">Contraseña</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="pwd_cliente" name="pwd_cliente" required>
                                        <button class="btn btn-outline-secondary toggle-password" type="button">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Registrar Cliente
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Agregar Servicios -->
            <div class="tab-pane fade" id="servicios">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-cogs me-2"></i>Agregar Nuevo Servicio</h5>
                    </div>
                    <div class="card-body">
                        <form action="../agregar_servicio.php" method="POST">
                            <div class="mb-3">
                                <label for="nombre_servicio" class="form-label">Nombre del Servicio</label>
                                <input type="text" class="form-control" id="nombre_servicio" name="nombre_servicio" required>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion_servicio" class="form-label">Descripción</label>
                                <textarea class="form-control" id="descripcion_servicio" name="descripcion_servicio" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-plus-circle me-2"></i>Agregar Servicio
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Scripts personalizados -->
    <script>
        // Toggle sidebar en móviles
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('show');
        });
        
        // Cerrar sidebar al hacer clic en un enlace en móviles
        if (window.innerWidth < 992) {
            document.querySelectorAll('.sidebar .nav-link').forEach(function(link) {
                link.addEventListener('click', function() {
                    document.querySelector('.sidebar').classList.remove('show');
                });
            });
        }
        
        // Mostrar/ocultar contraseña
        document.querySelectorAll('.toggle-password').forEach(function(button) {
            button.addEventListener('click', function() {
                const input = this.previousElementSibling;
                const icon = this.querySelector('i');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
        
        // Cambiar pestaña activa en el sidebar
        document.querySelectorAll('.nav-link').forEach(function(link) {
            link.addEventListener('click', function() {
                document.querySelectorAll('.nav-link').forEach(function(el) {
                    el.classList.remove('active');
                });
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>