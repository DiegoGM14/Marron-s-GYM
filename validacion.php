<?php
session_start();

if (!isset($_SESSION['rol']) || !isset($_SESSION['nombre'])) {
    header("Location: login.php");
    exit();
}

$nombre = htmlspecialchars($_SESSION['nombre']);
$rol = htmlspecialchars($_SESSION['rol']);

switch ($rol) {
    case 'usuario':
        echo "👤 Bienvenido $nombre - Acceso a rutinas y dietas.";
        break;

    case 'coach':
        echo "💪 Bienvenido Coach $nombre - Gestión de clientes y rutinas.";
        break;

    case 'propietario':
        echo "🏠 Bienvenido Propietario $nombre - Acceso a reportes y administración general.";
        break;

    case 'administrador':
        echo "🛡️ Bienvenido Administrador $nombre - Control total del sistema.";
        break;

    default:
        // Rol no válido
        session_destroy();
        header("Location: login.php");
        exit();
}
?>
