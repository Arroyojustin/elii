<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $names = $_POST['names'];
    $position = $_POST['position'];
    $email = $_POST['email']; // Assuming email is passed

    // Insert the new student
    $stmt = $conn->prepare("INSERT INTO students (names, position, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $names, $position, $email);
    $stmt->execute();

    // Get the inserted student ID
    $student_id = $stmt->insert_id;

    // Create notification
    $notification_message = "You have been added as a student.";
    $notification_stmt = $conn->prepare("INSERT INTO notifications (student_id, message) VALUES (?, ?)");
    $notification_stmt->bind_param("is", $student_id, $notification_message);
    $notification_stmt->execute();

    // Prepare response
    $response = [
        'success' => true,
        'id' => $student_id
    ];

    echo json_encode($response);
    $stmt->close();
    $notification_stmt->close();
    $conn->close();
}
