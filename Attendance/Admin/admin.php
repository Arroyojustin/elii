<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header('Location: ./index.php');
    exit();
}

// Include database connection
include 'dbconn.php';

// Initialize $result as null
$result = null;

// Handle approve/decline/cancel actions
if (isset($_POST['action']) && isset($_POST['attendance_id'])) {
    $attendance_id = $_POST['attendance_id'];
    $action = $_POST['action'];

    if ($action === 'cancel') {
        $status = 'Pending';
    } else {
        $status = ($action === 'approve') ? 'Approved' : 'Declined';
    }

    // Update the status in the database
    $update_query = "UPDATE attendance SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("si", $status, $attendance_id);
    $stmt->execute();
    $stmt->close();
}

// Fetch attendance records
$attendance_query = "SELECT id, student_name, estimation_date, duration, permission_details, status FROM attendance";
$result = $conn->query($attendance_query);

// Check for query execution errors
if (!$result) {
    die("Query failed: " . $conn->error);
}

$conn->close();

 // Set default page path correctly
$page = isset($_GET['page']) ? $_GET['page'] : 'pages/home.php';

// Sanitize and validate the page parameter to prevent security issues
$allowed_pages = [
    'pages/home.php',        // Add the full path relative to admin.php
    'pages/students.php',    // Include the students page
    'pages/create_student.php',
    'pages/delete_student.php',
    'pages/student_info.php',
    'pages/attendance.php',
    
    

    
    // 'pages/load_students.php',
];

// Check if the requested page is in the allowed pages list
if (!in_array($page, $allowed_pages)) {
    // If the page is not allowed, default to 'home.php'
    $page = 'pages/home.php';
}



 // Pass the current page to sidebar
//  $current_page = $page;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="style.css">
  
  <!-- SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  

  <style>
    /* body {
      display: flex;
      min-height: 100vh;
      flex-direction: column;
      margin: 0;
    } */
    html, body {
    height: 100%;
    margin: 0;
    }

    #wrapper {
      display: flex;
        height: 100vh;
        overflow: hidden;
        flex-direction: column;
    }

    #content-wrapper {
      margin-left: 200px; /* Adjust to sidebar width */
        margin-top: 56px; /* Navbar height */
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    #content {
      padding: 1rem;
        flex-grow: 1;
        overflow-y: auto;
    }

    #page-content {
      width: 100%;
    }

    .navbar {
      position: fixed;
      top: 0;
        left: 0;
        width: 100%;
        z-index: 1000;

    }

    .main-container {
      display: flex;
      flex: 1;
    }

    .sidebar-container {
      /* height: 100vh; */
      position: fixed;
      top: 44px;
      left: 0;
      width: 200px;
      height: calc(100vh - 44px);
      overflow-y: auto;
      background-color: rgba(84, 186, 169, 1); /* Sidebar color */
    }

    .sidebar-container .sidebar-heading {
      padding: 1rem;
      font-size: 1.2rem;
      color: #fff;
      background-color: rgba(84, 186, 169, 1);
      text-align: center;
    }

    .sidebar-container .list-group-item {
      padding: 1rem;
      font-size: 1rem;
      color: #fff;
      background-color: rgba(84, 186, 169, 1); /* Updated color */
      border: none;
    }

    .sidebar-container .list-group-item:hover {
      background-color: #138496;
    }

    /* .content-wrapper {
      margin-left: 200px;
      padding: 60px 20px;
      flex-grow: 1;
    } */

    .table th, .table td {
      vertical-align: middle;
    }    
  </style>
</head>
<body>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar-->
        <?php include('components/admin-sidebar.php'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!--Header Content -->
            <?php include('components/admin-header.php'); ?>

            <!-- Main Content -->
            <div class="" id="content">

                <!-- Begin Page Content -->
                <div id="page-content" style="width: 90%;">
                    <?php include($page); ?>
                </div>

                <!-- Content Row -->
                <!-- <div class="row">
                    <div class="col-lg-6 mb-4"></div>
                </div> -->

            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

      <div class="d-flex" flex></div>
    </div>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./Ajax/retrieve_ajax.js"></script>
  <script src="./Ajax/update_edit.js"></script>
  <script src="./Ajax/students_add.js"></script>
  <script src="./Ajax/student_delete.js"></script>
  


  <script>
        function loadPage(page) {
            window.location.href = 'admin.php?page=' + page;
        }
    </script>
</body>
</html>
