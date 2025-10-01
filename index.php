<?php
session_start();
$usuario_logueado = isset($_SESSION["nombre"]);
$nombre_usuario = $_SESSION["nombre"] ?? "";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marron's Gym - Tu mejor elección</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <nav class="navbar">
            <div class="nav-container">
                <div class="nav-logo">
                    <img src="img/logo.jpg" alt="Marron's Gym Logo" class="logo">
                </div>
                <ul class="nav-menu">
    <li class="nav-item">
        <a href="#inicio" class="nav-link active">Inicio</a>
    </li>
    <?php if ($usuario_logueado): ?>
        <li class="nav-item">
            <a href="ejercicios.php" class="nav-link">Ejercicios</a>
        </li>
        <li class="nav-item">
            <a href="dieta.php" class="nav-link">Dieta Saludable</a>
        </li>
        <li class="nav-item">
            <a href="perfil.php" class="nav-link">Mi Perfil</a>
        </li>
    <?php endif; ?>
    <li class="nav-item dropdown">
        <a href="mas-opciones.php" class="nav-link">Más Opciones <i class="fas fa-chevron-down"></i></a>
    </li>
</ul>

                <div class="nav-buttons">
                    <?php if ($usuario_logueado): ?>
                        <div class="user-info">
                            <span>Hola, <?php echo htmlspecialchars($nombre_usuario); ?></span>
                            <a href="dashboard.php" class="btn btn-primary">Dashboard</a>
                            <a href="logout.php" class="btn btn-outline">Salir</a>
                        </div>
                    <?php else: ?>
                        <a href="login.php" class="btn btn-outline">Iniciar</a>
                        <a href="registro.php" class="btn btn-primary">Registrarse</a>
                    <?php endif; ?>
                </div>
                <div class="hamburger">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="inicio">
        <div class="hero-container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1 class="hero-title">
                        Bienvenido a <span class="highlight">Marron's Gym</span>, tu mejor elección
                    </h1>
                    <p class="hero-description">
                        Inicia sesión para acceder a tu entrenamiento personalizado y seguimiento de dieta. ¡Transforma tu cuerpo y mejora tu salud con nosotros!
                    </p>
                    <div class="hero-buttons">
                        <?php if ($usuario_logueado): ?>
                            <a href="dashboard.php" class="btn btn-primary btn-large">Mi Dashboard</a>
                            <a href="#caracteristicas" class="btn btn-outline btn-large">Explorar</a>
                        <?php else: ?>
                            <a href="login.php" class="btn btn-primary btn-large">Iniciar</a>
                            <a href="registro.php" class="btn btn-outline btn-large">Registrarse</a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="hero-image">
                    <img src="img/hero-gym.jpg" alt="Gimnasio Marron's" class="hero-img">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="caracteristicas">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">
                    Descubre las características que hacen de <span class="highlight">Marron's Gym</span> tu mejor opción.
                </h2>
            </div>
           <div class="features-grid">

    <!-- Tarjeta 1 -->
    <div class="feature-card">
        <div class="feature-image carousel">
            <div class="carousel-track">
                <img src="img/ring1.jpg" alt="Equipos de última generación">
                <img src="img/ring2.jpg" alt="Equipos de última generación">
                <img src="img/ring3.jpg" alt="Equipos de última generación">
                <img src="img/ring4.jpg" alt="Equipos de última generación">
            </div>
            <button class="carousel-btn prev">&#10094;</button>
            <button class="carousel-btn next">&#10095;</button>
        </div>
        <div class="feature-content">
            <h3 class="feature-title">Equipos de última generación para maximizar tu rendimiento y resultados.</h3>
            <p class="feature-description">En Marron's Gym, contamos con equipos modernos que se adaptan a tus necesidades.</p>
          <a href="#" onclick="window.location.href='index.php'" class="feature-link">
    Unirse <i class="fas fa-arrow-right"></i>
