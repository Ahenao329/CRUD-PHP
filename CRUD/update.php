<?php
include '../conection/conection.php';

$id = $_POST['id'] ?? null;
$nombre = $_POST['nombre'] ?? null;
$email = $_POST['email'] ?? null;
$cargo = $_POST['cargo'] ?? null;
$salario = $_POST['salario'] ?? null;

if ($id && $nombre && $email && $cargo && $salario) {
    try {
        $stmt = $conn->prepare("UPDATE Employe 
                                SET Nombre = ?, Email = ?, Cargo = ?, Salario = ? 
                                WHERE Id = ?");
        $stmt->execute([$nombre, $email, $cargo, $salario, $id]);
        echo "✅ Empleado actualizado correctamente.";
    } catch (PDOException $e) {
        echo "❌ Error al actualizar empleado: " . $e->getMessage();
    }
} else {
    echo "⚠️ Todos los campos son obligatorios.";
}
?>
