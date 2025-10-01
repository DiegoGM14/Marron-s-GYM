<?php
session_start();

// Solo coaches
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'coach') {
    header("Location: ../login.php");
    exit();
}

$nombre = $_SESSION['nombre'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Coach - Marron's Gym</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <h2 class="text-success">🏋️ Bienvenido Coach <?php echo htmlspecialchars($nombre); ?></h2>
    <p>Gestión de clientes, rutinas, dietas y seguimiento personalizado.</p>

    <div class="row mt-4">
        <!-- Clientes -->
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card shadow h-100">
                <div class="card-body">
                    <h5 class="card-title">Clientes</h5>
                    <p>Revisa y gestiona la información de tus clientes.</p>
                    <a href="clientes.php" class="btn btn-primary w-100">Ver clientes</a>
                </div>
            </div>
        </div>

        <!-- Rutinas -->
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card shadow h-100">
                <div class="card-body">
                    <h5 class="card-title">Rutinas</h5>
                    <p>Crea y modifica rutinas personalizadas.</p>
                    <a href="rutinas.php" class="btn btn-success w-100">Gestionar rutinas</a>
                </div>
            </div>
        </div>

        <!-- Dietas -->
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card shadow h-100">
                <div class="card-body">
                    <h5 class="card-title">Dietas</h5>
                    <p>Asigna y modifica planes alimenticios a tus clientes.</p>
                    <a href="dietas.php" class="btn btn-warning w-100">Gestionar dietas</a>
                </div>
            </div>
        </div>

        <!-- Seguimiento -->
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card shadow h-100">
                <div class="card-body">
                    <h5 class="card-title">Seguimiento</h5>
                    <p>Visualiza el progreso y métricas de tus clientes.</p>
                    <a href="seguimiento.php" class="btn btn-info w-100">Ver seguimiento</a>
                </div>
            </div>
        </div>

        <!-- Asignar Rutina y Dieta -->
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card shadow h-100">
                <div class="card-body">
                    <h5 class="card-title">Asignar Rutina y Dieta</h5>
                    <p>Asigna rutinas y dietas a tus clientes de manera rápida y sencilla.</p>
                    <a href="asignar.php" class="btn btn-primary w-100">Asignar</a>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="../logout.php" class="btn btn-danger">Cerrar sesión</a>
    </div>
</div>
</body>
</html>
