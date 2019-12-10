<?php
  session_start();
  require 'inc/db.inc.php';

    if (isset($_SESSION['logged_in']) != TRUE) {
      header("Location: login.php?error=invader");
      exit();
    }
?>


<?php
  if($_SESSION['utype'] != 5) {
    echo '<div class="col ">';
    echo '<ul>';
    echo '<li>Hello, '. $_SESSION['uname']. '</li>';
    echo '<hr>';
    echo '<li>';
    echo '<a href="event_list.php">Events</a>';
    echo '</li>';
    echo '<li>';
    echo '<a href="student_list.php">Students</a>';
    echo '</li>';
    echo '<li>';
    echo '<a href="student_profile.php">Student Profile</a>';
    echo '</li>
        <li>
          <a href="section_list.php">Section List</a>
        </li>
        <li>
          <a href="emergency_list.php">Emergency Contact List</a>
        </li>
        <li>
          <a href="inc/logout.inc.php">Log Out</a>
        </li>
      </ul>
    </div>';
  } else {
    echo '
    <div class="col ">
      <ul>
        <li>Hello, '. $_SESSION['uname'] . '</li>
        <hr>
        <li>
          <a href="event_list.php">Events</a>
        </li>
        <li>
          <a href="section.php">Section</a>
        </li>
        <li>
          <a href="inc/logout.inc.php">Log Out</a>
        </li>
      </ul>
    </div>
    ';
  }

?>
