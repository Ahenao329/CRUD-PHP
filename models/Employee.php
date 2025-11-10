<?php
require_once __DIR__ . '/../config/database.php';

class Employee
{
    private $conn;
    private $table = "employe";

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // public function getAll() {
    //     $stmt = $this->conn->prepare("SELECT * FROM $this->table");
    //     $stmt->execute();
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    public function getAll()
    {
        try {
            $stmt = $this->conn->prepare("{CALL sp_ListarEmpleados}");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al obtener empleados: " . $e->getMessage());
        }
    }


    public function create($nombre, $email, $cargo, $salario)
    {
        $stmt = $this->conn->prepare("INSERT INTO $this->table (nombre, email, cargo, salario) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$nombre, $email, $cargo, $salario]);
    }

    public function update($id, $nombre, $email, $cargo, $salario)
    {
        $stmt = $this->conn->prepare("UPDATE $this->table SET nombre=?, email=?, cargo=?, salario=? WHERE id=?");
        return $stmt->execute([$nombre, $email, $cargo, $salario, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM $this->table WHERE id=?");
        return $stmt->execute([$id]);
    }
}
