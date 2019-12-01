<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <link rel="stylesheet" href="src/css/master.css">
  </head>
  <body>
    <div class="main-wrapper">
      <div class="sidenav">
        <?php
          include 'sidenav.php';
        ?>
      </div>
      <div class="content-wrapper">
        <table id="event" class="display">
          <thead>
            <tr>
              <th>Title</th>
              <th>Description</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Title</th>
              <th>Description</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
              require 'inc/db.inc.php';
              $sql = "SELECT * FROM sbo.event;";
              $result = mysqli_query($conn, $sql);
              $resultCheck = mysqli_num_rows($result);

              if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  $dateEvent = date('M d Y', strtotime($row['start_date']));
                  echo '
                    <tr>
                      <td><a href="eventdetails.php?id='. $row['event_id'] . '">'. $row['title'].'</a></td>
                      <td>'. $dateEvent .'</td>
                      <td>'. $row['description'].'</td>
                      <td><a href="eventdetails.php?id='.
                        $row['event_id'] .'">Edit</a></td>
                    </tr>';
                }
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script>
      $(document).ready( function () {
        $('#event').DataTable();
      } );
    </script>
  </body>
</html>
