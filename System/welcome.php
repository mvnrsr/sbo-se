<?php
  session_start();
  require 'inc/db.inc.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <ul>
        <?php
          $sql = "SELECT * FROM sbo.event";
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
  </body>
</html>
