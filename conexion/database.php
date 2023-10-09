<?php
include_once('config.php');

class Database {
    private $conn;

    public function __construct() {
        global $host, $dbname, $username, $password; // Añade esta línea

        try {
            $this->conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>
