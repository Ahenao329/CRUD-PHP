<?php
include '../conection/conection.php';

$id = $_POST['id'] ?? null;

if ($id) {
    try {
        $stmt = $conn->prepare("DELETE FROM Employe WHERE Id = :id");
        $stmt->execute([$id]);
        echo "✅ Empleado eliminado correctamente.";
    } catch (PDOException $e) {
        echo "❌ Error al eliminar empleado: " . $e->getMessage();
    }
} else {
    echo "⚠️ ID no recibido.";
}
?>
