<?php
class ClaseTarea {
    private $conn;

    public function __construct($db) {
        $this->conn = $db->getConnection();
    }

    public function agregarTarea($tarea, $completado, $fecha, $categoria, $nombre_usuario) {
        $stmt = $this->conn->prepare("INSERT INTO tareas (tarea, completado, fecha, categoria, nombre_usuario) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$tarea, $completado, $fecha, $categoria, $nombre_usuario]);
    }

    public function obtenerTareaPorNombreUsuario($nombre_usuario, $tarea) {
        $stmt = $this->conn->prepare("SELECT * FROM tareas WHERE nombre_usuario = ? AND tarea = ?");
        $stmt->execute([$nombre_usuario, $tarea]);
        return $stmt->fetch();
    }

    public function obtenerTareasPorNombreUsuario($nombre_usuario) {
        $stmt = $this->conn->prepare("SELECT * FROM tareas WHERE nombre_usuario = ?");
        $stmt->execute([$nombre_usuario]);
        return $stmt->fetchAll();
    }
}
?>

