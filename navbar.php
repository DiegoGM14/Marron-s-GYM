<?php
session_start();
$usuario_logueado = isset($_SESSION["nombre"]);
$nombre_usuario = $_SESSION["nombre"] ?? "";
?>

<header class="header">
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-logo">
                <img src="img/logo.jpg" alt="Marron's Gym Logo" class="logo">
            </div>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="index.php#inicio" class="nav-link active">Inicio</a>
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
                <?php else: ?>
                    <li class="nav-item">
                        <a href="login.php" class="nav-link">Ejercicios</a>
                    </li>
                    <li class="nav-item">
                        <a href="login.php" class="nav-link">Dieta Saludable</a>
                    </li>
                    <li class="nav-item">
                        <a href="login.php" class="nav-link">Mi Perfil</a>
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
