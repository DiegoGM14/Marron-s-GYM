<?php
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'administrador') {
    header("Location: ../login.php");
    exit();
}

$nombre = $_SESSION['nombre'];
$mensaje = "";

if (isset($_POST['backup'])) {
    // Aquí iría la lógica real de exportar la base de datos
    $mensaje = "Backup generado correctamente (simulado).";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Backups - Configuración Avanzada</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <h2>💾 Backups y Exportación de Datos - <?php echo htmlspecialchars($nombre); ?></h2>
    <?php if ($mensaje): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($mensaje); ?></div>
    <?php endif; ?>

    <form method="POST" class="mt-4">
        <button type="submit" name="backup" class="btn btn-dark">Generar Backup / Exportar Datos</button>
        <a href="configuracion.php" class="btn btn-secondary">← Volver</a>
    </form>
</div>
</body>
</html>
