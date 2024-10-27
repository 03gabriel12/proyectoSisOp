<?php
session_start();
include 'db.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION["is_admin"]) {
    echo "<h1>Lista de Usuarios</h1>";

    $stmt = $pdo->query("SELECT username, email, is_verified FROM users");
    while ($row = $stmt->fetch()) {
        echo "Usuario: " . $row["username"] . " | Correo: " . $row["email"] . " | Verificado: " . ($row["is_verified"] ? "Sí" : "No") . "<br>";
    }
} else {
    echo "<h1>Bienvenido a tu cuenta</h1>";
    echo "<p>¡Gracias por iniciar sesión, " . htmlspecialchars($_SESSION["user_id"]) . "!</p>";
}
?>
