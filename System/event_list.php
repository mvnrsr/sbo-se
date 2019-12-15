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
        ?>
      </div>
      <div class="content-wrapper">
        <h1>Events List</h1>
        <!--w3 modal -->
        <?php
        $modalId = "'id01'";
        $display = "'block'";
          if($_SESSION['utype'] != 3) {
            echo '<button onclick="document.getElementById('. $modalId .').style.display='. $display .'" class="w3-button w3-black float-right">Add New Event</button>';
          }

        ?>

        <!-- dataTables -->
        <table id="event" class="display">
          <thead>
            <tr>
              <th style="width: 150px !important">Title</th>
              <th style="width: 100px !important">Status</th>
              <th style="width: 70% !important">Description</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $sql = "SELECT * FROM sbo.events;";
              $result = mysqli_query($conn, $sql);
              $resultCheck = mysqli_num_rows($result);

              if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  $dateEvent = date('M d Y', strtotime($row['start_date']));
                  echo '
                    <tr>
                      <td><a href="event_profile.php?id='. $row['event_id'] . '">'. $row['title'].'</a></td>
                      <td>'. $dateEvent .'</td>
                      <td>'. $row['description'].'</td>
                      <td class="dt-center"><a href="eventdetails.php?id='.
                        $row['event_id'] .'">Edit</a></td>
                    </tr>';
                }
              }
            ?>
          </tbody>
        </table> <!-- dataTables -->

        <!-- edit event modal -->
        <div id="id01" class="w3-modal">
          <div class="w3-modal-content w3-card-4">
            <header class="w3-container w3-teal">
              <span onclick="document.getElementById('id01').style.display='none'"
              class="w3-button w3-display-topright">&times;</span>
              <h2>Add New Event</h2>
            </header>
            <div class="w3-container">
              <form class="w3-container" action="inc/insert.inc.php" method="post">
                <p>
                  <label>Event Title</label></p>
                  <input type="text" class="w3-input" name="title">

                </p>
                <p>
                  <label>Description</label></p>
                  <textarea class="w3-input" name="desc"></textarea>
                </p>
                <p>
                  <label>Start Date</label></p>
                  <input type="date" class="w3-input" name="start">
                </p>
                <p>
                  <label>Start Date</label></p>
                  <input type="date" class="w3-input" name="end">
                </p>
                <p>
                  <button class="w3-btn" type="submit" name="test">Save</button>
                </p>
              </form>
            </div>
            <footer class="w3-container w3-teal">

            </footer>
          </div>
        </div> <!-- edit event modal -->

      </div> <!-- end content wrapper -->
    </div> <!-- End main wrapper -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script>
      $(document).ready( function () {
        $('#event').DataTable();
      } );

    </script>
  </body>
</html>
