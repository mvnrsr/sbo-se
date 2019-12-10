<?php
session_start();
  require 'db.inc.php';
  $today = date('Y-m-d');

  //insert student
  if (isset($_POST['saveStud'])) {
    $id = $_POST['studID'];
    $sectId = $_POST['sect_id'];
    $last = $_POST['lname'];
    $first = $_POST['fname'];
    $mid = $_POST['mname'];
    $address = $_POST['address'];
    $num = $_POST['num'];

    $sql = "INSERT INTO sbo.student(student_id,
              last_name,
              first_name,
              middle_name,
              address,
              contact_num)
            VALUES('$id', '$last', '$first', '$mid', '$address', '$num');";
    $sql = "INSERT INTO sbo.student_section(student_id,
              section_id)
            VALUES('$id', $sectId);";

    if (!mysqli_multi_query($conn, $sql)) {
      echo (mysqli_error($conn));
      header("Location: ../students.php?registration=error");
    } else {
      header("Location: ../students.php?registration=successful");
      exit();
    }
  }

  //insert emergency_contact
  if (isset($_POST['em-save'])) {
    $emLast = $_POST['em-lname'];
    $emFirst = $_POST['em-fname'];
    $emMid = $_POST['em-mname'];
    $emNum = $_POST['em-num'];
    $emAdd = $_POST['em-address'];

    $sql = "INSERT INTO sbo.emergency(last_name, first_name, middle_name, contact_num, address) VALUES('$emLast', '$emFirst', '$emMid', '$emNum', '$emAdd')";

    if (!mysqli_query($conn, $sql)) {
      echo (mysqli_error($conn));
    } else {
      header("Location: ../index.php?saveEm=error");
      exit();
    }
  }

  //insert event
  if (isset($_POST['add-event'])) {
    $title = $_POST['title'];
    //$start = date('Y-m-d', strtotime(str_replace('-', '/', $_POST['start'])));
    //$end = date('Y-m-d',  strtotime(str_replace('-', '/', $_POST['end'])));
    $start = $_POST['start'];
    $end = $_POST['end'];
    $desc = $_POST['desc'];

    $sql = "INSERT INTO sbo.event(title, create_date, description, start_date, end_date) VALUES('$title', '$today', '$desc', '$start', '$end')";

    if (!mysqli_query($conn, $sql)) {
      echo (mysqli_error($conn));
      echo "<br><br>";
      echo $title;
      echo "<br><br>";
      echo $today;
      echo "<br><br>";
      echo $desc;
      echo "<br><br>";
      echo $start;
      echo "<br><br>";
      echo $end;
    } else {
      header("Location: ../index.php?saveEvent=error");
      exit();
    }
  } //insert event

  //insert attendance, insert student attendance
  if (isset($_POST['add-attendance'])) {
    $date = $_POST['date'];
    $type = $_POST['type'];
    $evId = $_POST['eventId'];
    $start = date('H:i', strtotime($_POST['start']));
    $end = date('H:i', strtotime($_POST['end']));

    $sql = "INSERT INTO sbo.attendance(date, type, start, end, event_id) VALUES('$date', '$type', '$start', '$end', $evId);";

    if (!mysqli_query($conn, $sql)) {
      echo mysqli_error($conn);
    } else {
      //get last inserted id from sbo.attendance
      $attId = mysqli_insert_id($conn);

      //fetch student IDs
      $sql = "SELECT * FROM sbo.student;";
      $list = mysqli_query($conn, $sql);
      $listCheck = mysqli_num_rows($list);

      //store student IDs into array
      if ($listCheck > 0) {
        while ($row = mysqli_fetch_assoc($list)) {
          $students[] = $row['student_id'];
        }


      } //end result check
      for ($i=0; $i < count($students); $i++) {
        $student_id = $students[$i];
        $sql2 = "INSERT INTO sbo.student_attendance(att_id, student_id) VALUES($attId, '$student_id');";

        mysqli_query($conn, $sql2);

      } //end loop

      header("Location: ../eventdetails.php?id=$evId");
      /*
      $sql2 = "SELECT * FROM sbo.student;";
      $list = mysqli_query($conn, $sql2);
      $listCheck = mysqli_num_rows($list);

      if ($listCheck > 0) {
        while ($row = mysqli_fetch_assoc($list)) {
          $student_list[$row['student_id']] = $row;
        }
        for ($i=0; $i < sizeof($student_list); $i++ ) {
          $sql = "INSERT INTO sbo.student_attendance()";
        }
      } */

    }

  }
