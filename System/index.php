<?php
  require 'inc/db.inc.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <link rel="stylesheet" href="src/css/main.css">
  </head>
  <body>
    <div class="main-container">
      <div class="col_side-nav">
        <ul>
          <li>
            <a href="#">Events</a>
            <ul>
              <li><a href="#">Events List</a></li>
              <li><a href="#">Manage Events</a></li>
            </ul>
          </li>
          <li>
            <a href="#">Students</a>
            <ul>
              <li><a href="#">Students List</a></li>
              <li><a href="#">Manage Students</a></li>
              <li><a href="#">Students Registration</a></li>
            </ul>
          </li>
          <li>
            <a href="#">Link 3</a>
          </li>
        </ul>
      </div>
      <div class="col-container">
      <div class="cols">
        <p>EVENTALISTIC CHUCHUCHU</p>
      </div>
      <div class="col">
        <table width="78%">
          <tr>
            <td>Title</td><td>Start Date</td><td>Description</td>
          </tr>
          <tr><td colspan="3"><hr></td></tr>
        <ul>

            <?php
              $sql = "SELECT * FROM sbo.event";
              $result = mysqli_query($conn, $sql);
              $resultCheck = mysqli_num_rows($result);

              if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  echo'<tr><td colspan="3">&nbsp;</td></tr>';
                  echo '<tr>';
                  echo '<td>' . $row['title'] . '</td>';
                  echo '<td>' . $row['start_date'] . '</td>';
                  echo '<td>' . $row['description'] . '</td>';
                  echo '</tr>';
                  echo'<tr><td colspan="3">&nbsp;</td></tr>';
                  echo'<tr><td colspan="3"><hr></td></tr>';
                }
              }

            ?>

        </ul>
      </div>
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
      </table>
  </body>
</html>
