<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'administrador') {
    header("Location: login.php");
    exit();
}
$nombre = $_SESSION['nombre'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Administrador</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-4">
    <h2 class="text-danger">🛡️ Bienvenido Administrador <?php echo $nombre; ?></h2>
    <p>Control total del sistema.</p>
    <div class="row">
      <div class="col-md-3">
        <div class="card shadow">
          <div class="card-body">
            <h5 class="card-title">Usuarios</h5>
            <p class="card-text">Gestiona cuentas de usuarios y roles.</p>
            <a href="#" class="btn btn-primary">Ver usuarios</a>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card shadow">
          <div class="card-body">
            <h5 class="card-title">Seguridad</h5>
            <p class="card-text">Configura accesos y políticas de seguridad.</p>
            <a href="#" class="btn btn-danger">Configurar</a>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card shadow">
          <div class="card-body">
            <h5 class="card-title">Reportes</h5>
            <p class="card-text">Visualiza métricas globales del sistema.</p>
            <a href="#" class="btn btn-warning">Ver reportes</a>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card shadow">
          <div class="card-body">
            <h5 class="card-title">Administración General</h5>
            <p class="card-text">Configuración completa del gimnasio.</p>
            <a href="#" class="btn btn-success">Administrar</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
