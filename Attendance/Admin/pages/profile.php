<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['email'])) {
    header('Location: index.php');
    exit();
}

// Include database connection
include '../dbconn.php';

// Fetch admin details from the database
$admin_email = $_SESSION['email'];
$query = "SELECT first_name, last_name, email, phone_number FROM admins WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $admin_email);
$stmt->execute();
$stmt->bind_result($first_name, $last_name, $email, $phone_number);
$stmt->fetch();
$stmt->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .profile-container {
            display: flex;
            margin: 20px;
        }
        .left-section {
            flex: 1;
            margin-right: 20px;
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
        }
        .right-section {
            flex: 2;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
        }
        .left-section h4, .right-section h4 {
            margin-bottom: 20px;
        }
        .left-section ul {
            list-style-type: none;
            padding: 0;
        }
        .left-section ul li {
            margin-bottom: 15px;
        }
        .left-section ul li a {
            text-decoration: none;
            color: #007bff;
        }
        .left-section ul li a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="my-4">Admin Profile</h1>
    <div class="profile-container">
        <!-- Left Side -->
        <div class="left-section">
            <h4>Admin Settings</h4>
            <ul>
                <li>Email: <strong><?php echo $admin_email; ?></strong></li>
                <li><a href="change_profile_photo.php">Change Profile Photo</a></li>
                <li><a href="change_password.php">Change Password</a></li>
                <li><a href="delete_account.php" onclick="return confirm('Are you sure you want to delete your account?');">Delete Account</a></li>
            </ul>
        </div>

        <!-- Right Side -->
        <div class="right-section">
            <h4>Personal Information</h4>
            <form action="update_profile.php" method="POST">
                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $first_name; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $last_name; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo $phone_number; ?>" required>
                </div>
                <div class="d-flex justify-content-beside">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="../admin.php" class="btn btn-secondary ms-2">Back to Home</a> <!-- Updated link -->
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
