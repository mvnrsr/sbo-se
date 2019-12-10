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
          $eId = $_GET['id'];
          $sql = "SELECT
	                   UPPER(CONCAT(e.last_name, ', ', e.first_name, ' ', LEFT(e.middle_name, 1), '.')) as name,
                     e.em_id,
                     e.contact_num,
                     e.address
                  FROM emergency e";
          $result = mysqli_query($conn, $sql);
          $resultCheck = mysqli_num_rows($result);
          if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              $name = $row['name'];
              $num = $row['contact_num'];
              $address = $row['address'];
            }
          }
        ?>
      </div> <!-- end sidenav -->

      <div class="content-wrapper"> <!-- content-wrapper -->
        <!-- breadcrumb here -->
        <ul class="breadcrumb">
         <li><a href="">Emergency Contact List</a></li>
         <li>Name - Profile</li>
       </ul> <!-- end breadcrumb -->

        <h1><?php  echo $name; ?></h1>
        <h2 class="w3-large"><?php  echo $id; ?></h2>
        <table class="w3-table w3-bordered w3-hoverable">
          <tr>
            <td>Contact Number</td>
            <td><?php echo $num; ?></td>
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

        <h1>Students Assigned to <?php echo $name;?></h1>
        


      </div> <!-- end content wrapper -->

    </div> <!-- end main wrapper -->

  </body>
</html>
