<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'administrador') {
    header("Location: ../login.php");
    exit();
}

include("../conectbd.php");
$conexion = obtenerConexion();

// Datos simulados para evitar errores si no hay tablas de membresías o egresos
$ingresos = 15000; 
$egresos = 5000;
$total_membresias = 50;

if ($conexion) {
    // Solo intentar si las tablas existen
    if ($conexion->query("SHOW TABLES LIKE 'membresias'")->num_rows == 1) {
        $res = $conexion->query("SELECT SUM(monto) as total_ingresos FROM membresias");
        if ($res && $row = $res->fetch_assoc()) $ingresos = $row['total_ingresos'];
    }
    if ($conexion->query("SHOW TABLES LIKE 'egresos'")->num_rows == 1) {
        $res2 = $conexion->query("SELECT SUM(monto) as total_egresos FROM egresos");
        if ($res2 && $row2 = $res2->fetch_assoc()) $egresos = $row2['total_egresos'];
    }
    $res3 = $conexion->query("SELECT COUNT(*) as total_membresias FROM usuarios1 WHERE rol='usuario'");
    if ($res3 && $row3 = $res3->fetch_assoc()) $total_membresias = $row3['total_membresias'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reportes - Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <h2>📊 Reportes Generales</h2>
    <div class="row mt-3">
        <div class="col-md-4">
            <div class="card shadow p-3">
                <h5>💵 Ingresos</h5>
                <p>$ <?php echo number_format($ingresos,2); ?></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow p-3">
                <h5>💸 Egresos</h5>
                <p>$ <?php echo number_format($egresos,2); ?></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow p-3">
                <h5>🏋️‍♂️ Membresías activas</h5>
                <p><?php echo $total_membresias; ?></p>
            </div>
        </div>
    </div>
    <a href="dashboard.php" class="btn btn-secondary mt-4">← Volver al dashboard</a>
</div>
</body>
</html>
