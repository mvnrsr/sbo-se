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
    <form class="" action="arr_test.php" method="post">
      <input type="text" name="event" value="2">
      <input type="date" name="date">
      <select class="" name="type">
        <option value="morning">Morning</option>
        <option value="afternoon">Afternoon</option>
      </select>
      <button type="submit" name="save">Add</button>
    </form>

    <?php
    $student_list = (array) null;
    //test
    //when an officer adds a new attendance, all students
    //gets a NULL entry on each attendance by default
    //this way, the system will be able to count the number
    //of absences of all students. this will enable the community
    //service hours to be calculated automatically in the future
    //iteration of the system
    if (isset($_POST['save'])) {
      $date = $_POST['date'];
      $type = $_POST['type'];
      $event = $_POST['event'];

      $sql = "INSERT INTO sbo.attendance(date, type) VALUES('$date', '$type');";

      if (!mysqli_query($conn, $sql)) {

      } else {
        //get all student id
        $sql2 = "SELECT student_id FROM sbo.student;";
        //get last inserted id from attendance table
        $sql2 .= "SELECT attendance_id FROM sbo.attendance WHERE attendance_id = LAST_INSERT_ID();";
        $list = mysqli_query($conn, $sql2);
        $listCheck = mysqli_num_rows($list);

        if ($listCheck > 0) {
          while ($row = mysqli_fetch_assoc($list)) {
            //store student id's in an array
            $student_list[] = $row['student_id'];
          }
        }

      }
    }

    //print array elements test
    //this loop will serve as the insert function for all
    //registered students in the database.
    //if a student is not registered in the system,
    //the stakeholder may impose a penalty to the unregistered
    //student. i.e. full community service from all events.
    //after all students are added in the attendance,
    //an officer may simply click a link(button) to update the table
    //that corresponds to the appropriate attendance.
    echo '<pre>'; print_r($student_list); echo '</pre>';
    for ($i=0; $i < sizeof($student_list); $i++) {
    }
    ?>
  </body>



</html>