</a>
        </div>
    </div>

    <!-- Tarjeta 2 -->
    <div class="feature-card">
        <div class="feature-image carousel">
            <div class="carousel-track">
                <img src="img/coach.jpg" alt="Entrenador certificado">
                <img src="img/certificado.jpg" alt="Entrenador certificado">
            </div>
            <button class="carousel-btn prev">&#10094;</button>
            <button class="carousel-btn next">&#10095;</button>
        </div>
        <div class="feature-content">
            <h3 class="feature-title">Entrenadores certificados listos para ayudarte a alcanzar tus metas.</h3>
            <p class="feature-description">Nuestro entrenador está altamente capacitado para guiarte en tu viaje.</p>
            <a href="#" onclick="window.location.href='index.php'" class="feature-link">
    Conocer <i class="fas fa-arrow-right"></i>
</a>
        </div>
    </div>
                 <!-- Tarjeta 3 -->
    <div class="feature-card">
        <div class="feature-image carousel">
            <div class="carousel-track">
                <img src="img/horarios.jpg" alt="Clases">
                <img src="img/precios.jpg" alt="Clases">
            </div>
            <button class="carousel-btn prev">&#10094;</button>
            <button class="carousel-btn next">&#10095;</button>
        </div>
        <div class="feature-content">
            <h3 class="feature-title">Clases grupales o individuales.</h3>
            <p class="feature-description">Ofrecemos una amplia gama de horarios de clases.</p>
            <a href="#" onclick="window.location.href='index.php'" class="feature-link">
    Ver <i class="fas fa-arrow-right"></i>
</a>
        </div>
    </div>

</div>
    </section>

    <!-- Testimonial Section -->
    <section class="testimonial">
        <div class="container">
            <div class="testimonial-card">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <blockquote class="testimonial-quote">
                    "Desde que me uní a Marron's Gym, he transformado mi vida. El ambiente y el apoyo del equipo son inigualables."
                </blockquote>
                <div class="testimonial-author">
                    <div class="author-avatar">
                        <span>J</span>
                    </div>
                    <div class="author-info">
                        <h4 class="author-name">Juan Pérez</h4>
                        <p class="author-title">Cliente Satisfecho</p>
                        <div class="webflow-badge">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-main">
                    <div class="footer-brand">
                        <p class="footer-description">
                            Únete a nuestro boletín para estar al tanto de novedades y lanzamientos.
                        </p>
                        <div class="newsletter">
                            <input type="email" placeholder="Introduce tu correo" class="newsletter-input">
                            <button class="btn btn-primary">Suscribirse</button>
                        </div>
                        <p class="newsletter-disclaimer">
                            Al suscribirte, aceptas nuestra <a href="#">Política de Privacidad</a> y consientes recibir actualizaciones.
                        </p>
                    </div>
                    
                    <div class="footer-links">
                        <div class="footer-column">
                            <h4 class="footer-column-title">Ubicacion</h4>
                            <ul class="footer-link-list">
                                <li><a href="https://maps.app.goo.gl/1DoBvVY9ELQwvs5r6">Av 8 de Julio 2960, 18 de Marzo, 44960 Guadalajara, Jal.</a></li>
                            </ul>
                        </div>
                        
                        <div class="footer-column">
                            <h4 class="footer-column-title">Síguenos</h4>
                            <div class="social-links">
                                <a href="#" class="social-link">
                                    <i class="fab fa-facebook"></i> Facebook
                                </a>
                                <a href="#" class="social-link">
                                    <i class="fab fa-instagram"></i> Instagram
                                </a>
                                <a href="#" class="social-link">
                                    <i class="fab fa-twitter"></i> X
                                </a>
                                <a href="#" class="social-link">
                                    <i class="fab fa-linkedin"></i> LinkedIn
                                </a>
                                <a href="#" class="social-link">
                                    <i class="fab fa-youtube"></i> Youtube
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="footer-bottom">
                    <p class="copyright">2025 Relume. Todos los derechos reservados.</p>
                    <div class="footer-legal">
                        <a href="#">Política de Privacidad</a>
                        <a href="#">Términos de Servicio</a>
                        <a href="#">Configuración de Cookies</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>
