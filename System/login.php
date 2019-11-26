<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SBO System - Log in</title>
    <link rel="stylesheet" href="src/css/main.css">
  </head>
  <body>
    <div class="container">
      <div class="">
        <form action="inc/login.php" method="post">
          <h1>Login</h1>
            <input type="text" name="username" placeholder="Username" >
            <input type="password" name="pw" placeholder="Password">
            <br>
            <button type="submit" name="login">Sign In</button>
        </form>
      </div>

      <div class="">
        <form action="inc/signup.inc.php" method="post">
          <h1>Registration</h1>
            <input type="text" name="id" placeholder="Student ID" required >
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="pw" placeholder="Password" required>
            <input type="password" name="pw-repeat" placeholder="Repeat Password" required>
            <br>
            <button type="submit" name="signup">Sign Up</button>
        </form>
      </div>


    </div>

  </body>
</html>
