<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <link rel="stylesheet" href="src/css/master.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  </head>
  <body>
    <div class="main-wrapper">
      <div class="sidenav">
        <?php
          include 'sidenav.php';
          $id = $_SESSION['uid'];
        ?>
      </div>
      <div class="content-wrapper">
        <!-- breadcrumb here -->
        <ul class="breadcrumb">
         <li><a href="students.php">Students List</a></li>
         <li>(Student ID) - Profile</li>
       </ul> <!-- end breadcrumb -->

        <h1>Last Name, First Name MI</h1>
        <h2><?php  echo $id; ?></h2>
        <hr>
        Info here
        <hr>
        <h1>Emergency Section here</h1>
        <hr>
        Info here
      </div>

    </div>

  </body>
</html>
