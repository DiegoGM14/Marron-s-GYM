<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'administrador') {
    header("Location: ../login.php");
    exit();
}

include("../conectbd.php");
$conexion = obtenerConexion();
$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    $tipo = $conexion->real_escape_string($_POST['tipo'] ?? '');
    $precio = floatval($_POST['precio'] ?? 0);
    $id = intval($_POST['id'] ?? 0);

    if ($action == 'add' && $tipo && $precio > 0) {
        $stmt = $conexion->prepare("INSERT INTO membresias (tipo, precio) VALUES (?, ?)");
        $stmt->bind_param("sd", $tipo, $precio);
        $mensaje = $stmt->execute() ? "Membresía agregada correctamente." : "Error al agregar.";
    }

    if ($action == 'edit' && $id) {
        $stmt = $conexion->prepare("UPDATE membresias SET tipo=?, precio=? WHERE id=?");
        $stmt->bind_param("sdi", $tipo, $precio, $id);
        $mensaje = $stmt->execute() ? "Membresía actualizada correctamente." : "Error al actualizar.";
    }

    if ($action == 'delete' && $id) {
        $stmt = $conexion->prepare("DELETE FROM membresias WHERE id=?");
        $stmt->bind_param("i", $id);
        $mensaje = $stmt->execute() ? "Membresía eliminada correctamente." : "Error al eliminar.";
    }
}

// Obtener membresías
$result = $conexion->query("SELECT * FROM membresias ORDER BY tipo");
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Configurar Membresías - Marron's Gym</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
<h2>💳 Configurar Membresías y Precios</h2>
<?php if($mensaje): ?>
    <div class="alert alert-info"><?php echo htmlspecialchars($mensaje); ?></div>
<?php endif; ?>

<form method="POST" class="row g-3 mb-4">
    <input type="hidden" name="action" value="add">
    <div class="col-md-6"><label>Tipo de Membresía</label><input type="text" name="tipo" class="form-control" required></div>
    <div class="col-md-6"><label>Precio (MXN)</label><input type="number" step="0.01" name="precio" class="form-control" required></div>
    <div class="col-12"><button type="submit" class="btn btn-success">Agregar Membresía</button></div>
</form>

<h4>Membresías Actuales</h4>
<table class="table table-striped">
<thead><tr><th>Tipo</th><th>Precio</th><th>Acciones</th></tr></thead>
<tbody>
<?php while($row = $result->fetch_assoc()): ?>
<tr>
    <td><?php echo htmlspecialchars($row['tipo']); ?></td>
    <td><?php echo number_format($row['precio'],2); ?></td>
    <td>
        <form style="display:inline;" method="POST">
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta membresía?')">Eliminar</button>
        </form>
        <!-- Para editar, se puede implementar un modal o página aparte -->
    </td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
<a href="dashboard.php" class="btn btn-secondary">← Volver al Dashboard</a>
</div>
</body>
</html>
