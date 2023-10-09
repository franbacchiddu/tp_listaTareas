<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <form action="procesar_login.php" method="post">
        <label for="nombre_usuario">Nombre de Usuario:</label>
        <input type="text" name="nombre_usuario" required><br>
        
        <label for="clave">Contraseña:</label>
        <input type="password" name="clave" required><br>

        <input type="submit" value="Iniciar Sesión">
        <p>No tienes una cuenta? <a href="register.php">Regístrate aquí</a></p>
    </form>
</body>
</html>
