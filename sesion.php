<div class="wrapper">
   <div class="card-switch">
      <label class="switch">
         <input type="checkbox" class="toggle">
         <span class="slider"></span>
         <span class="card-side"></span>
         <div class="flip-card__inner">
            <div class="flip-card__front">
               <?php include_once 'login.php'; ?>
            </div>
            <div class="flip-card__back">
               <?php include_once 'register.php'; ?>
            </div>
         </div>
      </label>
   </div>
</div>
<div id="liveAlertPlaceholder"></div>

<?php
if (isset($_GET['message'])) {
   echo "<script>alert('" . htmlspecialchars($_GET['message']) . "');
   </script>";
}
?>