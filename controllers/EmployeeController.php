<?php
require_once __DIR__ . '/../models/Employee.php';

class EmployeeController {
    private $employee;

    public function __construct() {
        $this->employee = new Employee();
    }

    public function list() {
        try {
            $data = $this->employee->getAll();
            echo json_encode(['status' => 'success', 'data' => $data]);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function create($postData) {
        try {
            $this->employee->create(
                $postData['nombre'] ?? '',
                $postData['email'] ?? '',
                $postData['cargo'] ?? '',
                $postData['salario'] ?? 0
            );
            echo json_encode(['status' => 'success', 'message' => 'Empleado registrado correctamente']);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function update($postData) {
        try {
            $this->employee->update(
                $postData['id'] ?? 0,
                $postData['nombre'] ?? '',
                $postData['email'] ?? '',
                $postData['cargo'] ?? '',
                $postData['salario'] ?? 0
            );
            echo json_encode(['status' => 'success', 'message' => 'Empleado actualizado correctamente']);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function delete($postData) {
        try {
            $this->employee->delete($postData['id'] ?? 0);
            echo json_encode(['status' => 'success', 'message' => 'Empleado eliminado correctamente']);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}

// Invocación del controlador
$controller = new EmployeeController();
$action = $_GET['action'] ?? '';

if (method_exists($controller, $action)) {
    $controller->$action($_POST);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Acción no válida']);
}
