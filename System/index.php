<?php
  require 'inc/db.inc.php';
  session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <link rel="stylesheet" href="src/css/master.css">
  </head>
  <body>
    <div class="main-wrapper">
      <div class="sidenav">
        <?php include 'sidenav.php'; ?>
      </div>

      <div class="content-wrapper">
        <?php include 'welcome.php';?>
      </div>
    </div>

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
