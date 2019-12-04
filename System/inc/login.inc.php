<?php
if (isset($_POST['login'])) {
  require 'db.inc.php';

  $username = $_POST['username'];
  $password = $_POST['pw'];

  if (empty($username) || empty($password)) {
    header("Location: ../login.php?error=emptyfields&username=".$username);
    exit();
  }
  else {
    $sql = "SELECT * FROM sbo.user WHERE username=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../login.php?error=sqlerror");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "s", $username);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)) {
        $pwdCheck = password_verify($password, $row['password']);
        if ($pwdCheck == false) {
          header("Location: ../login.php?error=wrongpwd");
          session_start();
          $_SESSION['invalid-pw'] = TRUE;
          exit();
        }
        else if ($pwdCheck == true) {
          session_start();
          //info
          $_SESSION['uid'] = $row['stud_id'];
          $_SESSION['uname'] = $row['username'];
          $_SESSION['logged_in'] = TRUE;
          //root = 1, officer = 2, student = 3;
          $_SESSION['utype'] = $row['type_id'];

          header("Location: ../index.php?login=success&id=".$id);
          exit();
        }
      }
      else {
        header("Location: ../login.php?login=wronguidpwd");
        exit();
      }
    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
else {
  header("Location: login.php");
  exit();
}
 ?>
