<?php
  require 'db.inc.php';
  //edit event
  if (isset($_POST['edit-event'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $start = $_POST['start'];
    $end = $_POST['end'];

    $sql = "UPDATE sbo.events
      SET title='$title', description='$desc', start_date='$start', end_date='$end' WHERE event_id = $id;";

    if ($conn->query($sql) === TRUE) {
      header("Location: ../eventdetails.php?id=$id&update=successful");
      exit();
    } else {
      echo mysqli_error($conn);
      echo $id;
    }
  }

  //edit emergency contact
  if (isset($_POST['edit-contact'])) {

  }
