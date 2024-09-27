<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['email'])) {
    header('Location: index.php');
    exit();
}

// Include database connection
include 'dbconn.php';

// Get the posted values
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone_number = $_POST['phone_number'];

// Update the admin information in the database
$query = "UPDATE admins SET first_name = ?, last_name = ?, email = ?, phone_number = ? WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("sssss", $first_name, $last_name, $email, $phone_number, $_SESSION['email']);
$stmt->execute();

// Update the session email if changed
if ($email !== $_SESSION['email']) {
    $_SESSION['email'] = $email;
}

$stmt->close();
$conn->close();

$hashed_password = password_hash('your_password', PASSWORD_DEFAULT);

// Redirect back to profile page
header('Location: profile.php');
exit();
?>
