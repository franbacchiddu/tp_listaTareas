<?php
try{
$conn= new PDO ('mysql:host=localhost;dbname=apptodolist','root', '');
}catch(PDOException $e){
echo "Error de conexión" .$e->getMessage();
}

$sql="SELECT * FROM tareas";
$registros=$conn->query($sql);

