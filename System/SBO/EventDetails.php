<?php
  require '../inc/db.inc.php';
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
      $desc = $row['desc'];
    }
  } else if(empty($resultCheck)) {
    echo 'No results found.<br>';
  }
 ?>

<head>
    <meta charset="utf-8">
    <title>Event Details</title>
    <link rel="stylesheet" type="text/css" href="table.css">
  </head>

<div class="event">
		<center>
		<h1>Event Details</h1>
		<hr size="3px">
		<form action="../inc/insert.inc.php" method="post">
			<table>
				<tr>
			<td><label for="">Event ID  : </label><input type="text" name="id" value="<?php echo $evId;?>" readonly></td>
				</tr>
				<tr>
			<td><label for="">Event Title  : </label><input type="text" name="title" value="<?php echo $title; ?>" read only ></td>
				</tr>
				<tr>
			<td><label for="">Date Created : </label><input type="text" name="create" value="<?php echo $dateCr; ?>" readonly > </td>
				</tr>
				<tr>
			<td><label for="">Description  : </label>
				<textarea name="event-desc" rows="8" cols="80" required readonly>
				<?php
					echo $desc;
				?>
				</textarea></td>
				</tr>
				<tr>
			<td><label for="">Start        : </label><input type="text" name="start" value="<?php echo $dateSt; ?>" readonly></td>
				</tr>
				<tr>
			<td><label for="">End          : </label><input type="text" name="end" value="<?php echo $dateEnd; ?>" readonly></td>
				</tr>
				<table>

				</table>
			</table>
		</form>
		</center>
	</div>
