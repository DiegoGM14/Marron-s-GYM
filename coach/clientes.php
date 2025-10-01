<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'coach') {
    header("Location: ../login.php");
    exit();
}

include("../conectbd.php");
$conexion = obtenerConexion();

// Obtener todos los clientes
$clientes = [];
if ($conexion) {
    $res = $conexion->query("SELECT id, nombre, email, creado_en FROM usuarios1");
    if ($res) while($row = $res->fetch_assoc()) $clientes[] = $row;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clientes - Coach</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <h2 class="text-success">📋 Gestión de Clientes</h2>

    <table class="table table-bordered table-striped shadow">
        <thead class="bg-primary text-white"> <!-- Aquí aplicamos el color del botón -->
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Creado en</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($clientes as $c): ?>
            <tr>
                <td><?php echo $c['id']; ?></td>
                <td><?php echo htmlspecialchars($c['nombre']); ?></td>
                <td><?php echo htmlspecialchars($c['email']); ?></td>
                <td><?php echo $c['creado_en']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="dashboard.php" class="btn btn-primary">← Volver al dashboard</a>
</div>
</body>
</html>
