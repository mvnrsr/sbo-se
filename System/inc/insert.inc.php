<?php
session_start();
  require 'db.inc.php';
  $today = date('Y-m-d');

  //insert student
  if (isset($_POST['saveStud'])) {
    $id = $_POST['studID'];
    $last = $_POST['lname'];
    $first = $_POST['fname'];
    $mid = $_POST['mname'];
    $address = $_POST['address'];
    $num = $_POST['num'];

    $sql = "INSERT INTO sbo.student(student_id, last_name, first_name, middle_name,
      address, contact_num) VALUES('$id', '$last', '$first', '$mid', '$address', '$num');";

    if (!mysqli_query($conn, $sql)) {
      echo (mysqli_error($conn));
      header("Location: ../students.php?registration=error");
    } else {
      header("Location: ../index.php?registration=successful");
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

  //test
  if (isset($_POST['add-attendance'])) {
    $date = $_POST['date'];
    $type = $_POST['type'];

    $sql = "INSERT INTO sbo.attendance(date, type) VALUES('$date', '$type');";

    if (!mysqli_query($conn, $sql)) {

    } else {
      $sql2 = "SELECT * FROM sbo.student;";
      $list = mysqli_query($conn, $sql2);
      $listCheck = mysqli_num_rows($list);

      if ($listCheck > 0) {
        while ($row = mysqli_fetch_assoc($list)) {
          $student_list[$row['student_id']] = $row;
        }
      }

    }

  }
