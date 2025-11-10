<?php
include '../conection/conection.php';

$nombre = $_POST['nombre'] ?? null;
$email = $_POST['email'] ?? null;
$cargo = $_POST['cargo'] ?? null;
$salario = $_POST['salario'] ?? null;

if ($nombre && $email && $cargo && $salario) {
    try {
        $stmt = $conn->prepare("INSERT INTO Employe (Nombre, Email, Cargo, Salario) VALUES (:nombre, :email, :cargo, :salario)");
        $stmt->execute([$nombre, $email, $cargo, $salario]);
        echo "✅ Empleado registrado correctamente.";
    } catch (PDOException $e) {
        echo "❌ Error al registrar empleado: " . $e->getMessage();
    }
} else {    
    echo "⚠️ Todos los campos son obligatorios.";
}
?>
