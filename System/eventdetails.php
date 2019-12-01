<?php
  session_start();
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

  if (isset($_SESSION['logged_in']) != TRUE) {
    header("Location: login.php?error=invader");
    exit();
  }

 ?>

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
        <?php include 'sidenav.php'; ?>
      </div>

      <div class="content-wrapper">
        <h2>Event Detail</h2>
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
              <label for="">Start Date</label>
              <input type="text" name="start" value="<?php echo $dateSt; ?>">
            </li>
            <li>
              <label for="">End Date</label>
              <input type="text" name="end" value="<?php echo $dateEnd; ?>">
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
              <button type="submit" name="edit-event">Save Changes</button>
            </li>
          </ul>
        </form>
        <hr>
        <h2>Attendance</h2>
        <table id="listofevents" class="display">
          <thead>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Sign In</th>
            <th>Sign Out</th>
          </thead>
        </table>
      </div>
    </div>


   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
   <script>
     $(document).ready( function () {
       $('#listofevents').DataTable();
     } );
   </script>



  </body>
</html>
