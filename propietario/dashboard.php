<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'propietario') {
    header("Location: ../login.php");
    exit();
}
$nombre = $_SESSION['nombre'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Propietario</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-4">
    <h2 class="text-warning">Bienvenido Propietario <?php echo htmlspecialchars($nombre); ?></h2>
    <p>Control administrativo y reportes del gimnasio.</p>
    <div class="row">
      <!-- Reportes Financieros -->
      <div class="col-md-6">
        <div class="card shadow">
          <div class="card-body">
            <h5 class="card-title">Reportes Financieros</h5>
            <p class="card-text">Consulta ingresos, egresos y membresías.</p>
            <a href="reportes_financieros.php" class="btn btn-primary">Ver reportes</a>
          </div>
        </div>
      </div>

      <!-- Administración General -->
      <div class="col-md-6">
        <div class="card shadow">
          <div class="card-body">
            <h5 class="card-title">Administración General</h5>
            <p class="card-text">Gestión de coaches, usuarios y métricas globales.</p>
            <a href="admin_general.php" class="btn btn-success">Administrar</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Botón de salir -->
    <div class="text-center mt-4">
      <a href="../logout.php" class="btn btn-danger">Cerrar sesión</a>
    </div>
  </div>
</body>
</html>
