<?php
include '../dbconn.php';

if (isset($_POST['id'])) {
    $student_id = $_POST['id'];

    // Prepare and execute the delete query
    $delete_query = "DELETE FROM students WHERE id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $student_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete student.']);
    }

    $stmt->close();
}

$conn->close();
?>
