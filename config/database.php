<?php
class Database {
    private $host = "ANDER\\SQLEXPRESS";
    private $db_name = "prueba_gma";
    private $conn;

    public function connect() {
        try {
            $this->conn = new PDO("sqlsrv:Server={$this->host};Database={$this->db_name}");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}
