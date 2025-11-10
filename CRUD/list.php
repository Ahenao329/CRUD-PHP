<?php
include '../conection/conection.php';

try {
    $stmt = $conn->prepare("{CALL sp_ListarEmpleados}");
    $stmt->execute();
    $empleados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table border='1'>
    <tr><th>Nombre</th><th>Correo</th><th>Cargo</th><th>Salario</th><th>Hijos</th><th>Acciones</th></tr>";

    foreach ($empleados as $row) {
        echo "<tr>
                <td>{$row['Nombre']}</td>
                <td>{$row['Correo']}</td>
                <td>{$row['Cargo']}</td>
                <td>{$row['Salario']}</td>
                <td>{$row['Hijos']}</td>
                <td>
                    <button class='editar'
                        data-id='{$row['Id']}'
                        data-nombre='{$row['Nombre']}'
                        data-email='{$row['Correo']}'
                        data-cargo='{$row['Cargo']}'
                        data-salario='{$row['Salario']}'>Editar</button>
                    <button class='eliminar' data-id='{$row['Id']}'>Eliminar</button>
                </td>
            </tr>";
    }

    echo "</table>";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
