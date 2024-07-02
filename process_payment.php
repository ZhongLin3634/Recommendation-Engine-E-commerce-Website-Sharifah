<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Process Payment</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <link rel="stylesheet" href="process_payment.css">
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
<style>
    .notification {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #4CAF50;
        color: white;
        padding: 15px 30px;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        z-index: 9999;
        animation: showNotification 0.5s ease forwards;
    }

    @keyframes showNotification {
        0% {
            opacity: 0;
            transform: translate(-50%, -50%) scale(0.5);
        }
        100% {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
        }
    }

    .checkmark {
        width: 30px;
        height: 30px;
        background-color: white;
        border-radius: 50%;
        position: absolute;
        top: -40px; /* Adjust the position */
        left: calc(50% - 15px); /* Center horizontally */
        animation: showCheckmark 0.5s ease forwards 0.3s;
    }

    @keyframes showCheckmark {
        0% {
            opacity: 0;
            transform: scale(0);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }

    .checkmark svg {
        fill: #4CAF50;
        width: 100%;
        height: 100%;
    }
</style>

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
            </div>
        </nav>
    </header>

    <div class="container">
        <h2>Payment Confirmation</h2>
        <?php
// Start session to access session variables
//session_start();

// Check if the user is logged in and a payment method is set
if (!isset($_SESSION['user_id']) || !isset($_POST['payment_method'])) {
    // Redirect user to the cart page if necessary data is missing
    header("Location: cart.php");
    exit();
}

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$databaseName = "user_sharifah";

// Create database connection
$conn = new mysqli($servername, $username, $password, $databaseName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];
$payment_method = $_POST['payment_method'];

// Initialize total amount
$total_amount = 0;

// Iterate through the cart items to calculate total amount
foreach ($_SESSION['cart'] as $product_id => $quantity) {
    // Retrieve product price from the database
    $sql = "SELECT Price FROM product WHERE Product_Code = '$product_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $product_price = $row['Price'];
        // Add to total amount
        $total_amount += ($product_price * $quantity);
    }
}

// Serialize cart for order
$product_ids = implode(',', array_keys($_SESSION['cart']));
$quantities = implode(',', array_values($_SESSION['cart']));

// Prepare SQL to insert order
$sql = "INSERT INTO orders (user_id, product_ids, quantities, total_amount, status) VALUES (?, ?, ?, ?, 'Pending')";
$stmt = $conn->prepare($sql);
$stmt->bind_param("issd", $user_id, $product_ids, $quantities, $total_amount);

if ($stmt->execute()) {
    // Clear the cart after saving the order
    unset($_SESSION['cart']);

    // Get the ID of the newly created order
    $new_order_id = $stmt->insert_id;

    // Close statement and connection
    $stmt->close();
    $conn->close();

    // Function to show a notification
    echo "<div class='notification'>
            <div class='checkmark'>
                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'>
                    <path d='M0 11l2-2 5 5L18 3l2 2L7 18z'/>
                </svg>
            </div>
            <div>Order Successful!</div>
            <script>
                setTimeout(() => {
                    window.location.href = 'view_order.php?order_id=$new_order_id';
                }, 3000);
            </script>
          </div>";
} else {
    // Handle error in order saving, display error message or log
    echo "Error saving order: " . $stmt->error;
}

?>

    </div>


    <!-- Footer -->
    <footer class="fixed-footer">
        <p>&copy; <?php echo date("Y"); ?> Your Website. All rights reserved.</p>
    </footer>

</body>

</html>
