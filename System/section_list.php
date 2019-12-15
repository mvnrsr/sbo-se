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
        <?php include 'sidenav.php';?>
      </div>

      <div class="content-wrapper">
        <!-- breadcrumb -->
        <ul class="breadcrumb">
         <li><a href="welcome.php">Home</a></li>
         <li><a href="section.php">Section</a></li>
         <li>Lala</li>
       </ul> <!-- end breadcrumb-->

      <h1>Sections</h1>
      <!--button for modal -->
      <?php
      $modalId = "'id01'";
      $display = "'block'";
        if($_SESSION['utype'] == 1|2) {
          echo '<button onclick="document.getElementById('. $modalId .').style.display='. $display .'" class="w3-button w3-blue float-right">New Section</button>';
        }

      ?>

      <table id="section" class="display">
        <thead>
          <th>Student ID</th>
          <th>Name</th>
          <th>Year & Section</th>
        </thead>
        <tbody>
          <?php
            $sql = "SELECT
	                    s.student_id,
                      concat(s.last_name, ', ', s.first_name) as name,
                      CONCAT(se.year,se.section) as year_section
                    FROM student s
	                  join section se	on s.section_id = se.section_id";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo '<td>';
                echo '<a href="profile.php?id="' . $row['student_id'] . '">';
                echo $row['student_id'];
                echo '</a>';
                echo '</td>';

                echo '<td>';
                echo $row['name'];
                echo '</td>';

                echo '<td>';
                echo $row['year_section'];
                echo '</td>';
                echo "</tr>";
              }
            }
          ?>
        </tbody>
      </table>

      <!-- add section modal -->
      <div id="id01" class="w3-modal ">
        <div class="w3-modal-content w3-card-4">
          <header class="w3-container w3-teal">
            <span onclick="document.getElementById('id01').style.display='none'"
            class="w3-button w3-display-topright">&times;</span>
            <h2>Add New Section</h2>
          </header>
          <div class="w3-container">
            <form class="w3-quarter w3-container " action="" method="post">
              <p>
                <label>Year</label>
                <select class="" name="">
                  <option value="1">First Year</option>
                  <option value="2">second Year</option>
                  <option value="3">Third Year</option>
                  <option value="4">Fourth Year</option>
                </select>
              </p>
              <p>
                <label>Section</label>
                <select class="" name="">
                  <option value="A">A</option>
                  <option value="B">B</option>
                  <option value="C">C</option>
                  <option value="D">D</option>
                  <option value="E">E</option>
                  <option value="F">F</option>
                </select>
              </p>
              <p>
                <label>School Year</label>
                <select class="" name="">
                  <option value="2019-2020">2019-2020</option>
                  <option value="2020-2021">2020-2021</option>
                  <option value="2021-2022">2021-2022</option>
                </select>
              </p>
              <p>
                <label>Term</label>
                <select class="" name="">
                  <option value="First Semester">First Semester</option>
                  <option value="Second Semester">Second Semester</option>
                  <option value="Summer Term">Summer Term</option>
                </select>
              </p>
              <p>
                <button class="w3-btn" type="submit" name="test">Save</button>
              </p>
            </form>
          </div>
          <footer class="w3-container w3-teal">

          </footer>
        </div>
      </div> <!-- add section modal -->

      </div> <!-- content wrapper -->
    </div> <!-- main-wrapper -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script>
      $(document).ready( function () {
        $('#section').DataTable();
      } );

    </script>
  </body>
</html>
