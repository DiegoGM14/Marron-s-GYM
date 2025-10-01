<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'administrador') {
    header("Location: ../login.php");
    exit();
}

include("../conectbd.php");
$conexion = obtenerConexion();
$mensaje = "";

// Agregar o actualizar horarios
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    $dia = $conexion->real_escape_string($_POST['dia'] ?? '');
    $hora_inicio = $conexion->real_escape_string($_POST['hora_inicio'] ?? '');
    $hora_fin = $conexion->real_escape_string($_POST['hora_fin'] ?? '');
    $rutina = $conexion->real_escape_string($_POST['rutina'] ?? '');
    $id = intval($_POST['id'] ?? 0);

    if ($action == 'add' && $dia && $hora_inicio && $hora_fin && $rutina) {
        $stmt = $conexion->prepare("INSERT INTO horarios (dia, hora_inicio, hora_fin, rutina) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $dia, $hora_inicio, $hora_fin, $rutina);
        $mensaje = $stmt->execute() ? "Horario agregado correctamente." : "Error al agregar horario.";
    }

    if ($action == 'edit' && $id) {
        $stmt = $conexion->prepare("UPDATE horarios SET dia=?, hora_inicio=?, hora_fin=?, rutina=? WHERE id=?");
        $stmt->bind_param("ssssi", $dia, $hora_inicio, $hora_fin, $rutina, $id);
        $mensaje = $stmt->execute() ? "Horario actualizado correctamente." : "Error al actualizar horario.";
    }

    if ($action == 'delete' && $id) {
        $stmt = $conexion->prepare("DELETE FROM horarios WHERE id=?");
        $stmt->bind_param("i", $id);
        $mensaje = $stmt->execute() ? "Horario eliminado correctamente." : "Error al eliminar horario.";
    }
}

// Obtener horarios existentes
$result = $conexion->query("SELECT * FROM horarios ORDER BY FIELD(dia,'Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo'), hora_inicio");
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Gestionar Horarios - Marron's Gym</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
<h2>🕒 Gestionar Horarios y Rutinas</h2>
<?php if($mensaje): ?>
    <div class="alert alert-info"><?php echo htmlspecialchars($mensaje); ?></div>
<?php endif; ?>

<form method="POST" class="row g-3 mb-4">
    <input type="hidden" name="action" value="add">
    <div class="col-md-3">
        <label>Dia</label>
        <select name="dia" class="form-control" required>
            <option value="">Selecciona un día</option>
            <option>Lunes</option><option>Martes</option><option>Miércoles</option>
            <option>Jueves</option><option>Viernes</option><option>Sábado</option><option>Domingo</option>
        </select>
    </div>
    <div class="col-md-3"><label>Hora Inicio</label><input type="time" name="hora_inicio" class="form-control" required></div>
    <div class="col-md-3"><label>Hora Fin</label><input type="time" name="hora_fin" class="form-control" required></div>
    <div class="col-md-3"><label>Rutina</label><input type="text" name="rutina" class="form-control" placeholder="Nombre de la rutina" required></div>
    <div class="col-12"><button type="submit" class="btn btn-primary">Agregar Horario</button></div>
</form>

<h4>Horarios Actuales</h4>
<table class="table table-striped">
    <thead>
        <tr><th>Día</th><th>Inicio</th><th>Fin</th><th>Rutina</th><th>Acciones</th></tr>
    </thead>
    <tbody>
    <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['dia']); ?></td>
            <td><?php echo htmlspecialchars($row['hora_inicio']); ?></td>
            <td><?php echo htmlspecialchars($row['hora_fin']); ?></td>
            <td><?php echo htmlspecialchars($row['rutina']); ?></td>
            <td>
                <!-- Form Edit -->
                <form style="display:inline;" method="POST">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este horario?')">Eliminar</button>
                </form>
                <!-- Edit modal could be implemented con JS/Bootstrap, por simplicidad usamos página aparte -->
            </td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>
<a href="dashboard.php" class="btn btn-secondary">← Volver al Dashboard</a>
</div>
</body>
</html>
