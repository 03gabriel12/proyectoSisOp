<?php
$servername = "localhost";
$username = "root";  // Cambia según tu configuración
$password = "";      // Cambia según tu configuración
$dbname = "sistema_usuarios";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>
