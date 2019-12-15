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
        <form action="inc/signup.inc.php" method="post">
          <h1>Registration</h1>
            <input type="text" name="id" placeholder="Student ID" required >
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="pw" placeholder="Password" required>
            <input type="password" name="pw-repeat" placeholder="Repeat Password" required>
            <br>
            <button type="submit" name="signup">Sign Up</button>
            <a href="login.php" class="w3-tiny">Already got an account? Log in here.</a>
        </form>
      </div>


    </div>

  </body>
</html>
