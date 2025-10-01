<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar que los campos no estén vacíos
    if (empty($_POST['nombre']) || empty($_POST['email']) || empty($_POST['password'])) {
        $error = "Todos los campos son obligatorios";
    } else {
        // Incluir conexión a base de datos
        if (file_exists("conectbd.php")) {
            include("conectbd.php");
            
            $conexion = obtenerConexion();
            
            if ($conexion) {
                $nombre = $conexion->real_escape_string(trim($_POST['nombre']));
                $email = $conexion->real_escape_string(trim($_POST['email']));
                $password = trim($_POST['password']); // No escapar aquí para hash

                // Verificar si el usuario ya existe
                $verificar = "SELECT * FROM usuarios1 WHERE email = ? OR nombre = ?";
                $stmt = $conexion->prepare($verificar);
                $stmt->bind_param("ss", $email, $nombre);
                $stmt->execute();
                $resultado_verificar = $stmt->get_result();

                if ($resultado_verificar->num_rows > 0) {
                    $error = "El usuario o email ya existe";
                } else {
                    // Hashear la contraseña antes de guardar
                    $password_hash = password_hash($password, PASSWORD_DEFAULT);

                    // Insertar nuevo usuario
                    $sql = "INSERT INTO usuarios1 (nombre, email, password) VALUES (?, ?, ?)";
                    $stmt = $conexion->prepare($sql);
                    $stmt->bind_param("sss", $nombre, $email, $password_hash);
                    
                    if ($stmt->execute()) {
                        $_SESSION["registro_exitoso"] = true;
                        $success = "Usuario registrado exitosamente. Redirigiendo a login...";
                        header("refresh:2;url=login.php");
                        exit();
                    } else {
                        $error = "Error al registrar usuario: " . $conexion->error;
                    }
                }
                $conexion->close();
            } else {
                $error = "Error de conexión a la base de datos";
            }
        } else {
            $error = "Archivo de conexión no encontrado";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Marron's Gym</title>
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
                <h2 class="auth-title">Crear Cuenta</h2>
                <p class="auth-subtitle">Únete a la familia Marron's Gym</p>
            </div>

            <?php if (!empty($error)): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <?php echo htmlspecialchars($success); ?>
                    <br><small>Redirigiendo al login...</small>
                </div>
            <?php endif; ?>

            <form class="auth-form" method="POST" action="registro.php">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre completo" required value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : ''; ?>">
                    <i class="fas fa-user form-icon"></i>
                </div>

                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" id="email" name="email" placeholder="Ingresa tu email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                    <i class="fas fa-envelope form-icon"></i>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Crea una contraseña" required>
                    <i class="fas fa-lock form-icon"></i>
                </div>

                <button type="submit" class="btn btn-primary btn-auth">
                    <i class="fas fa-user-plus"></i>
                    Crear Cuenta
                </button>
            </form>

            <div class="auth-footer">
                <p>¿Ya tienes cuenta? <a href="login.php" class="auth-link">Inicia sesión</a></p>
                <p><a href="index.php" class="auth-link">← Volver al inicio</a></p>
            </div>
        </div>
    </div>
</body>
</html>
