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
    <form class="" action="inc/login.inc.php" method="post">
      <ul>
        <li>
          <label for="">Username</label>
          <input type="text" name="username">
        </li>
        <li>
          <label for="">Password</label>
          <input type="password" name="password">
        </li>
        <li>
          <button type="submit" name="login">Log In</button>
        </li>
      </ul>
    </form>

    <form class="" action="inc/insert.inc.php" method="post">
      <ul>
        <li>
          <label for="studID">Student ID</label>
          <input type="text" name="studID">
        </li>
        <li>
          <label for="studID">Last Name</label>
          <input type="text" name="lname">
        </li>
        <li>
          <label for="studID">First Name</label>
          <input type="text" name="fname">
        </li>
        <li>
          <label for="studID">Middle Name</label>
          <input type="text" name="mname">
        </li>
        <li>
          <label for="studID">Address</label>
          <input type="text" name="address">
        </li>
        <li>
          <label for="studID">Contact Number</label>
          <input type="text" name="num">
        </li>
        <li>
          <button type="submit" name="saveStud">Add New Student</button>
        </li>
      </ul>
    </form>

    <table>
      <tr>
        <th>Student ID</th>
        <th>Last Name</th>
        <th>First Name</th>
        <th>Middle Name</th>
        <th>Address</th>
        <th>Contact Number</th>
      </tr>
      <?php
        $sql = "SELECT * FROM sbo.student";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo '
              <tr>
                <td>'. $row['student_id'].'</td>
                <td>'. $row['last_name'].'</td>
                <td>'. $row['first_name'].'</td>
                <td>'. $row['middle_name'].'</td>
                <td>'. $row['address'].'</td>
                <td>'. $row['contact_num'].'</td>
              </tr>';
          }
        }
      ?>
    </table>

  </body>
</html>
