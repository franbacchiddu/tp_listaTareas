<?php
include("tareas.php");

if(isset($_GET['editar'])){
    $id = $_GET['editar'];
    $sql = "SELECT * FROM tareas WHERE id=?";
    $sentencia = $conn->prepare($sql);
    $sentencia->execute([$id]);
    $tarea = $sentencia->fetch();
}

if(isset($_POST['editar_tarea'])){
    $id = $_POST['id'];
    $tarea = $_POST['tarea'];
    $fecha = $_POST['fecha'];
    $categoria = $_POST['categoria'];
    $sql = "UPDATE tareas SET tarea=?, fecha=?, categoria=? WHERE id=?";
    $sentencia = $conn->prepare($sql);
    $sentencia->execute([$tarea, $fecha, $categoria, $id]);
    header("Location: home_todolist.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
<link rel="stylesheet" href="editar_tarea.css">    
</head>
<body>
<div class="container">
<form action="" method="post">
<h1>Editar Tarea</h1>
<div class="form-group">
                    <input type="hidden" name="id" value="<?php echo $tarea['id']; ?>">
                    <label for="tarea" class="form-label">Tarea:</label>
                    <input type="text" class="form-control" name="tarea" id="tarea" value="<?php echo $tarea['tarea']; ?>"><br>
                    <label for="fecha" class="form-label">Fecha:</label>
                    <input type="date" class="form-control" name="fecha" id="fecha" value="<?php echo $tarea['fecha']; ?>"><br>
                    <div class="categoria">
                    <label for="categoria" class="form-label">Categoría:</label>
                    <select class="form-select" name="categoria" id="categoria">
                            <option value="laboral" <?php echo ($tarea['categoria'] == 'laboral') ? 'selected' : ''; ?>>Laboral</option>
                            <option value="domestica" <?php echo ($tarea['categoria'] == 'domestica') ? 'selected' : ''; ?>>Doméstica</option>
                            <option value="escolar" <?php echo ($tarea['categoria'] == 'escolar') ? 'selected' : ''; ?>>Escolar</option>
                            <option value="personal" <?php echo ($tarea['categoria'] == 'personal') ? 'selected' : ''; ?>>Personal</option>
                            <option value="otro" <?php echo ($tarea['categoria'] == 'otro') ? 'selected' : ''; ?>>Otro</option>
                    </select>
                    <br>
                    <br>
                    </div>
                    <div class=btns>
                    <input name="editar_tarea" id="editar_tarea" class="btn btn-primary" type="submit" value="Editar tarea"> 
                    <input name="cancelar_editar_tarea" id="cancelar_editar_tarea" class="btn btn-primary" type="button" onclick="cancelarAccion()" value="Cancelar">
    <script>
        function cancelarAccion() {
            window.location.href = 'home_todolist.php';;
        }
    </script>
                    </div>
            
        
        </div>
        </form>
</div>
</body>
</html>

