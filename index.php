<?php
session_start();

// Redireccionar al dashboard si el usuario ya ha iniciado sesión
if (isset($_SESSION["user_id"])) {
    header("Location: dashboard.php");
    exit();
}
?>

<?php include 'header.php' ?>


<h1 class="title-home title">Bienvenido al Sistema de Usuarios</h1>
<?php include 'sesion.php' ?>


<?php include 'footer.php' ?>