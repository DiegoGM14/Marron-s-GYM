<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Solo coaches
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'coach') {
    header("Location: ../login.php");
    exit();
}

include("../conectbd.php");
$conexion = obtenerConexion();
if (!$conexion) die("Error: no se pudo conectar a la base de datos.");

$nombre = $_SESSION['nombre'];

// Obtener clientes
$clientes = [];
$res = $conexion->query("SELECT id, nombre, email FROM usuarios1 WHERE rol='usuario'");
if ($res) while($row = $res->fetch_assoc()) $clientes[] = $row;

// Obtener todas las rutinas
$rutinas = [];
$res = $conexion->query("SELECT id, nombre, objetivo FROM rutinas");
if ($res) while($row = $res->fetch_assoc()) $rutinas[] = $row;

// Obtener todas las dietas
$dietas = [];
$res = $conexion->query("SELECT id, nombre, objetivo FROM dietas");
if ($res) while($row = $res->fetch_assoc()) $dietas[] = $row;

// Insertar asignación
$mensaje = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_cliente = isset($_POST['id_cliente']) ? intval($_POST['id_cliente']) : 0;
    $id_rutina = isset($_POST['id_rutina']) ? intval($_POST['id_rutina']) : 0;
    $id_dieta = isset($_POST['id_dieta']) ? intval($_POST['id_dieta']) : 0;
    $observaciones = isset($_POST['observaciones']) ? $conexion->real_escape_string($_POST['observaciones']) : '';

    if ($id_cliente > 0 && $id_rutina > 0 && $id_dieta > 0) {
        $sql = "INSERT INTO seguimiento (id_cliente, id_rutina, id_dieta, fecha, estado, observaciones)
                VALUES ($id_cliente, $id_rutina, $id_dieta, CURDATE(), 'Activo', '$observaciones')";
        if ($conexion->query($sql)) {
            $mensaje = "<div class='alert alert-success'>✅ Asignación creada correctamente.</div>";
        } else {
            $mensaje = "<div class='alert alert-danger'>❌ Error SQL: " . $conexion->error . "</div>";
        }
    } else {
        $mensaje = "<div class='alert alert-warning'>❌ Debes seleccionar cliente, rutina y dieta.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asignar Rutina y Dieta - Coach</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <h2 class="text-success">➕ Asignar Rutina y Dieta</h2>
    <?php if ($mensaje) echo $mensaje; ?>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Cliente</label>
                    <select name="id_cliente" class="form-select" required>
                        <option value="">-- Selecciona un cliente --</option>
                        <?php foreach ($clientes as $c): ?>
                            <option value="<?php echo $c['id']; ?>">
                                <?php echo htmlspecialchars($c['nombre'])." (".$c['email'].")"; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Rutina</label>
                    <select name="id_rutina" class="form-select" required>
                        <option value="">-- Selecciona una rutina --</option>
                        <?php foreach ($rutinas as $r): ?>
                            <option value="<?php echo $r['id']; ?>">
                                <?php echo htmlspecialchars($r['nombre'])." - ".$r['objetivo']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Dieta</label>
                    <select name="id_dieta" class="form-select" required>
                        <option value="">-- Selecciona una dieta --</option>
                        <?php foreach ($dietas as $d): ?>
                            <option value="<?php echo $d['id']; ?>">
                                <?php echo htmlspecialchars($d['nombre'])." - ".$d['objetivo']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Observaciones</label>
                    <textarea name="observaciones" class="form-control" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-success">Asignar</button>
                <a href="dashboard.php" class="btn btn-secondary">← Volver al Dashboard</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
