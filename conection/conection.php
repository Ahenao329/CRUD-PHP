<?php
try {
    $serverName = "ANDER\\SQLEXPRESS";
    $database = "prueba_gma";

    $conn = new PDO("sqlsrv:Server=$serverName;Database=$database");
    // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("❌ Error de conexión: " . $e->getMessage());
}
?>
