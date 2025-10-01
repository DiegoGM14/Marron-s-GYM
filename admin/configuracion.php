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
<title>Configuración Avanzada - Marron's Gym</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <h2>⚙️ Configuración Avanzada - Administrador <?php echo htmlspecialchars($nombre); ?></h2>
    <p>Opciones avanzadas del sistema para gestión integral del gimnasio.</p>

    <div class="row mt-4">
        <!-- Políticas de Seguridad -->
        <div class="col-md-6">
            <div class="card shadow mb-3">
                <div class="card-body">
                    <h5 class="card-title">Políticas de Seguridad y Contraseñas</h5>
                    <p>Configura requisitos de contraseñas, bloqueo de usuarios y accesos.</p>
                    <a href="seguridad.php" class="btn btn-primary">Configurar Seguridad</a>
                </div>
            </div>
        </div>

        <!-- Notificaciones -->
        <div class="col-md-6">
            <div class="card shadow mb-3">
                <div class="card-body">
                    <h5 class="card-title">Notificaciones y Alertas</h5>
                    <p>Programa alertas para clientes y coaches sobre rutinas y pagos.</p>
                    <a href="notificaciones.php" class="btn btn-success">Configurar Notificaciones</a>
                </div>
            </div>
        </div>

        <!-- Parametrización de Rutinas y Horarios -->
        <div class="col-md-6">
            <div class="card shadow mb-3">
                <div class="card-body">
                    <h5 class="card-title">Parametrización de Rutinas y Horarios</h5>
                    <p>Gestiona reglas generales de rutinas, horarios y límites de clases.</p>
                    <a href="gestion_horarios.php" class="btn btn-warning">Gestionar Horarios</a>
                </div>
            </div>
        </div>

        <!-- Backups y Exportación -->
        <div class="col-md-6">
            <div class="card shadow mb-3">
                <div class="card-body">
                    <h5 class="card-title">Backups y Exportación de Datos</h5>
                    <p>Genera copias de seguridad de la base de datos y exporta información.</p>
                    <a href="backups.php" class="btn btn-dark">Realizar Backup / Exportar</a>
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
