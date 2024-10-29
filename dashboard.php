<?php
session_start();
include 'db.php';

// Establecer el tiempo de vida de la sesión en 5 minutos
$session_lifetime = 5 * 60; // 5 minutos en segundos

// Verificar si la sesión ha expirado
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $session_lifetime) {
    // Si ha pasado el tiempo de vida de la sesión, destruirla
    session_unset(); // Destruir todas las variables de sesión
    session_destroy(); // Destruir la sesión
    header("Location: index.php"); // Redirigir a la página de inicio de sesión
    exit();
}

// Actualizar el tiempo de la última actividad
$_SESSION['last_activity'] = time();

if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

$array_users = array();
$session = $_SESSION["is_admin"];
if ($session) {
    //echo "<h1>Lista de Usuarios</h1>";

    $stmt = $pdo->query("SELECT username, email, is_verified FROM users");
    while ($row = $stmt->fetch()) {
        $array_users[] = array("usuario" => $row["username"], "correo" => $row["email"], "verificado" => ($row["is_verified"] ? "Sí" : "No"));
    }
    // print_r($array_users);
    // die();
} else {
    $stmt = $pdo->query("SELECT username FROM users WHERE {$_SESSION["user_id"]}=id ");
    // var_dump($stmt);
    // die();
    while ($row = $stmt->fetch()) {
        $usuario = $row['username'];
    }
}

$count = 1;
?>

<?php include 'header.php' ?>

<div class="container-fluid <?php echo  $session ? '' : 'container-welcome' ?>">

    <?php if ($session): ?>
        <h1 class="title">Lista de Usuarios</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Verificado</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($array_users as $user): ?>
                    <tr>
                        <th scope="row"><?php echo $count++ ?></th>
                        <td><?php echo $user['usuario'] ?></td>
                        <td><?php echo $user['correo'] ?></td>
                        <td><?php echo $user['verificado'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="shadow-sm p-3 mb-5 bg-body-tertiary rounded">
            <h1>Bienvenido a tu cuenta</h1>
            <p>¡Gracias por iniciar sesión, <?php echo $usuario ?></p>
        </div>
    <?php endif; ?>

    <br>
    <!-- Botón de cerrar sesión -->
    <form method="POST" action="logout.php">
        <button class="btn btn-info shadow-sm" type="submit">Cerrar sesión</button>
    </form>
</div>


<?php include 'footer.php' ?>