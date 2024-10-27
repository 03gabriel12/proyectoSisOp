<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $verification_code = bin2hex(random_bytes(16));

    $stmt = $pdo->prepare("INSERT INTO users (username, email, password, verification_code) VALUES (?, ?, ?, ?)");
    $stmt->execute([$username, $email, $password, $verification_code]);

    $verification_link = "http://yourdomain.com/verify.php?code=$verification_code";

    $subject = "Verificación de cuenta";
    $message = "Hola $username, haz clic en el siguiente enlace para verificar tu cuenta: $verification_link";
    mail($email, $subject, $message);

    echo "Registro exitoso. Revisa tu correo para verificar tu cuenta.";
}
?>
