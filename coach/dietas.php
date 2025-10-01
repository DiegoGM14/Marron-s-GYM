<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'coach') {
    header("Location: ../login.php");
    exit();
}

include("../conectbd.php");
$conexion = obtenerConexion();
$id_coach = $_SESSION['id']; // ID del coach logueado

// Crear dieta
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear'])) {
    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $descripcion = $conexion->real_escape_string($_POST['descripcion']);
    $objetivo = $conexion->real_escape_string($_POST['objetivo']);

    $conexion->query("INSERT INTO dietas (nombre, descripcion, objetivo, id_coach, creado_en) 
                      VALUES ('$nombre', '$descripcion', '$objetivo', $id_coach, NOW())");
}

// Eliminar dieta
if (isset($_GET['eliminar'])) {
    $id = intval($_GET['eliminar']);
    $conexion->query("DELETE FROM dietas WHERE id = $id AND id_coach = $id_coach");
}

// Obtener todas las dietas del coach
$dietas = [];
$res = $conexion->query("SELECT id, nombre, descripcion, objetivo, creado_en 
                         FROM dietas WHERE id_coach = $id_coach ORDER BY creado_en DESC");
if ($res) while ($row = $res->fetch_assoc()) $dietas[] = $row;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dietas - Coach</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <h2 class="text-success">🥗 Gestión de Dietas</h2>

    <!-- Formulario Crear Dieta -->
    <div class="card mb-4 shadow">
        <div class="card-body">
            <h5 class="card-title">Crear nueva dieta</h5>
            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Objetivo</label>
                    <input type="text" name="objetivo" class="form-control">
                </div>
                <button type="submit" name="crear" class="btn btn-success">Crear Dieta</button>
            </form>
        </div>
    </div>

    <!-- Lista de dietas -->
    <h4>📋 Mis Dietas</h4>
    <table class="table table-bordered table-striped mt-3">
        <thead class="table-success">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Objetivo</th>
                <th>Creado en</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dietas as $d): ?>
            <tr>
                <td><?php echo $d['id']; ?></td>
                <td><?php echo htmlspecialchars($d['nombre']); ?></td>
                <td><?php echo htmlspecialchars($d['objetivo']); ?></td>
                <td><?php echo $d['creado_en']; ?></td>
                <td>
                    <a href="dietas.php?eliminar=<?php echo $d['id']; ?>" 
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('¿Seguro que deseas eliminar esta dieta?');">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="dashboard.php" class="btn btn-secondary mt-3">← Volver al Dashboard</a>
</div>
</body>
</html>
