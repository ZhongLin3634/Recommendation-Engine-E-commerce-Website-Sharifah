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

// Initialize loginError
$loginError = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve login data
    $loginInput = $_POST['login_input']; // Assuming the user can enter either name or ID
    $password = $_POST['password'];

    // Query the database
    $sql = "SELECT * FROM user WHERE (username = '$loginInput' OR id = '$loginInput') AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Login successful
        session_start();
        // Retrieve the user_id from the result set
        $row = $result->fetch_assoc();
        $user_id = $row['id']; // Assuming 'id' is the column name in your 'user' table
        $_SESSION['user_id'] = $user_id;
        
        // Check if the user is an admin
        $is_admin = $row['is_admin'];
        if ($is_admin == 1) {
            header("Location: admin_dashboard.php"); // Redirect to admin dashboard
            exit();
        } else {
            header("Location: home.php");
            exit();
        }
    } else {
        // Login failed
        $loginError = "Invalid username, ID, or password. Please try again.";
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="stylesheet" href="login.css">

</head>
<body>
    <div class="login-container">
        <h2>Login</h2>

        <?php
        // Display login error if exists
        if (!empty($loginError)) {
            echo '<p style="color: red;">' . $loginError . '</p>';
        }
        ?>

        <form method="post" action="login.php">
            <label for="login_input">Username or ID:</label>
            <input type="text" name="login_input" id="login_input" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <input type="submit" value="Login">
        </form>

        <p>Not registered yet? <a href="register.html">Register here</a></p>
    </div>
</body>
</html>
