<?php
session_start();

// Redirigir si el usuario no está logueado
if (!isset($_SESSION["nombre"])) {
    header("Location: login.php");
    exit();
}

$nombre_usuario = $_SESSION["nombre"];
$email_usuario = $_SESSION["email"] ?? "";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Marron's Gym</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <nav class="navbar">
            <div class="nav-container">
                <div class="nav-logo">
                    <a href="index.php"><img src="img/logo.jpg" alt="Marron's Gym Logo" class="logo"></a>
                </div>
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a href="ejercicios.php" class="nav-link">Ejercicios</a>
                    </li>
                    <li class="nav-item">
                        <a href="dieta.php" class="nav-link">Dieta Saludable</a>
                    </li>
                    <li class="nav-item">
                        <a href="perfil.php" class="nav-link">Mi Perfil</a>
                    </li>
                    <li class="nav-item">
                        <a href="mas-opciones.php" class="nav-link">Más Opciones</a>
                    </li>
                </ul>
                <div class="nav-user">
                    <div class="user-dropdown">
                        <button class="user-btn">
                            <i class="fas fa-user-circle"></i>
                            <?php echo htmlspecialchars($nombre_usuario); ?>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a href="perfil.php"><i class="fas fa-user"></i> Mi Perfil</a>
                            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Dashboard Content -->
    <main class="dashboard-main">
        <div class="container">
            <div class="dashboard-header">
                <h1 class="dashboard-title">¡Bienvenido, <span class="highlight"><?php echo htmlspecialchars($nombre_usuario); ?></span>!</h1>
                <p class="dashboard-subtitle">Aquí tienes tu panel de control personalizado</p>
            </div>

            <div class="dashboard-grid">
                <div class="dashboard-card">
                    <div class="card-icon"><i class="fas fa-dumbbell"></i></div>
                    <div class="card-content">
                        <h3>Entrenamientos</h3>
                        <p class="card-number">12</p>
                        <p class="card-text">Completados este mes</p>
                    </div>
                </div>

                <div class="dashboard-card">
                    <div class="card-icon"><i class="fas fa-fire"></i></div>
                    <div class="card-content">
                        <h3>Calorías</h3>
                        <p class="card-number">2,450</p>
                        <p class="card-text">Quemadas esta semana</p>
                    </div>
                </div>

                <div class="dashboard-card">
                    <div class="card-icon"><i class="fas fa-trophy"></i></div>
                    <div class="card-content">
                        <h3>Objetivos</h3>
                        <p class="card-number">8/10</p>
                        <p class="card-text">Metas alcanzadas</p>
                    </div>
                </div>

                <div class="dashboard-card">
                    <div class="card-icon"><i class="fas fa-calendar-check"></i></div>
                    <div class="card-content">
                        <h3>Asistencia</h3>
                        <p class="card-number">85%</p>
                        <p class="card-text">Este mes</p>
                    </div>
                </div>
            </div>

            <div class="dashboard-sections">
                <div class="section-card">
                    <h3><i class="fas fa-chart-line"></i> Tu Progreso</h3>
                    <div class="progress-chart">
                        <p>Gráfico de progreso aquí</p>
                    </div>
                </div>

                <div class="section-card">
                    <h3><i class="fas fa-calendar-alt"></i> Próximas Clases</h3>
                    <div class="upcoming-classes">
                        <div class="class-item">
                            <span class="class-time">10:00 AM</span>
                            <span class="class-name">Yoga Matutino</span>
                        </div>
                        <div class="class-item">
                            <span class="class-time">2:00 PM</span>
                            <span class="class-name">Entrenamiento Funcional</span>
                        </div>
                        <div class="class-item">
                            <span class="class-time">6:00 PM</span>
                            <span class="class-name">Spinning</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
