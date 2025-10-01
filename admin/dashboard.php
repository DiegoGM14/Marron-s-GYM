<?php
session_start();

// Solo administradores
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'administrador') {
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
    <title>Dashboard Administrador - Marron's Gym</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <h2 class="text-danger">🏠 Bienvenido Administrador <?php echo htmlspecialchars($nombre); ?></h2>
    <p>Control total del sistema, gestión de usuarios, coaches y métricas.</p>

    <div class="row mt-4">
        <!-- Usuarios -->
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card shadow h-100">
                <div class="card-body">
                    <h5 class="card-title">Usuarios</h5>
                    <p>Gestiona clientes y miembros del gimnasio.</p>
                    <a href="usuarios.php" class="btn btn-primary">Administrar usuarios</a>
                </div>
            </div>
        </div>

        <!-- Coaches -->
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card shadow h-100">
                <div class="card-body">
                    <h5 class="card-title">Coaches</h5>
                    <p>Gestiona coaches y sus rutinas asignadas.</p>
                    <a href="coaches.php" class="btn btn-success">Administrar coaches</a>
                </div>
            </div>
        </div>

        <!-- Métricas Generales -->
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card shadow h-100">
                <div class="card-body">
                    <h5 class="card-title">Métricas Generales</h5>
                    <p>Visualiza ingresos, egresos y membresías activas.</p>
                    <a href="reportes_admin.php" class="btn btn-warning">Ver métricas</a>
                </div>
            </div>
        </div>

        <!-- Administración General -->
        <div class="col-md-6 col-lg-6 mb-3">
            <div class="card shadow h-100">
                <div class="card-body">
                    <h5 class="card-title">Administración General</h5>
                    <p>Gestión completa del gimnasio y configuraciones globales.</p>
                    <a href="admin_general.php" class="btn btn-info">Administrar</a>
                </div>
            </div>
        </div>

        <!-- Configuración -->
        <div class="col-md-6 col-lg-6 mb-3">
            <div class="card shadow h-100">
                <div class="card-body">
                    <h5 class="card-title">Configuración</h5>
                    <p>Opciones avanzadas del sistema.</p>
                    <a href="configuracion.php" class="btn btn-dark">Configurar</a>
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
