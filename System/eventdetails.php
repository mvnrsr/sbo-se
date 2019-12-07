<?php
include 'inc/db.inc.php';
  $evId = $_GET['id'];
  $sql = "SELECT * FROM sbo.events WHERE event_id = $evId;";
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
        <?php include 'sidenav.php'; ?>
      </div>

      <div class="content-wrapper">
        <ul class="breadcrumb">
         <li><a href="welcome.php">Events</a></li>
         <li><a href="event.php">Events List</a></li>
         <li>CIT Night</li>
        </ul>

        <!--
          Modal buttons must be outside a form
          to avoid the modal from auto closing.
        -->
        <!-- edit event modal button-->
        <button onclick="document.getElementById('eventModal').style.display='block'" class="float-right">Edit Event</button>
        <!-- add new attendance modal button-->
        <button onclick="document.getElementById('attendanceModal').style.display='block'" class="float-right">Add Attendance</button>

        <form class="w3-container" action="inc/insert.inc.php" method="post">
          <h2><?php echo $title; ?></h2>
              <input type="text" name="id" value="<?php echo $evId;?>" readonly hidden>



              <div class="w3-row">
                <div class="w3-col" style="width:20%">
                  <label class="w3-large">Start Date</label>
                  <input class="w3-input" type="text" name="start" value="<?php echo $dateSt; ?>">
                </div>
                <div class="w3-col" style="width:20%">
                  <p></p>
                </div>
                <div class="w3-col" style="width:20%">
                  <label class="w3-large">End Date</label>
                  <input class="w3-input" type="text" name="end" value="<?php echo $dateEnd; ?>">
                </div>
              </div>

              <div class="w3-row">
                <div class="w3-col" style="width:60%">
                  <label class="w3-large">Description</label>
                  <p><?php echo $desc; ?></p>

                </div>
              </div>

          </ul>
        </form>
        <hr>
        <h2>Attendance</h2>
        <!--
          Problem:
            Current solution is limited to one attendance day only.
          Suggested solution:
            1. Create a select option where page will display table
                according to date.
            2. Generate tabs according to the number of dates
            3. Make a list of attendance dates and redirect user
                to another page.
            4. Turn the relationship between Attendance and Event 1:1.
                This solution will require revision to the schema where
                event is tied to only one attendance.
        -->

        <!--
          This form fetches the dates of attendances that will be used
          to query AM/PM attendance based on a date
        -->
        <form class="" action="" method="post">
          <select class="" name="attDate">
            <?php
              $sql = "SELECT DISTINCT a.date FROM sbo.student_attendance sa
                      	JOIN sbo.attendance a
                      		ON sa.att_id = a.attendance_id
                      	JOIN sbo.events e
                      		ON sa.event_id = e.event_id
                      	where sa.event_id = $evId;";
              $result = mysqli_query($conn, $sql);
              $resultCheck = mysqli_num_rows($result);
              if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  echo '<option value="' . $row['date'];
                  echo '" selected>';
                  echo $row['date'];
                  echo '</option>';
                }
              }
            ?>
          </select>
          <button type="submit" name="selectAttDate">Select Date</button>
        </form>
        <h1>AM</h1>
        <!-- attendance table -->
            <?php
              if (isset($_POST['selectAttDate'])) {
              //  header("eventdetails.php?id=$evId");
                $am = "morning";
                $date = $_POST['attDate'];
                $sql = "SELECT
                          concat(s.last_name, ', ', s.first_name) as name,
                          concat(se.year, se.section) as year_section,
                          sa.sign_in,
                          sa.sign_out,
                          a.type
                        FROM sbo.student_attendance sa
                          join student s
                            on sa.student_id = s.student_id
                          join events e
                            on sa.event_id = e.event_id
                          join attendance a
                            on sa.att_id = a.attendance_id
                          join student_section ss
                            on s.student_id = ss.student_id
                          join section se
                            on se.section_id = ss.section_id
                        WHERE sa.event_id = $evId AND a.type = '$am' AND a.date = '$date';";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);


                echo '<table id="morning" class="display">';
                echo '<thead>';
                echo '<th>Name</th>';
                echo '<th>Section</th>';
                echo '<th>Sign In</th>';
                echo '<th>Sign Out</th>';
                echo '</thead>';
                echo '<tbody>';

                if ($resultCheck > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' .$row['name']. '</td>';
                    echo '<td>' .$row['year_section']. '</td>';
                    echo '<td>' .$row['sign_in']. '</td>';
                    echo '<td>' .$row['sign_out']. '</td>';
                    echo '</tr>';
                  }
                }

                echo '</tbody>';
                echo '</table>';


              }

            ?>
            <hr>
            <h1>PM</h1>
            <?php
              if (isset($_POST['selectAttDate'])) {
                $pm = "afternoon";
                $sql = "SELECT
                          concat(s.last_name, ', ', s.first_name) as name,
                          concat(se.year, se.section) as year_section,
                          sa.sign_in,
                          sa.sign_out,
                          a.type
                        FROM sbo.student_attendance sa
                          join student s
                            on sa.student_id = s.student_id
                          join events e
                            on sa.event_id = e.event_id
                          join attendance a
                            on sa.att_id = a.attendance_id
                          join student_section ss
                            on s.student_id = ss.student_id
                          join section se
                            on se.section_id = ss.section_id
                        WHERE sa.event_id = $evId AND a.type = '$pm' AND a.date = '$date';";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);


                echo '<table id="afternoon" class="display">';
                echo '<thead>';
                echo '<th>Name</th>';
                echo '<th>Section</th>';
                echo '<th>Sign In</th>';
                echo '<th>Sign Out</th>';
                echo '</thead>';
                echo '<tbody>';

                if ($resultCheck > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' .$row['name']. '</td>';
                    echo '<td>' .$row['year_section']. '</td>';
                    echo '<td>' .$row['sign_in']. '</td>';
                    echo '<td>' .$row['sign_out']. '</td>';
                    echo '</tr>';
                  }
                }

                echo '</tbody>';
                echo '</table>';
              }

            ?>

 <!-- attendance table -->

        <!--
          Edit Event modal
          Depending on the decision, the schema may still be subject
          to change and remove the Start and End date of an Event.

        -->
        <div id="eventModal" class="w3-modal">
          <div class="w3-modal-content w3-card-4">
            <header class="w3-container w3-teal">
              <span onclick="document.getElementById('eventModal').style.display='none'"
              class="w3-button w3-display-topright">&times;</span>
              <h2>Edit Event</h2>
            </header>
            <div class="w3-container">
              <form class="w3-container" action="inc/edit.inc.php" method="post">
                <p>
                  <label>Event Title</label></p>
                  <input type="text" class="w3-input" name="title" required>
                </p>
                <p>
                  <label>Description</label></p>
                  <input type="text" class="w3-input" name="desc" required>
                </p>
                <p>
                  <label>Start Date</label>
                  <input type="date" name="start">
                </p>
                <p>
                  <label>End Date</label>
                  <input type="date" name="end">
                </p>
                <p>
                  <button class="w3-btn" type="submit" name="edit-event">Save</button>
                </p>
              </form>
            </div>
            <footer class="w3-container w3-teal">

            </footer>
          </div>
        </div> <!-- Edit Event modal -->

        <!-- Add Attendance modal -->
        <div id="attendanceModal" class="w3-modal">
          <div class="w3-modal-content w3-card-4">
            <header class="w3-container w3-teal">
              <span onclick="document.getElementById('attendanceModal').style.display='none'"
              class="w3-button w3-display-topright">&times;</span>
              <h2>Add Attendance</h2>
            </header>
            <div class="w3-container">
              <form class="w3-container" action="" method="post">
                <p>
                  <label>Type</label></p>
                  <select name="type">
                    <option value="AM" selected>AM</option>
                    <option value="PM">PM</option>
                  </select>
                </p>
                <!--
                  Alternative solution
                    1. Create a script where the system generates
                        limited selection of attendance period according
                        to the attendance type (i.e. if the officer selects
                        AM for the type, the system will only limit the option
                        to blablablablabla)
                    2. Or hard code it.
                -->
                <p>
                  <label>Start Time</label></p>
                  <input type="time" name="start" class="w3-input">
                </p>
                <p>
                  <label>End Time</label></p>
                  <input type="time" name="end" class="w3-input">
                </p>
                <p>
                  <button class="w3-btn" type="submit" name="add-attendance">Save</button>
                </p>
              </form>
            </div>
            <footer class="w3-container w3-teal">

            </footer>
          </div>
        </div> <!-- Add Attendance modal -->

      </div> <!-- end content wrapper WARNING: do not add content beyond this part. -->
    </div> <!-- end main wrapper -->


   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
   <script>
     $(document).ready( function () {
       $('#morning').DataTable();
     } );

     $(document).ready( function () {
       $('#afternoon').DataTable();
     } );
   </script>



  </body>
</html>
