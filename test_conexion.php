<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Prueba de Conexión - Marron's Gym</h2>";
echo "<p>Probando conexión con tu configuración específica...</p>";

// Incluir archivo de conexión
if (file_exists("conectbd.php")) {
    echo "<p>✓ Archivo conectbd.php encontrado</p>";
    
    include("conectbd.php");
    
    $conexion = obtenerConexion();
    
    if ($conexion) {
        echo "<p style='color: green;'>✓ Conexión a base de datos exitosa</p>";
        echo "<p>Base de datos: ejasyjrp_marrongym</p>";
        echo "<p>Usuario: ejasyjrp_marrongym</p>";
        
        // Verificar si la tabla existe
        $result = $conexion->query("SHOW TABLES LIKE 'usuarios1'");
        if ($result->num_rows > 0) {
            echo "<p style='color: green;'>✓ Tabla 'usuarios1' existe</p>";
            
            // Contar usuarios
            $result = $conexion->query("SELECT COUNT(*) as total FROM usuarios1");
            $row = $result->fetch_assoc();
            echo "<p>Total de usuarios registrados: " . $row['total'] . "</p>";
            
            // Mostrar estructura de la tabla
            $result = $conexion->query("DESCRIBE usuarios1");
            echo "<h3>Estructura de la tabla usuarios1:</h3>";
            echo "<table border='1' style='border-collapse: collapse;'>";
            echo "<tr style='background: #f0f0f0;'><th>Campo</th><th>Tipo</th><th>Nulo</th><th>Clave</th><th>Default</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['Field'] . "</td>";
                echo "<td>" . $row['Type'] . "</td>";
                echo "<td>" . $row['Null'] . "</td>";
                echo "<td>" . $row['Key'] . "</td>";
                echo "<td>" . ($row['Default'] ?? 'NULL') . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            
        } else {
            echo "<p style='color: red;'>❌ Tabla 'usuarios1' no existe</p>";
            echo "<p>Creando tabla...</p>";
            
            $sql = "CREATE TABLE usuarios1 (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nombre VARCHAR(100) NOT NULL UNIQUE,
                email VARCHAR(150) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                activo BOOLEAN DEFAULT TRUE
            )";
            
            if ($conexion->query($sql)) {
                echo "<p style='color: green;'>✓ Tabla 'usuarios1' creada exitosamente</p>";
                
                // Insertar usuario de prueba
                $stmt = $conexion->prepare("INSERT INTO usuarios1 (nombre, email, password) VALUES (?, ?, ?)");
                $nombre = "admin";
                $email = "admin@marronsgym.com";
                $password = "admin123";
                $stmt->bind_param("sss", $nombre, $email, $password);
                
                if ($stmt->execute()) {
                    echo "<p style='color: green;'>✓ Usuario de prueba creado (admin/admin123)</p>";
                }
            } else {
                echo "<p style='color: red;'>❌ Error al crear tabla: " . $conexion->error . "</p>";
            }
        }
        
        $conexion->close();
    } else {
        echo "<p style='color: red;'>❌ Error de conexión a la base de datos</p>";
        echo "<p>Verifica las credenciales en conectbd.php</p>";
    }
} else {
    echo "<p style='color: red;'>❌ Archivo conectbd.php no encontrado</p>";
}

echo "<h3>Información del servidor:</h3>";
echo "<p>PHP Version: " . phpversion() . "</p>";
echo "<p>MySQLi Extension: " . (extension_loaded('mysqli') ? 'Disponible' : 'No disponible') . "</p>";

echo "<br><p><a href='index.php'>← Volver al inicio</a></p>";
echo "<p><a href='registro.php'>Ir a Registro</a> | <a href='login.php'>Ir a Login</a></p>";
?>
