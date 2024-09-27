<?php
require './dbconn.php'; // Database connection

error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

$response = [];

if ($_POST['action'] === 'fetch') {


    echo json_encode($response);
}


// Handle fetch, add, update, delete
if (isset($_POST['action'])) {
    if ($_POST['action'] == 'fetch') {
        // Fetch students
        $query = "SELECT * FROM students";
        $result = $conn->query($query);
        
        if (!$result) {
            echo json_encode(['error' => $conn->error]);
            exit;
        }

        $output = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $output[] = $row;
            }
        }
        echo json_encode($output);
        
    }
    
    // Add more cases for 'add', 'update', 'delete' if necessary
}
?>
