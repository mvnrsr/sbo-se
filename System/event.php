<div class="main-container">
  <?php
    include 'sidenav.php';
  ?>

  <div class="col">
    <table id="event" class="display">
      <thead>
        <tr>
          <th>Title</th>
          <th>Date of Event</th>
          <th>Description</th>
          <th>Action</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>Title</th>
          <th>Date of Event</th>
          <th>Description</th>
          <th>Action</th>
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
