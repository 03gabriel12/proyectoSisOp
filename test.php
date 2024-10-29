<?php
include 'correo.php';
$array_email = array('username' => 'Usuario de Prueba', 'link' => '#', 'password' => 'prueba_123@');

echo EnviarCorreo('leandro.rodriguez@utp.ac.pa', 'correo de testeo', 'correo_html.php',$array_email, true);

//ob_start();
// include 'correo_html.php';
// $html = ob_get_clean();