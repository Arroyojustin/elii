<!-- Top Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-teal static-top">
    <div class="container-fluid">
        <div class="d-flex align-items-center ms-auto">
        <a href="#" class="notification-icon" id="notificationButton">
            <i class="fas fa-bell text-white me-1"></i>
            <span id="notificationCount" class="badge bg-danger" style="display: none;">0</span>
        </a>
            <div class="dropdown">
                <a class="btn btn-sm text-white dropdown-toggle me-2" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user"></i> Student
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="student_profile.php">Profile</a></li>
                    <li><a class="dropdown-item" href="student_logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
