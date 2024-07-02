<?php
// Database parameters
$servername = "localhost";
$username = "root";
$password = "";
$databaseName = "user_sharifah";

// Create connection
$conn = new mysqli($servername, $username, $password, $databaseName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$userId = $_POST['id'];
$username = $_POST['username'];
$password = $_POST['password'];
$shippingAddress = $_POST['shipping_address'];

// Update user information
$updateQuery = "UPDATE user SET username = '$username', password = '$password', shipping_address = '$shippingAddress' WHERE id = '$userId'";

if ($conn->query($updateQuery) === TRUE) {
    echo "<script>alert('Profile updated successfully!'); window.location.href = 'profile.php?id=$userId';</script>";
} else {
    echo "Error updating profile: " . $conn->error;
}

// Close the connection
$conn->close();
?>
