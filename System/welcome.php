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
