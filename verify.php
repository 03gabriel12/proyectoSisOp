<?php
include 'db.php';

if (isset($_GET["code"])) {
    $code = $_GET["code"];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE verification_code = ? AND is_verified = 0");
    $stmt->execute([$code]);
    $user = $stmt->fetch();

    if ($user) {
        $stmt = $pdo->prepare("UPDATE users SET is_verified = 1 WHERE verification_code = ?");
        $stmt->execute([$code]);

        $message ="Cuenta verificada. Ahora puedes iniciar sesión.";
    } else {
        $message= "Código de verificación inválido o cuenta ya verificada.";
    }
      // Espera 2 segundos antes de redirigir
      echo "<script>
      alert('$message');
      setTimeout(function() {
          window.location.href = 'index.php';
      }, 2000);
    </script>";
}
?>
