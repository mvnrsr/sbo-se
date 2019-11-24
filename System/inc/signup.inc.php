<?php

if (isset($_POST['signup'])) {
  require 'db.inc.php';

  $username = $_POST['username'];
  $pw = $_POST['pw'];
  $pwRepeat = $_POST['pw-repeat'];


}
