<?php
  session_start();
  require 'inc/db.inc.php';

    if (isset($_SESSION['logged_in']) != TRUE) {
      header("Location: login.php?error=invader");
      exit();
    }
?>


<?php

    include 'nav_admin.php';

?>
