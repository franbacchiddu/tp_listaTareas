<?php
include("../conexion/config.php");
include("../conexion/database.php");
include("Usuario.php");


$database = new Database();
$usuario = new Usuario($database);

session_start(); // Inicia la sesión

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_usuario = $_POST['nombre_usuario'];
    $clave = $_POST['clave'];

    $usuarioEncontrado = $usuario->iniciarSesion($nombre_usuario, $clave);

    if ($usuarioEncontrado) {
        $_SESSION['nombre_usuario'] = $nombre_usuario; // Almacena el nombre de usuario en la sesión
        header("Location:../home_todolist.php"); // Redirige a la página principal
        exit();
    } else {
        echo "Nombre de usuario o contraseña incorrectos.";
    }
}
?>
