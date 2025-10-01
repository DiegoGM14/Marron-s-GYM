<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'administrador') {
    header("Location: ../login.php");
    exit();
}

include("../conectbd.php");
$conexion = obtenerConexion();

// Obtener coaches
$coaches = [];
if ($conexion) {
    $res = $conexion->query("SELECT id, nombre, email, creado_en FROM usuarios1 WHERE rol='coach'");
    if ($res) while($row = $res->fetch_assoc()) $coaches[] = $row;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Coaches - Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <h2>🏋️‍♂️ Gestión de Coaches</h2>
    <table class="table table-bordered table-striped mt-3">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Creado en</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($coaches as $c): ?>
            <tr>
                <td><?php echo $c['id']; ?></td>
                <td><?php echo htmlspecialchars($c['nombre']); ?></td>
                <td><?php echo htmlspecialchars($c['email']); ?></td>
                <td><?php echo $c['creado_en']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="dashboard.php" class="btn btn-secondary">← Volver al dashboard</a>
</div>
</body>
</html>
