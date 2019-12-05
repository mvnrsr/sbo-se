<?php
  if (isset($_POST['signup'])) {
    require 'db.inc.php';

    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['pw'];
    $pwRepeat = $_POST['pw-repeat'];
    $registered = TRUE;

    $check = "SELECT stud_id FROM sbo.user WHERE stud_id = '$id';";
    $result = mysqli_query($conn, $check);
    $checkID = mysqli_num_rows($result);
    if ($checkID > 0) {
      $registered = FALSE;
    }

    if (empty($username) || empty($password) || empty($pwRepeat)) {
      header("Location: ../login.php?error=emptyfields&username=".$username);
      exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
      exit();
    }
    elseif ($password !== $pwRepeat) {
      header("Location: ../login.php?error=pwcheck&username=".$username);
      exit();
    } elseif ($registered != TRUE) {
      header("Location: ../login.php?error=idtaken");
      exit();
    }
    else {
      $sql = "SELECT username FROM sbo.user WHERE username = ?";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../login.php?error=sqlerror");
        exit();
      } else {
          mysqli_stmt_bind_param($stmt, "s", $username);
          mysqli_stmt_execute($stmt);

          mysqli_stmt_store_result($stmt);

          $resultCheck = mysqli_stmt_num_rows($stmt);

          if ($resultCheck > 0) {
            header("Location: ../login.php?error=usertaken");
          } else { //end check result
            $sql = "INSERT INTO sbo.user(stud_id, username, password, type_id) VALUES(?, ?, ?, 1)";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
              //echo mysqli_error($conn);
              header("Location: ../login.php?error=sqlerror");
              exit();
            } else {
              $hashedPw = password_hash($password, PASSWORD_DEFAULT);

              mysqli_stmt_bind_param($stmt, "sss", $id, $username, $hashedPw);
              mysqli_stmt_execute($stmt);
              echo (mysqli_error($conn));
              exit();

            }
          }
      }
    } // end chck username
    //close connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

  } else {
    header("Location: ../login.php");
    exit();
  }

 ?>
