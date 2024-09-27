<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../Admin/style.css"> <!-- Updated to student-style.css -->

    <!-- Updated Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
</head>
<body>
    <!-- Include the student header -->
    <?php include('../Admin/components/student-header.php'); ?>

    <!-- Sidebar -->
    <?php include('../Admin/components/student-sidebar.php'); ?>

    <!-- Main Content -->
    <div class="content-container" style="margin-left: 200px; padding: 20px;">
        <header class="text-center mb-4">
            <h1 class="display-6">Welcome to the Student Dashboard</h1>
        </header>
        
        <div class="row">
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Tasks</div>
                    <div class="card-body">
                        <p class="card-text">Check your current tasks.</p>
                        <a href="student_courses.php" class="btn btn-light">View tasks</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">Schedule</div>
                    <div class="card-body">
                        <p class="card-text">Check your class schedule.</p>
                        <a href="student_schedule.php" class="btn btn-light">View Schedule</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        #student-wrapper {
            display: flex;
            height: 100vh;
            overflow: hidden;
            flex-direction: column;
        }

        #student-content-wrapper {
            margin-left: 200px; /* Adjust to sidebar width */
            margin-top: 56px; /* Navbar height */
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        #student-content {
            padding: 1rem;
            flex-grow: 1;
            overflow-y: auto;
        }

        #student-page-content {
            width: 100%;
        }

        /* Navbar */
        .navbar-student {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            background-color: #008080;
        }

        /* Sidebar */
        .sidebar-container {
            background-color: #48a698; /* Sidebar background color */
            min-height: 100vh; /* Full height sidebar */
        }

        .list-group-item {
            color: white; /* Text color for sidebar links */
            background-color: #48a698;
            border: none; /* Remove borders */
            padding: 15px; /* Adjust spacing */
            font-size: 16px; /* Adjust font size */
        }

        .list-group-item:hover {
            background-color: rgba(0, 0, 0, 0.1); /* Add hover effect */
        }

        .list-group-item i {
            margin-right: 10px; /* Space between icon and text */
        }

        .sidebar-heading {
            padding: 24px;
            padding-top: 23px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            background-color:#008080;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
</body>
</html>
