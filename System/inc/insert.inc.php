<?php
session_start();
  require 'db.inc.php';
  $today = date('d-M-Y h:i A');

  //insert student
  if (isset($_POST['saveStud'])) {
    $id = $_POST['studID'];
    $last = $_POST['lname'];
    $first = $_POST['fname'];
    $mid = $_POST['mname'];
    $address = $_POST['address'];
    $num = $_POST['num'];

    $sql = "INSERT INTO student(student_id, last_name, first_name, middle_name,
      address, contact_num) VALUES('$id', '$last', '$first', '$mid', '$address', '$num');";

    if (!mysqli_query($conn, $sql)) {
      echo (mysqli_error($conn));
    } else {
      header("Location: ../index.php?save=error");
      exit();
    }
  }

  //insert event
  if (isset($_POST['add-event'])) {
    $title = $_POST['title'];
    $start = date($_POST['start']);
    $end = date($_POST['end']);
    $desc = $_POST['desc'];


  }