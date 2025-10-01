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
    <title>Administración General - Marron's Gym</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <h2 class="text-info">⚙️ Administración General</h2>
    <p>Opciones avanzadas de configuración del gimnasio.</p>

    <div class="row mt-4">
        <!-- Horarios y Rutinas Globales -->
        <div class="col-md-6 mb-3">
            <div class="card shadow h-100">
                <div class="card-body">
                    <h5 class="card-title">Gestionar Horarios y Rutinas</h5>
                    <p>Define horarios, días de entrenamiento y rutinas globales del gimnasio.</p>
                    <a href="gestion_horarios.php" class="btn btn-primary">Gestionar</a>
                </div>
            </div>
        </div>

        <!-- Configuración de Membresías -->
        <div class="col-md-6 mb-3">
            <div class="card shadow h-100">
                <div class="card-body">
                    <h5 class="card-title">Configurar Membresías y Precios</h5>
                    <p>Define tipos de membresía, precios y promociones.</p>
                    <a href="config_membresias.php" class="btn btn-success">Configurar</a>
                </div>
            </div>
        </div>

        <!-- Métricas y Estadísticas -->
        <div class="col-md-12 mb-3">
            <div class="card shadow h-100">
                <div class="card-body">
                    <h5 class="card-title">Revisar Métricas y Estadísticas</h5>
                    <p>Visualiza ingresos, egresos, miembros activos y rendimiento general del gimnasio.</p>
                    <a href="reportes_admin.php" class="btn btn-warning">Ver métricas</a>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="dashboard.php" class="btn btn-secondary">← Volver al Dashboard</a>
    </div>
</div>
</body>
</html>
