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
        <?php include 'sidenav.php';?>
      </div>

      <div class="content-wrapper">
        <ul>
            <?php
              $sql = "SELECT * FROM sbo.events";
              $result = mysqli_query($conn, $sql);
              $resultCheck = mysqli_num_rows($result);

              if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  echo '<li>';
                  echo '<h2>' . $row['title'] . '</h2>';
                  echo '<p>' . $row['start_date'] . '</p>';
                  echo '<p>' . $row['description'] . '</p>';
                  echo '</li>';
                }
              }

            ?>
        </ul>
      </div>
    </div>
  </body>
</html>
