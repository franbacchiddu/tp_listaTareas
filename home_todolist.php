<?php

include("conexion/config.php");
include("conexion/database.php");
include("tareas.php");
include("login/ClaseTarea.php");
include("login/Usuario.php");

$database = new Database();
$usuario = new Usuario($database);


if(!isset($_SESSION['nombre_usuario'])){
    header("Location: login.php");
    exit();
}

$nombre_usuario = $_SESSION['nombre_usuario'];

$stmt = $conn->prepare("SELECT nombre, apellido FROM usuarios WHERE nombre_usuario = ?");
$stmt->execute([$nombre_usuario]);
$registro = $stmt->fetch();

$nombre = $registro['nombre'];
$apellido = $registro['apellido'];

$tareas = new ClaseTarea($database);
$registros = $tareas->obtenerTareasPorNombreUsuario($nombre_usuario);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRUEBAS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@latest/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .tachado { text-decoration:line-through;}
        .icono-persona {
        margin-right: 130px; 
}

    </style>
</head>
<body>
<header>
    <!--HEADER-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Bienvenido/a <?php echo $nombre . " " . $apellido; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle icono-persona" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="login/logout.php">Cerrar Sesión</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
</header>
    <main class="container">
        <br>
        <div class ="card">
            <div class = "card-header">
                Agregue sus tareas:
            </div>
    <div class = "card-body">
            <div class="mb-3">
                <form action="" method="post">
                    <label for= "tarea" class="form-label">Tarea:</label>
                    <input type = "text" class="form-control" name= "tarea" id="tarea" aria-describedby="helpId" placeholder="Escriba su tarea"> <br>
                    <label for="fecha" class="form-label">Fecha:</label>
                    <input type="date" class="form-control" name="fecha" id="fecha"><br>
                    <label for="categoria" class="form-label">Categoría:</label>
                    <select class="form-select" name="categoria" id="categoria">
                        <option value="" disabled selected>Seleccione una categoría</option>
                        <option value="laboral">Laboral</option>
                        <option value="domestica">Doméstica</option>
                        <option value="escolar">Escolar</option>
                        <option value="personal">Personal</option>
                        <option value="otro">Otro</option>
        </select><br>
                    <input name = "agregar_tarea" id= "agregar_tarea" class="btn btn-primary" type="submit" value="Agregar tarea">
                </form>
            </div>
            <?php 
               if (isset($_POST['agregar_tarea'])) {
                $tarea = $_POST['tarea'];
                $completado = 0; 
                $fecha = $_POST['fecha'];
                $categoria = $_POST['categoria'];
                $nombre_usuario = $_SESSION['nombre_usuario']; 
            
                // Verificar si la tarea ya existe
                $tareas = new ClaseTarea($database);
                $tareaExistente = $tareas->obtenerTareaPorNombreUsuario($nombre_usuario, $tarea);
            
                if (!$tareaExistente) {
                    $tareas->agregarTarea($tarea, $completado, $fecha, $categoria, $nombre_usuario);  
                } else {
                    // La tarea ya existe (agregado por que se duplicaban tareas)
                }
            }                   
            ?>
          <div class="mb-3">
         <form action="" method="post" id="form_filtrado">
            <label for="filtro_categoria" class="form-label">Filtrar tarea por Categoría:</label>
                <select class="form-select" name="filtro_categoria" id="filtro_categoria">
                    <option value="" disabled selected>Seleccionar</option>
                    <option value="laboral">Laboral</option>
                    <option value="domestica">Doméstica</option>
                    <option value="escolar">Escolar</option>
                    <option value="personal">Personal</option>
                    <option value="otro">Otro</option>
                 </select>
                <input type="submit" class="btn btn-primary mt-2" value="Filtrar">
                <button class="btn btn-secondary mt-2" id="limpiar_filtro">Limpiar Filtro</button>    
         </form>
                </div>   
            <ul class="list-group" id="lista_tareas">
                <?php foreach ($registros as $registro) : ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <form class="form-check" action="" method="post">
                    <input type="hidden" name="id" value="<?php echo $registro['id'];?>">
                    <input type="hidden" name="nombre_usuario" value="<?php echo $nombre_usuario; ?>">
                    <input class="form-check-input" type="checkbox" name="completado" value="<?php echo $registro['completado'];?>" onChange="this.form.submit()" id="tarea_<?php echo $registro['id'];?>" <?php echo ($registro['completado']==1)?'checked':'';?>>               
                    <label class="form-check-label <?php echo ($registro['completado']==1) ? 'tachado' : ''; ?>" for="checked" style="<?php echo ($registro['completado']==1) ? 'text-decoration: line-through;' : ''; ?>"><?php echo $registro['tarea']; ?></label>
                    </form>
                    <div class="d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="ms-2">Fecha: <?php echo $registro['fecha']; ?></div>
                        <div class="ms-2">Categoría: <?php echo $registro['categoria']; ?></div>
                        <a href="editar_tarea.php?editar=<?php echo $registro['id']; ?>"><span class="badge bg-warning ms-2">Editar</span></a>
                        <a href="?id=<?php echo $registro['id'];?>"><span class="badge bg-danger ms-2">x</span></a>
                    </div>
                </div>
                </li>
                <?php endforeach; ?>
            </ul>
    </div>
    <div class = "card-footer text-muted">
    </div>
    </div>
    </main>
<script>
    document.getElementById('form_filtrado').addEventListener('submit', function(event) {
    event.preventDefault();
    var formData = new FormData(this);
    formData.append ('nombre_usuario' , '<?php echo $nombre_usuario;?>');
    fetch('tareas.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        var listaTareas = document.getElementById('lista_tareas');
        listaTareas.innerHTML = data.html; // Actualicé esta línea
    })
    .catch(error => console.error('Error:', error));
});
</script>
    <script>
        document.getElementById('limpiar_filtro').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('filtro_categoria').value = ''; 
        document.getElementById('form_filtrado').submit(); 
        });
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>