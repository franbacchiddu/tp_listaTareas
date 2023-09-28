<?php include ("tareas.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRUEBAS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<header>
    <!--HEADER-->
    <h1>En este repositorio solo se hacen pruebas</h1>
</header>

    <main class="container">
        <br>
        <div class ="card">
            <div class = "card-header">
                Lista de tareas (To Do List)
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
            <ul class="list-group">
                <?php foreach ($registros as $registro) : ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="checked">
                        <label class="form-check-label" for="checked"><?php echo $registro['tarea']; ?></label>
                    </div>
                    <div class="d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="ms-2">Fecha: <?php echo $registro['fecha']; ?></div>
                        <div class="ms-2">Categoría: <?php echo $registro['categoria']; ?></div>
                        <span class="badge bg-danger ms-2">x</span>
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
    <footer>
        <!--FOOTER ACÁ-->
</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>