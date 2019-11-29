    <?php
	require '../inc/db.inc.php';
	?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Event Section</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="table.css">
    <link rel="stylesheet" type="text/css" href="nav.css">

  </head>
  <body>
	<div class="container">
            <nav>
                  <input type="checkbox" id="nav" class="hidden">
                  <label for="nav" class="nav-btn">
                        <i></i>
                        <i></i>
                        <i></i>
                  </label>
                  <div class="logo">
                        <a href="#">SBO</a>
                  </div>
                  <div class="nav-wrapper">
                        <ul>
                              <li><a href="EventSec.php"">Event Section</a></li>
                              <li><a href="#">Emergency Contact Section</a></li>
                              <li><a href="#">Student Section</a></li>
                              <li><a onclick="return confirm('Log-out?')" href="index.php">Log-out</a></li>
                        </ul>
                  </div>
            </nav>
      </div>

	<div class="event">
		<center>
		<h1>Event Section</h1>
		<hr size="3px">
		<form action="inc/insert.inc.php" method="post">
			<table>
				<tr>
			<td><label for="">Event Title  : </label><input type="text" name="title"></td>
				</tr>
				<tr>
			<td><label for="">Start        : </label><input type="date" name="start"></td>
				</tr>
				<tr>
			<td><label for="">End          : </label><input type="date" name="end"></td>
				</tr>
				<table>
				<tr>
			<td><label for="">Description  : </label><textarea name="desc" rows="8" cols="80"></textarea></td>
				</tr>
				</table>
			</table>
			<br>
			<button class="add-event" type="submit" >Save New Event</button>
		</form>
		</center>
	</div>

	<br><br><br>
    <table id="event" class="display">
      <thead>
        <tr>
          <th>Title</th>
          <th>Date of Event</th>
          <th>Description</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody >
        <?php
          $sql = "SELECT * FROM sbo.event;";
          $result = mysqli_query($conn, $sql);
          $resultCheck = mysqli_num_rows($result);

          if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              $dateEvent = date('M d Y', strtotime($row['start_date']));
              echo '
                <tr>
                  <td><a href="EventDetails.php?id='. $row['event_id'] . '">'. $row['title'].'</a></td>
                  <td>'. $dateEvent .'</td>
                  <td>'. $row['desc'].'</td>
                  <td><a href="EditEvent.php?id='. $row['event_id'] .'">
				  <button  type="sumbit" class="edit">Edit</button></a></td>
                </tr>';
            }
          }
        ?>



    </table>

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
