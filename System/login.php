<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SBO System - Log in</title>
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="src/css/main.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  </head>
  <body>
    <div class="container">
      <div class="container">
        <div style="padding-top: 5%;">
          <img src="src/img/cit.png"  style="height: 150px; width: 150px;">
        </div>
      </div>
      <h1 style="padding-bottom: 1em; padding-top: 1em;">SBO Attendance Monitoring and Evaluation System</h1>
    </div>
    <div class="container">
      <div class="">
        <form action="inc/login.inc.php" method="post">
          <h1>Login</h1>
            <input type="text" name="username" placeholder="Username" >
            <input type="password" name="pw" placeholder="Password">
            <br>
            <button type="submit" name="login">Sign In</button>
            <a href="signup.php" class="w3-tiny">Need an account?</a>
        </form>
      </div>
    </div>

  </body>
</html>
