<?php
session_start();

// Redireccionar al dashboard si el usuario ya ha iniciado sesión
if (isset($_SESSION["user_id"])) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal - Sistema de Usuarios</title>
</head>
<body>
    <h1>Bienvenido al Sistema de Usuarios</h1>
    <p>Por favor, elige una opción:</p>
    <a href="register.php">Registrarse</a> |
    <a href="login.php">Iniciar Sesión</a>
</body>
</html>
