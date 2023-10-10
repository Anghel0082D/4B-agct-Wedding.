<?php
session_start(); // Iniciar la sesión

// Obtener las credenciales ingresadas por el usuario
$nombre_usuario = $_POST['nombre_usuario'];
$contrasena = $_POST['contrasena'];

// Conectar a la base de datos (reemplaza con tus propios datos)
$conexion = new mysqli('localhost', 'usuario_db', 'contrasena_db', 'nombre_base_de_datos');

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error en la conexión a la base de datos: " . $conexion->connect_error);
}

// Consulta para verificar las credenciales en la base de datos
$sql = "SELECT * FROM usuarios WHERE nombre_usuario = '$nombre_usuario' AND contrasena = '$contrasena'";
$resultado = $conexion->query($sql);

// Verificar si se encontró un usuario con las credenciales proporcionadas
if ($resultado->num_rows == 1) {
    // Iniciar sesión y redirigir al usuario
    $_SESSION['nombre_usuario'] = $nombre_usuario;
    header("Location: inicio.php"); // Reemplaza "inicio.php" con la página a la que deseas redirigir al usuario después de iniciar sesión
} else {
    // Si las credenciales son incorrectas, mostrar un mensaje de error
    echo "Credenciales incorrectas. <a href='login.php'>Intentar nuevamente</a>";
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>