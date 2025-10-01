<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$mensaje = "";

// Conexión
include("conectbd.php");
$conexion = obtenerConexion();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $password = trim($_POST['password']);

    if (empty($nombre) || empty($password)) {
        $mensaje = "Todos los campos son obligatorios";
    } else {
        $sql = "SELECT * FROM usuarios1 WHERE nombre = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $nombre);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $usuario = $resultado->fetch_assoc();
            $hash = $usuario['password'];
            $login_ok = false;

            if (password_verify($password, $hash)) {
                $login_ok = true;
            } elseif ($password === $hash) {
                $login_ok = true;
                // Rehash a bcrypt
                $nuevoHash = password_hash($password, PASSWORD_DEFAULT);
                $upd = $conexion->prepare("UPDATE usuarios1 SET password=? WHERE id=?");
                $upd->bind_param("si", $nuevoHash, $usuario['id']);
                $upd->execute();
            }

            if ($login_ok) {
                $_SESSION["usuario_id"] = $usuario['id'];
                $_SESSION["nombre"] = $usuario['nombre'];
                $_SESSION["rol"] = $usuario['rol'];

                // Redirección según rol
                switch ($usuario['rol']) {
                    case 'administrador':
                        header("Location: admin/dashboard.php"); break;
                    case 'coach':
                        header("Location: coach/dashboard.php"); break;
                    case 'propietario':
                        header("Location: propietario/dashboard.php"); break;
                    case 'usuario':
                        header("Location: usuarios/dashboard.php"); break;
                    default:
                        $mensaje = "Rol no definido";
                }
                exit();
            } else {
                $mensaje = "Contraseña incorrecta";
            }

        } else {
            $mensaje = "Usuario no encontrado";
        }

        $stmt->close();
    }
    $conexion->close();
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Marron's Gym</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/auth.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>
<body class="auth-body">
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <img src="img/logo.jpg" alt="Marron's Gym Logo" class="auth-logo">
                <h2 class="auth-title">Iniciar Sesión</h2>
                <p class="auth-subtitle">Accede a tu entrenamiento personalizado</p>
            </div>

            <?php if (!empty($mensaje)): ?>
                <div class="alert alert-<?php echo $tipo_mensaje; ?>">
                    <i class="fas fa-<?php echo $tipo_mensaje == 'success' ? 'check-circle' : 'exclamation-circle'; ?>"></i>
                    <?php echo htmlspecialchars($mensaje); ?>
                </div>
            <?php endif; ?>

            <form class="auth-form" method="POST" action="login.php">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre" required value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : ''; ?>">
                    <i class="fas fa-user form-icon"></i>
                </div>

                <div class="form-group password-wrapper">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>
                    <i class="fas fa-lock form-icon"></i>
                    <button type="button" class="toggle-password" onclick="togglePassword()">
                        <i class="fas fa-eye" id="eye-icon"></i>
                    </button>
                </div>

                <button type="submit" class="btn btn-primary btn-auth">
                    <i class="fas fa-sign-in-alt"></i>
                    Iniciar Sesión
                </button>
            </form>

            <div class="auth-footer">
                <p>¿No tienes cuenta? <a href="registro.php" class="auth-link">Regístrate aquí</a></p>
                <p><a href="index.php" class="auth-link">← Volver al inicio</a></p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const eyeIcon = document.getElementById("eye-icon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }
    </script>
</body>
</html>
