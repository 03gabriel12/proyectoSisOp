<?php
include 'db.php';
include 'correo.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $verification_code = bin2hex(random_bytes(16));

    $stmt = $pdo->prepare("INSERT INTO users (username, email, password, verification_code) VALUES (?, ?, ?, ?)");
    $stmt->execute([$username, $email, $password, $verification_code]);

    $verification_link = "http://localhost/Proyecto%20Final%20Sistema%20de%20Usuario/verify.php?code=$verification_code";

    $subject = "Verificacion de cuenta";
    //$message = "Hola $username ,password :  {$_POST["password"]}, haz clic en el siguiente enlace para verificar tu cuenta: <a href='$verification_link'> ingrese al enlace para verificar su correo</a> <br><br>";

    $message = "
        <html>
        <head>
        <link rel='stylesheet' href='./sass/Style.css'>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h1>Verificación de Cuenta</h1>
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

    $array_email = array('username' => $username, 'link' => $verification_link, 'password' => $_POST["password"]);
    //$html = include 'correo_html.php';

    echo EnviarCorreo($email, $subject, $html);
    echo "Registro exitoso. Revisa tu correo para verificar tu cuenta.";
}
