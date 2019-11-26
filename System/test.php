<?php
  require 'inc/db.inc.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <!-- Custom fonts for this template-->
    <link href="admintheme/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="admintheme/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="admintheme/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  </head>
  <body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
          <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
          </div>
          <div class="sidebar-brand-text mx-3">SB Admin</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
          <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Nav Item - Events Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEvents" aria-expanded="true" aria-controls="collapseEvents">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Events</span>
          </a>
          <div id="collapseEvents" class="collapse" aria-labelledby="headingEvents" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">WAT</h6>
              <a class="collapse-item" href="#">View Events</a>
              <a class="collapse-item" href="#">Add New Events</a>
              <a class="collapse-item" href="#">Manage Events</a>
            </div>
          </div>
        </li>

        <!-- Nav Item - Students Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStudents" aria-expanded="true" aria-controls="collapseStudents">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Students</span>
          </a>
          <div id="collapseStudents" class="collapse" aria-labelledby="headingStudents" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">WAT</h6>
              <a class="collapse-item" href="#">View Students</a>
              <a class="collapse-item" href="#">Register a Student</a>
              <a class="collapse-item" href="#">Manage Students</a>
            </div>
          </div>
        </li>

      <!-- End of Sidebar -->
      </ul>

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
          <!-- Topbar -->
          <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Hello, Root.</span>
                <img class="img-profile rounded-circle" src="src/img/user.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </ul> <!-- Topbar Navbar -->
          </nav> <!-- End of Topbar -->

          <!-- Begin Page Content -->
          <div class="container-fluid">
            <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Event List</h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="eventTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Title</th>
                      <th>Date of Event</th>
                      <th>Description</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Title</th>
                      <th>Date of Event</th>
                      <th>Description</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                      $sql = "SELECT * FROM sbo.event;";
                      $result = mysqli_query($conn, $sql);
                      $resultCheck = mysqli_num_rows($result);

                      if ($resultCheck > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                          $dateEvent = date('M d Y', strtotime($row['start_date']));
                          echo '
                            <tr>
                              <td><a href="eventdetails.php?id='. $row['event_id'] . '">'. $row['title'].'</a></td>
                              <td>'. $dateEvent .'</td>
                              <td>'. $row['description'].'</td>
                              <td><a href="eventdetails.php?id='.
                                $row['event_id'] .'">Edit</a></td>
                            </tr>';
                        }
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div> <!-- DataTales Example -->
          </div>


        </div>

      </div>

    </div> <!-- Page Wrapper -->

    <div class="main-container">
      <div class="col side-nav">
        <ul>
          <li>
            <a href="#">Link 1</a>
          </li>
          <li>
            <a href="#">Link 2</a>
          </li>
          <li>
            <a href="#">Link 3</a>
          </li>
        </ul>
      </div>

      <div class="col ">
        <h1>Student Section</h1>
        <form class="" action="inc/insert.inc.php" method="post">
          <ul>
            <li>
              <label for="studID">Student ID</label>
              <input type="text" name="studID">
            </li>
            <li>
              <label for="studID">Last Name</label>
              <input type="text" name="lname">
            </li>
            <li>
              <label for="studID">First Name</label>
              <input type="text" name="fname">
            </li>
            <li>
              <label for="studID">Middle Name</label>
              <input type="text" name="mname">
            </li>
            <li>
              <label for="studID">Address</label>
              <input type="text" name="address">
            </li>
            <li>
              <label for="studID">Contact Number</label>
              <input type="text" name="num">
            </li>
            <li>
              <button type="submit" name="saveStud">Add New Student</button>
            </li>
          </ul>
        </form>

        <table id="students" class="display">
          <thead>
            <tr>
              <th>Student ID</th>
              <th>Name</th>
              <th>Address</th>
              <th>Contact Number</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $sql = "SELECT * FROM sbo.student";
              $result = mysqli_query($conn, $sql);
              $resultCheck = mysqli_num_rows($result);

              if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  echo '
                    <tr>
                      <td>'. $row['student_id'].'</td>
                      <td>'. $row['last_name']. ', '. $row['first_name']. ' '. $row['middle_name'] . '</td>
                      <td>'. $row['address'].'</td>
                      <td>'. $row['contact_num'].'</td>
                    </tr>';
                }
              }
            ?>
          </tbody>

        </table>

        <hr>
        <h1>Emergency Contact Section</h1>
        <form class="" action="inc/insert.inc.php" method="post">
          <ul>
            <li>
              <label for="">Last Name</label>
              <input type="text" name="em-lname">
            </li>
            <li>
              <label for="">First Name</label>
              <input type="text" name="em-fname">
            </li>
            <li>
              <label for="">Middle Name</label>
              <input type="text" name="em-mname">
            </li>
            <li>
              <label for="">Contact Number</label>
              <input type="text" name="em-num">
            </li>
            <li>
              <label for="">Address</label>
              <input type="text" name="em-address">
            </li>
            <li>
              <button type="submit" name="em-save">Save Contact</button>
            </li>
          </ul>
        </form>

        <table id="emergency" class="display">
          <thead>
            <tr>
              <th>Emergency Contact ID</th>
              <th>Name</th>
              <th>Address</th>
              <th>Contact Number</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $sql = "SELECT * FROM sbo.emergency";
              $result = mysqli_query($conn, $sql);
              $resultCheck = mysqli_num_rows($result);

              if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  echo '
                    <tr>
                      <td>'. $row['em_id'].'</td>
                      <td>'. $row['last_name']. ', '. $row['first_name']. ' '. $row['middle_name'] . '</td>
                      <td>'. $row['address'].'</td>
                      <td>'. $row['contact_num'].'</td>
                    </tr>';
                }
              }
            ?>
          </tbody>

        </table>

        <hr>
        <h1>Event Section</h1>
        <form class="" action="inc/insert.inc.php" method="post">
          <ul>
            <li>
              <label for="">Event Title</label>
              <input type="text" name="title">
            </li>
            <li>
              <label for="">Start</label>
              <input type="date" name="start">
            </li>
            <li>
              <label for="">End</label>
              <input type="date" name="end">
            </li>
            <li>
              <label for="">Description</label>
              <textarea name="desc" rows="8" cols="80"></textarea>
            </li>
            <li>
              <button type="submit" name="add-event">Save New Event</button>
            </li>
          </ul>
        </form>

        <table id="event" class="display">
          <thead>
            <tr>
              <th>Title</th>
              <th>Date of Event</th>
              <th>Description</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $sql = "SELECT * FROM sbo.event;";
              $result = mysqli_query($conn, $sql);
              $resultCheck = mysqli_num_rows($result);

              if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  $dateEvent = date('M d Y', strtotime($row['start_date']));
                  echo '
                    <tr>
                      <td><a href="eventdetails.php?id='. $row['event_id'] . '">'. $row['title'].'</a></td>
                      <td>'. $dateEvent .'</td>
                      <td>'. $row['description'].'</td>
                      <td><a href="eventdetails.php?id='.
                        $row['event_id'] .'">Edit</a></td>
                    </tr>';
                }
              }
            ?>
          </tbody>
        </table>
      </div>


    </div>
    <!--
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

        $(document).ready( function () {
          $('#eventTable').DataTable();
        } );
    </script> -->
    <!-- Bootstrap core JavaScript-->
    <script src="admintheme/vendor/jquery/jquery.min.js"></script>
    <script src="admintheme/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="admintheme/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="admintheme/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="admintheme/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="admintheme/js/demo/chart-area-demo.js"></script>
    <script src="admintheme/js/demo/chart-pie-demo.js"></script>

  </body>
</html>
