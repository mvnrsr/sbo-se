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

        ?>
      </div>
      <div class="content-wrapper">
        <!-- breadcrumb here -->
        <ul class="breadcrumb">
         <li><a href="index.php">Home</a></li>
         <li>Student List</li>
       </ul> <!-- end breadcrumb -->

        <h1>Students List</h1>
        <form class="w3-container" action="index.html" method="post">
          <div class="w3-row">
            <div class="w3-col">
              <select class="">
                <option selected disabled>School Year</option>
                <option value="2019-2020">2019-2020</option>
              </select>
            </div>
            <div class="w3-col">
              <select class="">
                <option selected disabled>Term</option>
                <option value="First Semester">1st Semester</option>
              </select>
            </div>
            </div>
        </form>



        <!--w3 modal -->
        <?php
        $modalId = "'id01'";
        $display = "'block'";
        //checks if the user's type is not student
          if($_SESSION['utype'] != 3) {
            echo '<button onclick="document.getElementById('. $modalId .').style.display='. $display .'" class="w3-button w3-black float-right">Register New Student</button>';
          }
        ?>

        <div id="id01" class="w3-modal">
          <div class="w3-modal-content w3-card-4">
            <header class="w3-container w3-teal">
              <span onclick="document.getElementById('id01').style.display='none'"
              class="w3-button w3-display-topright">&times;</span>
              <h2>New Student Registration</h2>
            </header>
            <div class="w3-container">
              <form class="w3-container" action="inc/insert.inc.php" method="post">
                <p>
                  <label>Student ID</label></p>
                  <input type="text" class="w3-input" name="studID" required>
                </p>
                <p>
                  <label>Section</label>
                  <select class="w3-input" name="sect_id">
                    <?php
                      $sql = "SELECT section_id, concat(year, section) as yr_sect FROM sbo.section;";
                      $result = mysqli_query($conn, $sql);
                      $resultCheck = mysqli_num_rows($result);

                      if ($resultCheck > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                          echo '<option value="' . $row['section_id'];
                          echo '">';
                          echo $row['yr_sect'];
                          echo "</option>";
                        }
                      }
                    ?>
                  </select>
                </p>
                <p>
                  <label>Last Name</label></p>
                  <input type="text" class="w3-input" name="lname" required>
                </p>
                <p>
                  <label>First Name</label></p>
                  <input type="text" class="w3-input" name="fname" required>
                </p>
                <p>
                  <label>Middle Name</label></p>
                  <input type="text" class="w3-input" name="mname" required>
                </p>
                <p>
                  <label>Address</label></p>
                  <input type="text" class="w3-input" name="address" required>
                </p>
                <p>
                  <label>Contact Number</label></p>
                  <input type="text" class="w3-input" name="num" required>
                </p>
                <p>
                  <button class="w3-btn" type="submit" name="saveStud">Save</button>
                </p>
              </form>
            </div>
            <footer class="w3-container w3-teal">

            </footer>
          </div>
        </div> <!-- end modal -->

        <!-- dataTables -->
        <table id="event" class="display">
          <thead>
            <tr>
              <th>Student ID</th>
              <th>Name</th>
              <th>Year and Section</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Student ID</th>
              <th>Name</th>
              <th>Year and Section</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
              $sql = "SELECT
	                      s.student_id,
                        concat(s.last_name, ', ', s.first_name) as name,
                        CONCAT(se.year,se.section) as year_section
                      FROM student s
	                    join section se
		                    on s.section_id = se.section_id";
              $result = mysqli_query($conn, $sql);
              $resultCheck = mysqli_num_rows($result);

              if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  //$dateEvent = date('M d Y', strtotime($row['start_date']));
                  echo '<tr>';
                  echo '<td><a href="student_profile.php?id='. $row['student_id'].'">';
                  echo $row['student_id']. '</a></td>';
                  echo '<td>'. $row['name'] .'</td>';
                  echo '<td>'. $row['year_section'] . '</td>';
                  echo '</tr>';
                }
              }
            ?>
          </tbody>
        </table>

      </div> <!-- end content wrapper -->
    </div> <!-- End main wrapper -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script>
      $(document).ready( function () {
        $('#event').DataTable();
      } );

    </script>
  </body>
</html>
