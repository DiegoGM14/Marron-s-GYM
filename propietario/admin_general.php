<?php
session_start();

// Solo propietarios
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'propietario') {
    header("Location: ../login.php");
    exit();
}

include("../conectbd.php");
$conexion = obtenerConexion();

// Obtener coaches y usuarios
$usuarios = [];
$coaches = [];

if ($conexion) {
    $resUsuarios = $conexion->query("SELECT id, nombre, email FROM usuarios1 WHERE rol='usuario'");
    if ($resUsuarios) while($row = $resUsuarios->fetch_assoc()) $usuarios[] = $row;

    $resCoaches = $conexion->query("SELECT id, nombre, email FROM usuarios1 WHERE rol='coach'");
    if ($resCoaches) while($row = $resCoaches->fetch_assoc()) $coaches[] = $row;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración General - Marron's Gym</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-4">
        <h2 class="mb-4">⚙️ Administración General</h2>

        <!-- Usuarios -->
        <h4>Usuarios</h4>
        <table class="table table-bordered shadow-sm mb-4">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($usuarios as $u): ?>
                <tr>
                    <td><?php echo $u['id']; ?></td>
                    <td><?php echo htmlspecialchars($u['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($u['email']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Coaches -->
        <h4>Coaches</h4>
        <table class="table table-bordered shadow-sm mb-4">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($coaches as $c): ?>
                <tr>
                    <td><?php echo $c['id']; ?></td>
                    <td><?php echo htmlspecialchars($c['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($c['email']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="mt-4">
            <a href="dashboard.php" class="btn btn-secondary">← Volver al panel</a>
        </div>
    </div>
</body>
</html>
