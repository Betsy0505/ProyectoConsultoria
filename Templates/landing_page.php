<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/landing_page.css">
    <title>Consultoría HTML - Soluciones Web Profesionales</title>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <nav>
                <a href="#" class="logo"><img src="../resources/logo.png" class="logo"></a>
                <button class="hamburger" id="hamburger-icon">
                    <i class="fas fa-bars"></i>
                </button>
                <ul class="nav-links">
                    <li><a href="#mision">Misión</a></li>
                    <li><a href="#vision">Visión</a></li>
                    <li><a href="#valores">Valores</a></li>
                    <li><a href="#servicios">Servicios</a></li>
                    <li><a href="#clientes">Clientes</a></li>
                    <li><a href="#contacto">Contacto</a></li>
                    <li><a href="../Templates/login.php" class="btn btn-outline">Ingresar</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero -->
    <section class="hero">
        <div class="container">
            <h1>Soluciones Web de Alto Impacto</h1>
            <p>Desarrollamos experiencias digitales excepcionales con código limpio, accesible y optimizado para resultados tangibles.</p>
            <div class="cta-container">
                <a href="#servicios" class="btn btn-primary">Nuestros Servicios</a>
                <a href="#contacto" class="btn btn-outline">Contactar Ahora</a>
            </div>
        </div>
    </section>

    <!-- Misión, Visión, Valores -->
    <section id="mision" class="about">
        <div class="container">
            <h2 class="section-title">Nuestra Esencia</h2>
            <div class="grid-3">
                <div class="card">
                    <h3>Misión</h3>
                    <p>Transformar ideas en experiencias digitales funcionales y hermosas, superando expectativas con cada línea de código.</p>
                </div>
                <div class="card">
                    <h3>Visión</h3>
                    <p>Ser referentes en desarrollo web innovador, donde la tecnología y el diseño convergen para crear soluciones memorables.</p>
                </div>
                <div class="card">
                    <h3>Valores</h3>
                    <p>Excelencia técnica, transparencia radical, mejora continua y pasión por los detalles que marcan la diferencia.</p>
                </div>
            </div>
        </div>
    </section>

    <?php
        // Incluir el archivo de conexión
        include '../Database/conexion.php';

        // Realizar la consulta para obtener los servicios
        $sql = "SELECT * FROM servicios";
        $resultado = $pdo->query($sql);

        // Asegurarnos de que la consulta fue exitosa y que hay resultados
        $servicios = $resultado->fetchAll(PDO::FETCH_ASSOC);
        
        // Verificar si la consulta devolvió resultados
        if (!$servicios) {
            echo "No se encontraron servicios disponibles.";
        }
    ?>

    <!-- Servicios -->
    <div id="servicios" class="services">
    <h2 class="section-title">Nuestros Servicios</h2>

    <!-- Verificar si hay servicios antes de iterar sobre ellos -->
    <?php if (!empty($servicios)): ?>
        <div class="service-container">
            <?php foreach ($servicios as $servicio): ?>
                <div class="servicio">
                    <!-- Mostrar el ícono -->
                    <div class="service-icon">
                        <?php echo $servicio['icono']; ?>
                    </div>
                    <!-- Mostrar el nombre y la descripción -->
                    <h3><?php echo htmlspecialchars($servicio['nombre']); ?></h3>
                    <p><?php echo htmlspecialchars($servicio['descripcion']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No hay servicios disponibles.</p>
    <?php endif; ?>
</div>


    <!-- Clientes -->
    <section id="clientes">
        <div class="container">
            <h2 class="section-title">Confían en Nosotros</h2>
            <div class="clients-grid">
                <img src="../resources/paymun2.jpg" alt="Paymun" class="client-logo">
                <img src="../resources/EscuelaNatacion.jpg" alt="EscuelaNatación" class="client-logo">
                <img src="../resources/bytekod.jpg" alt="Bytekod" class="client-logo">
                <img src="../resources/coreui-signet-white.png" alt="Sadvu" class="client-logo">
            </div>
        </div>
    </section>

    <!-- Contacto -->
<section id="contacto" class="contact">
    <div class="container">
        <h2 class="section-title">Hablemos de tu Proyecto</h2>
        <div class="contact-grid">
            <div class="contact-info">
                <h3>Información de Contacto</h3>
                <p><i class="fas fa-envelope"></i> Bytekodconsultoria@gmail.com</p>
                <p><i class="fas fa-phone"></i> +55 56 45 50 45 59</p>
                <p><i class="fas fa-map-marker-alt"></i> Estado de México, México</p>
                <p><i class="fas fa-clock"></i> Lunes a Viernes, 9:00 - 18:00</p>
            </div>
            <div class="contact-form">
                <form action="https://formspree.io/f/xdkeynzv" method="POST" id="contactForm">
                    <input type="hidden" name="_next" value="https://consultoria.bytekod.com/gracias.html">
                    <input type="text" name="_gotcha" style="display:none">
                    
                    <div class="input-group">
                        <input type="text" name="name" placeholder="Nombre Completo" required>
                        <input type="email" name="email" placeholder="Correo Electrónico" required>
                    </div>
                    <div class="input-group">
                        <input type="tel" name="phone" placeholder="Teléfono">
                        <input type="text" name="subject" placeholder="Asunto">
                    </div>
                    <textarea name="message" rows="5" placeholder="Cuéntanos sobre tu proyecto" required></textarea>
                    <button type="submit" class="btn btn-primary">
                        <span class="btn-text">Enviar Mensaje</span>
                        <span class="spinner" style="display:none;"></span>
                    </button>
                    <div id="formMessage" class="form-message"></div>
                </form>
            </div>
        </div>
    </div>
</section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>Bytekod</h3>
                    <p>Especialistas en desarrollo web frontend y consultoría HTML profesional.</p>
                </div>
                <div class="footer-column">
                    <h3>Servicios</h3>
                    <ul class="footer-links">
                        <li><a href="#servicios">Desarrollo Frontend</a></li>
                        <li><a href="#servicios">Optimización</a></li>
                        <li><a href="#servicios">Desarrollo de software</a></li>
                        <li><a href="#servicios">Aplicaciones móviles</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Empresa</h3>
                    <ul class="footer-links">
                        <li><a href="#mision">Misión y Visión</a></li>
                        <li><a href="#valores">Nuestros Valores</a></li>
                        <li><a href="#clientes">Casos de Éxito</a></li>
                        <li><a href="#contacto">Trabaja con Nosotros</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Legal</h3>
                    <ul class="footer-links">
                        <li><a href="#">Términos y Condiciones</a></li>
                        <li><a href="#">Política de Privacidad</a></li>
                        <li><a href="#">Cookies</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Síguenos</h3>
                    <div class="social-icons">
                        <a href="https://www.facebook.com/profile.php?id=61574809511465" target="_blank" class="social-icon" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.linkedin.com/feed/?trk=onboarding-landing" target="_blank" class="social-icon" aria-label="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="https://www.instagram.com/bytekodeconsultoria/" target="_blank" class="social-icon" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://wa.me/5645504559" target="_blank" class="social-icon" aria-label="WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                    <p style="margin-top: 20px; color: rgba(255,255,255,0.7);">Conéctate con nosotros</p>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2025 Bytekod. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
    
    <script>
    // Manejo del formulario de contacto
document.getElementById('contactForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const form = e.target;
    const submitButton = form.querySelector('button[type="submit"]');
    const btnText = submitButton.querySelector('.btn-text');
    const spinner = submitButton.querySelector('.spinner');
    const messageDiv = document.getElementById('formMessage');
    
    // Validación del honeypot (anti-spam)
    if (form.querySelector('[name="_gotcha"]').value) {
        return;
    }
    
    // Estado de carga
    btnText.textContent = 'Enviando...';
    spinner.style.display = 'inline-block';
    submitButton.disabled = true;
    messageDiv.textContent = '';
    messageDiv.className = 'form-message';
    messageDiv.style.display = 'none';
    
    try {
        const response = await fetch(form.action, {
            method: 'POST',
            body: new FormData(form),
            headers: {
                'Accept': 'application/json'
            }
        });
        
        if (response.ok) {
            // Éxito
            messageDiv.className = 'form-message success';
            messageDiv.textContent = '¡Gracias por contactarnos! Te responderemos pronto.';
            form.reset();
        } else {
            // Error de Formspree
            const data = await response.json();
            throw new Error(data.error || 'Error al enviar el mensaje');
        }
    } catch (error) {
        // Error de red o validación
        messageDiv.className = 'form-message error';
        messageDiv.textContent = error.message || 'Error de conexión. Por favor intenta nuevamente.';
        console.error('Error:', error);
    } finally {
        // Restaurar botón
        btnText.textContent = 'Enviar Mensaje';
        spinner.style.display = 'none';
        submitButton.disabled = false;
        messageDiv.style.display = 'block';
    }
});
<script>


</body>
</html>

<!-- https://www.consultoria.bytekod.com/ -->