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
            <p>Hola <strong><?php echo $array_email['username'] ?></strong>,</p>
            <p>Tu contrasena es: <strong><?php echo $array_email['password'] ?></strong></p>
            <p>Haz clic en el siguiente enlace para verificar tu cuenta:</p>
            <p><a href=<?php echo $array_email['link'] ?>>Ingresa al enlace para verificar su correo</a></p>
        </div>
        <div class='footer'>
            <p>&copy; <? echo date("Y") ?> Tu Empresa. Todos los derechos reservados.</p>
        </div>
    </div>
</body>

</html>