<?php
session_start();
include 'db.php';

// $hashedPassword = password_hash('admin123', PASSWORD_DEFAULT);
// $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE username = 'admin'");
// $stmt->execute([$hashedPassword]);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    // var_dump($user["password"]);
    // die();
    if ($user && password_verify($password, $user["password"])) {
        if ($user["is_verified"]) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["is_admin"] = $user["is_admin"];
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Tu cuenta aún no ha sido verificada. Revisa tu correo.";
        }
    } else {
        echo "Usuario o contraseña incorrectos.";
    }
}
