<?php
  require 'inc/db.inc.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="src/css/main.css" />
  </head>
  <body>
    <h1 style="color: red">Note: No joined tables yet.</h1>
    <h1>User Section</h1>
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
<hr>



<hr>
<h1>Student Registration</h1>
<form class="" action="" method="post">
  <ul>
    <li>
      <label for=""></label>
    </li>
  </ul>
</form>

<h1>Add Student Information</h1>
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

    <table id="students" class="display">
      <thead>
        <tr>
          <th>Student ID</th>
          <th>Name</th>
          <th>Address</th>
          <th>Contact Number</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $sql = "SELECT * FROM sbo.student";
          $result = mysqli_query($conn, $sql);
          $resultCheck = mysqli_num_rows($result);

          if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo '
                <tr>
                  <td>'. $row['student_id'].'</td>
                  <td>'. $row['last_name']. ', '. $row['first_name']. ' '. $row['middle_name'] . '</td>
                  <td>'. $row['address'].'</td>
                  <td>'. $row['contact_num'].'</td>
                </tr>';
            }
          }
        ?>
      </tbody>

    </table>

<hr>
<h1>Emergency Contact Section</h1>
    <form class="" action="inc/insert.inc.php" method="post">
      <ul>
        <li>
          <label for="">Last Name</label>
          <input type="text" name="em-lname">
        </li>
        <li>
          <label for="">First Name</label>
          <input type="text" name="em-fname">
        </li>
        <li>
          <label for="">Middle Name</label>
          <input type="text" name="em-mname">
        </li>
        <li>
          <label for="">Contact Number</label>
          <input type="text" name="em-num">
        </li>
        <li>
          <label for="">Address</label>
          <input type="text" name="em-address">
        </li>
        <li>
          <button type="submit" name="em-save">Save Contact</button>
        </li>
      </ul>
    </form>

    <table id="emergency" class="display">
      <thead>
        <tr>
          <th>Emergency Contact ID</th>
          <th>Name</th>
          <th>Address</th>
          <th>Contact Number</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $sql = "SELECT * FROM sbo.emergency";
          $result = mysqli_query($conn, $sql);
          $resultCheck = mysqli_num_rows($result);

          if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo '
                <tr>
                  <td>'. $row['em_id'].'</td>
                  <td>'. $row['last_name']. ', '. $row['first_name']. ' '. $row['middle_name'] . '</td>
                  <td>'. $row['address'].'</td>
                  <td>'. $row['contact_num'].'</td>
                </tr>';
            }
          }
        ?>
      </tbody>

    </table>

    <hr>
    <h1>Event Section</h1>
    <form class="" action="inc/insert.inc.php" method="post">
      <ul>
        <li>
          <label for="">Event Title</label>
          <input type="text" name="title">
        </li>
        <li>
          <label for="">Start</label>
          <input type="date" name="start">
        </li>
        <li>
          <label for="">End</label>
          <input type="date" name="end">
        </li>
        <li>
          <label for="">Description</label>
          <textarea name="desc" rows="8" cols="80"></textarea>
        </li>
        <li>
          <button type="submit" name="add-event">Save New Event</button>
        </li>
      </ul>
    </form>

    <table id="event" class="display">
      <thead>
        <tr>
          <th>Title</th>
          <th>Date of Event</th>
          <th>Description</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $sql = "SELECT * FROM sbo.event;";
          $result = mysqli_query($conn, $sql);
          $resultCheck = mysqli_num_rows($result);

          if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              $dateEvent = date('M d Y', strtotime($row['start_date']));
              echo '
                <tr>
                  <td><a href="eventdetails.php?id='. $row['event_id'] . '">'. $row['title'].'</a></td>
                  <td>'. $dateEvent .'</td>
                  <td>'. $row['description'].'</td>
                  <td><a href="eventdetails.php?id='.
                    $row['event_id'] .'">Edit</a></td>
                </tr>';
            }
          }
        ?>
      </tbody>



    </table>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready( function () {
          $('#students').DataTable();
        } );

        $(document).ready( function () {
          $('#event').DataTable();
        } );

        $(document).ready( function () {
          $('#emergency').DataTable();
        } );
    </script>

  </body>
</html>
