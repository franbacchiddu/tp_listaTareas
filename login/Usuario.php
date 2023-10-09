<?php
class Usuario {
    private $conn;

    public function __construct($db) {
        $this->conn = $db->getConnection();
    }

    public function existeNombreUsuario($nombre_usuario) {
    $sql = "SELECT COUNT(*) FROM usuarios WHERE nombre_usuario = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$nombre_usuario]);
    $count = $stmt->fetchColumn();

    return $count > 0;
}

    public function registrar($nombre_usuario, $clave, $nombre, $apellido) {
        $clave = password_hash($clave, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO usuarios (nombre_usuario, clave, nombre, apellido) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$nombre_usuario, $clave, $nombre, $apellido]);
    }

    public function iniciarSesion($nombre_usuario, $clave) {
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE nombre_usuario = ?");
        $stmt->execute([$nombre_usuario]);
        $usuario = $stmt->fetch();

        if ($usuario && password_verify($clave, $usuario['clave'])) {
            return $usuario;
        } else {
            return false;
        }
    }

}
?>
