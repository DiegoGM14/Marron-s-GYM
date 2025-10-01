<?php
session_start();

// Solo administradores
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'administrador') {
    header("Location: ../login.php");
    exit();
}

$nombre = $_SESSION['nombre'];
$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Aquí iría la lógica real para guardar políticas de seguridad
    $longitud = intval($_POST['longitud']);
    $requerir_especiales = isset($_POST['especiales']) ? 1 : 0;
    $intentos_max = intval($_POST['intentos']);

    $mensaje = "Políticas guardadas: longitud mínima $longitud, caracteres especiales: " . ($requerir_especiales ? 'Sí' : 'No') . ", intentos fallidos máximos: $intentos_max.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Seguridad - Configuración Avanzada</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <h2>🔒 Políticas de Seguridad - <?php echo htmlspecialchars($nombre); ?></h2>
    <?php if ($mensaje): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($mensaje); ?></div>
    <?php endif; ?>

    <form method="POST" class="mt-4">
        <div class="mb-3">
            <label>Longitud mínima de contraseña:</label>
            <input type="number" name="longitud" class="form-control" value="8" required>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="especiales" class="form-check-input" id="especiales">
            <label class="form-check-label" for="especiales">Requerir caracteres especiales</label>
        </div>
        <div class="mb-3">
            <label>Intentos fallidos máximos:</label>
            <input type="number" name="intentos" class="form-control" value="5" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Políticas</button>
        <a href="configuracion.php" class="btn btn-secondary">← Volver</a>
    </form>
</div>
</body>
</html>
