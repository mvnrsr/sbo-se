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
          if ($_SESSION['utype'] != 5) {
            $id = $_GET['id'];
          } else {
            $id = $_SESSION['uid'];
          }

          $sql = "SELECT
                      UPPER(CONCAT(s.last_name, ', ', s.first_name, ' ', LEFT(s.middle_name, 1), '.')) as name,
                      s.student_id,
                      CONCAT(ss.year, ss.section) as yr_sect,
                      s.address,
                      s.contact_num,
                      ut.type_desc,
                      u.username,
                      s.em_id
                  FROM student s
                  JOIN section ss ON s.section_id = ss.section_id
                  JOIN user u ON u.stud_id = s.student_id
                  JOIN user_type ut ON u.type_id = ut.type_id
                  WHERE student_id = '$id'";
          $result = mysqli_query($conn, $sql);
          $resultCheck = mysqli_num_rows($result);
          if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              $name = $row['name'];
              $sId = $row['student_id'];
              $section = $row['yr_sect'];
              $address = $row['address'];
              $num = $row['contact_num'];
              $user = $row['username'];
            }
          }

        ?>
      </div>
      <div class="content-wrapper">
        <!-- breadcrumb here -->
        <ul class="breadcrumb">
         <li><a href="students.php">Students List</a></li>
         <li><?php echo $id; ?> - Profile</li>
       </ul> <!-- end breadcrumb -->

        <h1><?php  echo $name; ?></h1>
        <h2 class="w3-large"><?php  echo $id; ?></h2>
        <hr> <!-- information here -->
        <table class="w3-table w3-bordered w3-hoverable">
          <tr>
            <td>Section</td>
            <td><?php echo $section; ?></td>
          </tr>
          <tr>
            <td>Address</td>
            <td><?php echo  $address; ?></td>
          </tr>
          <tr>
            <td>Contact Number</td>
            <td><?php echo $num; ?></td>
          </tr>
        </table>

        <h1>Emergency Section here</h1>
        Info here
      </div>

    </div>

  </body>
</html>
