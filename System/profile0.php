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
          $id = $_SESSION['uid'];
        ?>
      </div>
      <div class="content-wrapper">
        <!-- breadcrumb here -->
        <ul class="breadcrumb">

			 <?php
			   if($_SESSION['utype'] != 3){
					$id = $_GET['id'];
			 }else{
				 $id = $_SESSION['uid'];
			 }
              $sql = "SELECT * FROM sbo.student where student_id='$id';";
              $result = mysqli_query($conn, $sql);
              $resultCheck = mysqli_num_rows($result);
              if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
					$student_id = $row['student_id'];
					$last_name = $row['last_name'];
					$first_name = $row['first_name'];
					$middle_name = $row['middle_name'];
					$address = $row['address'];
					$contact_num = $row['contact_num'];
                }
              }
            ?>

         <li><a href="students.php">Students List</a></li>
         <li>(Student ID) - Profile</li>
       </ul> <!-- end breadcrumb -->

        <h1><?php echo $last_name.", ".$first_name." ".substr($middle_name, 0, 1) ."." ?></h1>

		<!--w3 modal -->
        <?php
        $modalId = "'id01'";
        $display = "'block'";
        //checks if the user's type is not student

          if($_SESSION['utype'] != 3) {
            echo '<button onclick="document.getElementById('. $modalId .').style.display='. $display .'" class="w3-button w3-black float-right">Edit</button>';
          }
        ?>

        <div id="id01" class="w3-modal">
          <div class="w3-modal-content w3-card-4">
            <header class="w3-container w3-teal">
              <span onclick="document.getElementById('id01').style.display='none'"
              class="w3-button w3-display-topright">&times;</span>
              <h2>Edit Profile</h2>
            </header>
            <div class="w3-container">
              <form class="w3-container" action="inc/edit.inc.php" method="post">
                <p>
                  <label>Student ID</label>
                  <input type="text" class="w3-input" name="studID" value="<?php echo $student_id ?>" required>
				</p>
                <p>
                  <label>Last Name</label>
                  <input type="text" class="w3-input" name="lname" value="<?php echo $last_name ?>" required>
                </p>
                <p>
                  <label>First Name</label>
                  <input type="text" class="w3-input" name="fname" value="<?php echo $first_name ?>" required>
                </p>
                <p>
                  <label>Middle Name</label>
                  <input type="text" class="w3-input" name="mname" value="<?php echo $middle_name ?>" required>
                </p>
                <p>
                  <label>Address</label>
                  <input type="text" class="w3-input" name="address" value="<?php echo $address ?>" required>
                </p>
                <p>
                  <label>Contact Number</label>
                  <input type="text" class="w3-input" name="num" value="<?php echo $contact_num ?>" required>
                </p>
                <p>
                  <button class="w3-btn" type="submit" name="editStud">Save changes</button>
                </p>
              </form>
            </div>
            <footer class="w3-container w3-teal">

            </footer>
          </div>
        </div> <!-- end modal -->
        <h2><?php  echo $student_id; ?></h2>
        <hr>
			<p>
        <label>Contact:<label>
          <input type=text value="<?php echo $contact_num ?>"/ readonly>
      </p>
			<p>
        <label>Address<label>
          <input type=text value="<?php echo $address ?>" readonly>
        </p>
      <hr>

		 <?php
        if($_SESSION['utype'] != 3){
					$id = $_GET['id'];
			  }else{
				  $id = $_SESSION['uid'];
			  }

        $sql = "SELECT emergency.last_name,
                      emergency.first_name,
                      emergency.middle_name,
                      emergency.contact_num,
                      emergency.address
                FROM emergency LEFT JOIN student
                  ON emergency.em_id=student.em_id
                where student_id='$id';";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
  					$em_last_name = $row['last_name'];
  					$em_first_name = $row['first_name'];
  					$em_middle_name = $row['middle_name'];
  					$em_address = $row['address'];
  					$em_contact_num = $row['contact_num'];
          }
        }
      ?>

        <h1>Emergency Contact</h1>
        <hr>
			<p>
        <label>Name:<label>
          <input type=text value="<?php echo $em_last_name.", ".$em_first_name." ".substr($em_middle_name, 0, 1) ."." ?>" readonly>
        </p>
			<p>
        <label>Contact:<label>
          <input type=text value="<?php echo $em_contact_num ?>" readonly>
        </p>
			<p>
        <label>Address:<label>
          <input type=text value="<?php echo $em_address ?>" readonly>
        </p>
      </div>

    </div>

  </body>
</html>
