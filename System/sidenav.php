<?php
  session_start();
  require 'inc/db.inc.php';

    if (isset($_SESSION['logged_in']) != TRUE) {
      header("Location: login.php?error=invader");
      exit();
    }
?>

<div class="col ">
  <ul>
    <li>Hello, <?php echo $_SESSION['uname']; ?></li>
    <hr>
    <li>
      <a href="event.php">Events</a>
    </li>
    <li>
      <a href="students.php">Students</a>
    </li>
    <li>
      <a href="profile.php">Student Profile</a>
    </li>
    <li>
      <a href="inc/logout.inc.php">Log Out</a>
    </li>
  </ul>
</div>
