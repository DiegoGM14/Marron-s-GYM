<?php
session_start();
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
<title>Mi Perfil - Marron's Gym</title>
<link rel="stylesheet" href="css/styles.css">
<link rel="stylesheet" href="css/dashboard.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<header class="header">
<nav class="navbar">
<div class="nav-container">
    <div class="nav-logo">
        <a href="index.php"><img src="img/logo.jpg" alt="Marron's Gym Logo" class="logo"></a>
    </div>
    <ul class="nav-menu">
        <li class="nav-item"><a href="index.php" class="nav-link">Inicio</a></li>
        <li class="nav-item"><a href="ejercicios.php" class="nav-link">Ejercicios</a></li>
        <li class="nav-item"><a href="dieta.php" class="nav-link">Dieta Saludable</a></li>
        <li class="nav-item"><a href="perfil.php" class="nav-link active">Mi Perfil</a></li>
        <li class="nav-item"><a href="mas-opciones.php" class="nav-link">Más Opciones</a></li>
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

<main class="dashboard-main">
<div class="container">
<h1 class="dashboard-title">Mi Perfil</h1>
<p>Información de tu cuenta:</p>

<div class="dashboard-grid">
    <div class="dashboard-card">
        <div class="card-icon"><i class="fas fa-user"></i></div>
        <div class="card-content">
            <h3>Nombre</h3>
            <p><?php echo htmlspecialchars($nombre_usuario); ?></p>
        </div>
    </div>
    <div class="dashboard-card">
        <div class="card-icon"><i class="fas fa-envelope"></i></div>
        <div class="card-content">
            <h3>Email</h3>
            <p><?php echo htmlspecialchars($email_usuario); ?></p>
        </div>
    </div>
</div>

<a href="index.php" class="btn btn-outline mt-3">← Regresar al Inicio</a>
</div>
</main>
</body>
</html>
