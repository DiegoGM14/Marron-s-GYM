<?php
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'administrador') {
    header("Location: ../login.php");
    exit();
}

$nombre = $_SESSION['nombre'];
$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tipo = $_POST['tipo'];
    $mensaje = $_POST['mensaje'];

    // Aquí iría la lógica para programar o enviar notificaciones
    $mensaje = "Notificación programada: [$tipo] $mensaje";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Notificaciones - Configuración Avanzada</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <h2>📣 Notificaciones y Alertas - <?php echo htmlspecialchars($nombre); ?></h2>
    <?php if ($mensaje): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($mensaje); ?></div>
    <?php endif; ?>

    <form method="POST" class="mt-4">
        <div class="mb-3">
            <label>Tipo de notificación:</label>
            <select name="tipo" class="form-control" required>
                <option value="Rutina">Rutina</option>
                <option value="Pago">Pago</option>
                <option value="General">General</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Mensaje:</label>
            <textarea name="mensaje" class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Programar Notificación</button>
        <a href="configuracion.php" class="btn btn-secondary">← Volver</a>
    </form>
</div>
</body>
</html>
