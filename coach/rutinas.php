<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'coach') {
    header("Location: ../login.php");
    exit();
}

include("../conectbd.php");
$conexion = obtenerConexion();

// Obtener todas las rutinas
$rutinas = [];
if ($conexion) {
    $res = $conexion->query("SELECT id, nombre, objetivo, creado_en FROM rutinas");
    if ($res) while($row = $res->fetch_assoc()) $rutinas[] = $row;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Rutinas - Coach</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <h2>🏋️ Gestión de Rutinas</h2>
    <a href="rutina_crear.php" class="btn btn-success mb-2">+ Crear nueva rutina</a>
    <table class="table table-bordered table-striped bg-white shadow">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Objetivo</th>
                <th>Creado en</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($rutinas as $r): ?>
            <tr>
                <td><?php echo $r['id']; ?></td>
                <td><?php echo htmlspecialchars($r['nombre']); ?></td>
                <td><?php echo htmlspecialchars($r['objetivo']); ?></td>
                <td><?php echo $r['creado_en']; ?></td>
                <td>
                    <a href="rutina_ver.php?id=<?php echo $r['id']; ?>" class="btn btn-primary btn-sm">Ver</a>
                    <a href="rutina_editar.php?id=<?php echo $r['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="dashboard.php" class="btn btn-secondary">← Volver al dashboard</a>
</div>
</body>
</html>
