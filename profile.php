<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Link to Bootstrap CSS -->
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="res.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <?php
// Now you can access session variables, such as $_SESSION['user_id']
// Example usage:
session_start();

if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    echo "Logged in user ID: $user_id";
} else {
    // Redirect the user to the login page if not authenticated
    header("Location: login.php");
    exit();
}
?>
</head>
<body>
<header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="Home.php">Sharifah Ready to Eat</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="Home.php">Home <span class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Cart</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="view_order.php">Your Orders</a>
                    </li>
                </ul>
            </div>
            <div>
                <a class="navbar-brand" href="cart.php">
                    <img src="cart.png" alt="Add to Cart" width="30" height="30">
                </a>
                <a class="navbar-brand" href="profile.php">
                    <img src="user.png" alt="User Profile" class="img-fluid rounded-circle" width="30" height="30">
                </a>
                <a class="navbar-brand" href="login.php">
                    <img src="logout.png" alt="Logout" width="30" height="30">
                </a>
            </div>

        </nav>
    </header>
<div class="container">
<?php
// Start the session


// Check if the user is logged in
if(isset($_SESSION['user_id'])) {
    // Get the user ID from the session
    $user_id = $_SESSION['user_id'];
    
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

    // Retrieve user information based on user ID
    $getUserQuery = "SELECT * FROM user WHERE id = '$user_id'";
    $result = $conn->query($getUserQuery);

    if ($result->num_rows > 0) {
        // Display user information in form
        $row = $result->fetch_assoc();
       // echo "<h2>Edit Profile</h2>";
       echo "<br>";
        echo "<form method='POST' action='update_profile.php'>";
        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
        echo "<div class='form-group'>";
        echo "<label for='username'>Username:</label>";
        echo "<input type='text' class='form-control' id='username' name='username' value='" . $row['username'] . "'>";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label for='password'>Password:</label>";
        echo "<input type='password' class='form-control' id='password' name='password' value='" . $row['password'] . "'>";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label for='shippingAddress'>Shipping Address:</label>";
        echo "<input type='text' class='form-control' id='shippingAddress' name='shipping_address' value='" . $row['shipping_address'] . "'>";
        echo "</div>";
        echo "<button type='submit' class='btn btn-primary'>Save Changes</button>";
        echo "</form>";
    } else {
        echo "User not found!";
    }

    // Close the connection
    $conn->close();
} else {
    // Redirect the user to the login page if not authenticated
    header("Location: login.php");
    exit();
}
?>

</div>
<footer class="fixed-footer">
        <p>&copy; <?php echo date("Y"); ?> Your Website. All rights reserved.</p>
    </footer>

<!-- Link to Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
