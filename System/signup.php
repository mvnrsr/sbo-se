<?php
  require 'inc/db.inc.php';
  ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form class="" action="" method="post">
      <ul>
        <li>
          <label for="">Username</label>
          <input type="text" name="username" required>
        </li>
        <li>
          <label for="">Password</label>
          <input type="password" name="pw" required>
        </li>
        <li>
          <label for="">Repeat Password</label>
          <input type="password" name="pw-repeat" required>
        </li>
        <li>
          <button type="submit" name="signup">Sign Up</button>
        </li>
      </ul>
    </form>
  </body>
</html>
