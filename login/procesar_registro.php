<?php
include("../conexion/config.php");
include("../conexion/database.php");
include("Usuario.php");

$database = new Database(); // Inicializa la instancia de la clase Database
$usuario = new Usuario($database); // Pasa la instancia de Database a Usuario

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_usuario = $_POST['nombre_usuario'];
    $clave = $_POST['clave'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];

    // Verificar si el nombre de usuario ya existe
    if ($usuario->existeNombreUsuario($nombre_usuario)) {
        echo "El nombre de usuario ya está en uso. Por favor, elige otro.";
    } else {
        // Si el nombre de usuario no existe, intentar registrar
        if ($usuario->registrar($nombre_usuario, $clave, $nombre, $apellido)) {
            echo "Registro exitoso. ¡Ahora puedes <a href='login.html'>iniciar sesión</a>!";
        } else {
            echo "Error en el registro.";
        }
    }
}
