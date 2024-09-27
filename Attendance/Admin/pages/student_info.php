<?php
include 'dbconn.php';

// Check if the student ID is set in the query string
if (isset($_GET['id'])) {
    $student_id = $_GET['id'];
    
    // Fetch student information along with game and education stats from the database
    $query = "
        SELECT s.names, s.position, s.status,
               gs.games_played, gs.points_scored, gs.assists,
               es.attendance_percentage
        FROM students s
        LEFT JOIN game_stats gs ON s.id = gs.student_id
        LEFT JOIN education_stats es ON s.id = es.student_id
        WHERE s.id = ?
    ";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
    } else {
        echo "<h3>Student not found.</h3>";
        exit();
    }
} else {
    echo "<h3>No student ID provided.</h3>";
    exit();
}

$conn->close();
?>

<div class="container-fluid">
    <h2 class="text-center"></h2>
    <div class="row">
        <!-- Profile photo column -->
        <div class="col-sm-12 col-md-3">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <div class="profile-photo-container">
                        <img src="path_to_profile_photos/<?php echo $student_id; ?>.jpg" alt="Profile Photo" class="profile-photo">
                    </div>
                    <button class="upload-photo-button" onclick="document.getElementById('photoUpload').click();">
                        <i class="fa-solid fa-circle-plus" style="color: #198ae1;"></i>
                    </button>
                    <input type="file" id="photoUpload" accept="image/*" style="display:none;" onchange="uploadPhoto(this.files)">
                    <h5><?php echo ucfirst($student['names']); ?></h5>
                    <p><strong>Position:</strong> <?php echo ucfirst($student['position']); ?></p>
                    <p><strong>Status:</strong> <?php echo ucfirst($student['status']); ?></p>
                </div>
            </div>
        </div>

        <!-- Game and Education stats columns -->
        <div class="col-sm-12 col-md-9">
            <div class="row">
                <!-- Game Stats -->
                <div class="col-sm-6">
                    <h5>Game Stats</h5>
                    <ul class="list-group mb-4">
                        <li class="list-group-item">Games Played: <?php echo $student['games_played']; ?></li>
                        <li class="list-group-item">Points Scored: <?php echo $student['points_scored']; ?></li>
                        <li class="list-group-item">Assists: <?php echo $student['assists']; ?></li>
                    </ul>
                </div>

                <!-- Education Stats -->
                <div class="col-sm-6">
                    <h5>Education Stats</h5>
                    <ul class="list-group mb-4">
                        <li class="list-group-item">Attendance Percentage: <?php echo $student['attendance_percentage']; ?>%</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    
    <a href="javascript:void(0);" onclick="loadPage('pages/students.php')" class="btn btn-secondary mt-3">Back to Students</a>
</div>

<style>
    .profile-photo-container {
        position: relative; 
        width: 100%; /* Make width responsive */
        max-width: 150px; /* Set a maximum width */
        height: 150px; 
        border-radius: 50%; 
        overflow: hidden; 
        margin: 0 auto; 
        border: 2px solid #ccc; 
    }

    .profile-photo {
        width: 100%; 
        height: auto; 
        display: block; 
        object-fit: cover; /* Ensures the image covers the container without distortion */
    }

    .upload-photo-button {
        position: absolute; /* Position relative to the container */
        right: 30%; /* Adjust this value to move the button horizontally */
        bottom: 50%; /* Adjust this value to move the button vertically */
        width: 25%; /* Responsive width relative to the container */
        height: 25%; /* Maintain aspect ratio */
        max-height: 40px; /* Limit max height for the button */
        border-radius: 50%; /* Makes the button circular */
        background-color: rgba(255, 255, 255, 0.8) !important; /* Semi-transparent white background */
        border: none !important; 
        font-size: 24px; /* Font size */
        cursor: pointer; 
        display: flex; /* Center the icon */
        align-items: center; /* Center icon vertically */
        justify-content: center; /* Center icon horizontally */
        transform: translate(50%, 50%); /* Center the button */
    }

    button {
        background-color: transparent !important;
    }
   
</style>

<script>
function uploadPhoto(files) {
    if (files.length > 0) {
        const file = files[0];
        // Handle the file upload logic here
        console.log('File selected:', file.name);
        // Implement AJAX here to send the file to the server
    }
}
</script>
