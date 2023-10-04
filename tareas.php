<?php
try{
$conn= new PDO ('mysql:host=localhost;dbname=apptodolist','root', '');
}catch(PDOException $e){
echo "Error de conexión" .$e->getMessage();
}

//Actualizar estado tarea

if(isset($_POST['id'])){
    $id=$_POST['id'];
    $completado=(isset($_POST['completado']))?1:0;
    $sql = "UPDATE tareas SET completado=? WHERE id=?";
    $sentencia =$conn->prepare($sql);
    $sentencia->execute([$completado, $id]);

}

//Agregar tareas

if(isset($_POST['agregar_tarea']))
{
    $tarea = $_POST['tarea'];
    $fecha = $_POST['fecha']; 
    $categoria = $_POST['categoria']; 
    $sql = 'INSERT INTO tareas (tarea, fecha, categoria) VALUES (?, ?, ?)'; 
    $sentencia = $conn->prepare($sql);
    $sentencia->execute([$tarea, $fecha, $categoria]);
}

//Eliminar tareas

if(isset($_GET ['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM tareas WHERE id=?";
    $sentencia =$conn->prepare($sql);
    $sentencia->execute([$id]);
}


$sql="SELECT * FROM tareas";
$registros=$conn->query($sql);

