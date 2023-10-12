    <?php
    include("conexion/config.php");
    include("Filtro.php");

    $tareas = new Filtrar();
    session_start();


    if(isset($_POST['id'])){
        $id=$_POST['id'];
        $completado=(isset($_POST['completado']))?1:0;
        $sql = "UPDATE tareas SET completado=? WHERE id=?";
        $sentencia =$conn->prepare($sql);
        $sentencia->execute([$completado, $id]);

    }

    if(isset($_POST['agregar_tarea']))
    {
        $tarea = $_POST['tarea'];
        $fecha = $_POST['fecha']; 
        $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : ''; 
        $nombre_usuario = $_SESSION['nombre_usuario'];
        $sql = 'INSERT INTO tareas (tarea, fecha, categoria, nombre_usuario) VALUES (?, ?, ?, ?)'; 
        $sentencia = $conn->prepare($sql);
        $sentencia->execute([$tarea, $fecha, $categoria, $nombre_usuario]);
    }


    if(isset($_GET ['id'])){
        $id = $_GET['id'];
        $sql = "DELETE FROM tareas WHERE id=?";
        $sentencia =$conn->prepare($sql);
        $sentencia->execute([$id]);
    }


    if (isset($_POST['filtro_categoria'])) {
        $filtro_categoria = $_POST['filtro_categoria'];
        $nombre_usuario = $_POST['nombre_usuario'];
        if ($filtro_categoria !== "") {
            $sql = "SELECT * FROM tareas WHERE categoria=? AND nombre_usuario=?";
            $sentencia = $conn->prepare($sql);
            $sentencia->execute([$filtro_categoria, $nombre_usuario]);
            $registros = $sentencia->fetchAll();
            
            ob_start();
            foreach ($registros as $registro) {
                echo $tareas->generarHTMLTarea($registro);
            }
            
            $html_tareas = ob_get_clean();
            echo json_encode(['html' => $html_tareas]);
            exit;
        }
      
    }
    
    $sql="SELECT * FROM tareas";
    $registros=$conn->query($sql);
    
    ?>    
            
         


