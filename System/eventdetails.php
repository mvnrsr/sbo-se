<head>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
</head>

<body>
  <?php
    require 'inc/db.inc.php';
    $evId = $_GET['id'];
    $sql = "SELECT * FROM sbo.event WHERE event_id = $evId;";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['title'];
        $dateCr = $row['create_date'];
        $dateSt = $row['start_date'];
        $dateEnd = $row['end_date'];
        $desc = $row['description'];
      }
    } else if(empty($resultCheck)) {
      echo 'No results found.<br>';
    }
   ?>

  <form class="" action="inc/edit.inc.php" method="post">
    <ul>
      <input type="text" name="id" value="<?php echo $evId;?>" readonly>
      <li>
        <label for="">Title</label>
        <input type="text" name="title" value="<?php echo $title; ?>" required >
      </li>
      <li>
        <label for="">Date Created</label>
        <input type="text" name="create" value="<?php echo $dateCr; ?>" readonly >
      </li>
      <li>
        <label for="">Description</label>
        <textarea name="event-desc" rows="8" cols="80" required >
          <?php
            echo $desc;
          ?>
        </textarea>
      </li>
      <li>
        <label for="">Start Date</label>
        <input type="text" name="start" value="<?php echo $dateSt; ?>">
      </li>
      <li>
        <label for="">End Date</label>
        <input type="text" name="end" value="<?php echo $dateEnd; ?>">
      </li>
      <li>
        <button type="submit" name="edit-event">Save Changes</button>
      </li>
    </ul>
  </form>

  <table id="attendance" class="display">
    <thead>
      <tr>Attendance ID</tr>
      <tr>Event ID</tr>
      <tr>Student ID</tr>
      <tr>Attendance Date</tr>
    </thead>
    <tbody>
      <th></th>
    </tbody>
  </table>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
  <script>
      $(document).ready( function () {
        $('#attendance').DataTable();
      } );

  </script>

</body>
