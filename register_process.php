<?php
include 'db.php';
include 'correo.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $verification_code = bin2hex(random_bytes(16));

    // Usa una declaración preparada para evitar inyecciones SQL
    $stmt = $pdo->prepare("SELECT username FROM users WHERE username = :username");
    $stmt->execute([':username' => $username]);
    $usuario_validate = $stmt->fetchColumn(); // Si encuentra el usuario, lo devuelve

    if (empty($usuario_validate)) {
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, verification_code) VALUES (?, ?, ?, ?)");
        $stmt->execute([$username, $email, $password, $verification_code]);

        $verification_link = "http://localhost/Proyecto%20Final%20Sistema%20de%20Usuario/verify.php?code=$verification_code";

        $subject = "Verificacion de cuenta";
        $html = "
            <html>
            <head>
            <link rel='stylesheet' href='./sass/Style.css'>
            </head>
            <body>
                <div class='container'>
                    <div class='header'>
                        <h1>Verificacion de Cuenta</h1>
                    </div>
                    <div class='content'>
                        <p>Hola <strong>$username</strong>,</p>
                        <p>Tu contrasena es: <strong>{$_POST["password"]}</strong></p>
                        <p>Haz clic en el siguiente enlace para verificar tu cuenta:</p>
                        <p><a href='$verification_link'>Ingresa al enlace para verificar su correo</a></p>
                    </div>
                    <div class='footer'>
                        <p>&copy; " . date("Y") . " Tu Empresa. Todos los derechos reservados.</p>
                    </div>
                </div>
            </body>
            </html>
        ";

        EnviarCorreo($email, $subject, $html);
        $message = " Registro exitoso. Revisa tu correo para verificar tu cuenta.";
    } else {
        $message = "No se a podido registrar usuario !invalido ";
    }
    // Redirigir con el mensaje
    header("Location: index.php?message=" . urlencode($message));
    exit();
}
