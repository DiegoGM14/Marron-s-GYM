<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'coach') {
    header("Location: ../login.php");
    exit();
}

include("../conectbd.php");
$conexion = obtenerConexion();

// Obtener todos los seguimientos con nombre del cliente, rutina y dieta
$seguimientos = [];
if ($conexion) {
    $res = $conexion->query("
        SELECT s.id, u.nombre AS cliente, r.nombre AS rutina, d.nombre AS dieta, 
               s.fecha, s.estado, s.observaciones
        FROM seguimiento s
        LEFT JOIN usuarios1 u ON s.id_cliente = u.id
        LEFT JOIN rutinas r ON s.id_rutina = r.id
        LEFT JOIN dietas d ON s.id_dieta = d.id
        ORDER BY s.fecha DESC
    ");
    if ($res) while($row = $res->fetch_assoc()) $seguimientos[] = $row;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Seguimiento - Coach</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <h2 class="text-success">📊 Seguimiento de Clientes</h2>

    <table class="table table-bordered table-striped shadow">
        <thead class="bg-warning text-dark"> <!-- Mismo color que el botón de seguimiento -->
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Rutina</th>
                <th>Dieta</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Observaciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($seguimientos as $s): ?>
            <tr>
                <td><?php echo $s['id']; ?></td>
                <td><?php echo htmlspecialchars($s['cliente']); ?></td>
                <td><?php echo htmlspecialchars($s['rutina']); ?></td>
                <td><?php echo htmlspecialchars($s['dieta']); ?></td>
                <td><?php echo $s['fecha']; ?></td>
                <td><?php echo htmlspecialchars($s['estado']); ?></td>
                <td><?php echo htmlspecialchars($s['observaciones']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="dashboard.php" class="btn btn-secondary">← Volver al dashboard</a>
</div>
</body>
</html>
