<?php
session_start();

// Solo propietarios
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'propietario') {
    header("Location: ../login.php");
    exit();
}

include("../conectbd.php");
$conexion = obtenerConexion();

// Aquí obtendremos datos de ejemplo de la base de datos
$ingresos = 0;
$egresos = 0;
$total_membresias = 0;

if ($conexion) {
    // Ejemplo: sumar todas las membresías pagadas
    $res = $conexion->query("SELECT SUM(monto) as total_ingresos FROM membresias");
    if ($res && $row = $res->fetch_assoc()) $ingresos = $row['total_ingresos'];

    // Ejemplo: sumar egresos del gimnasio
    $res2 = $conexion->query("SELECT SUM(monto) as total_egresos FROM egresos");
    if ($res2 && $row2 = $res2->fetch_assoc()) $egresos = $row2['total_egresos'];

    // Total de membresías activas
    $res3 = $conexion->query("SELECT COUNT(*) as total_membresias FROM usuarios1 WHERE rol='usuario'");
    if ($res3 && $row3 = $res3->fetch_assoc()) $total_membresias = $row3['total_membresias'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes Financieros - Marron's Gym</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-4">
        <h2 class="mb-4">📊 Reportes Financieros</h2>

        <div class="row">
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

        <div class="mt-4">
            <a href="dashboard.php" class="btn btn-secondary">← Volver al panel</a>
        </div>
    </div>
</body>
</html>
