<?php
  $servername = "localhost";
  $dbUsername = "root";
  $dbPw = "";
  $dbName = "sbo";

  $conn = mysqli_connect($servername, $dbUsername, $dbPw, $dbName);

  if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

 ?>
