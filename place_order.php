<?php
// Start session to manage the cart
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the selected payment method and total amount from the form submission
    $payment_method = $_POST['payment_method'];
    $total_amount = $_POST['total_amount'];

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

    // Retrieve user ID from session
    if(isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Insert a new record into the Orders table to represent the order
        $insert_order_sql = "INSERT INTO Orders (user_id, total_amount, payment_method) VALUES ('$user_id', '$total_amount', '$payment_method')";
        if ($conn->query($insert_order_sql) === TRUE) {
            // Retrieve the generated order_id
            $order_id = $conn->insert_id;

            // Iterate through the items in the cart and insert records into the Order_Items table
            foreach ($_SESSION['cart'] as $product_id => $quantity) {
                $insert_order_item_sql = "INSERT INTO Order_Items (order_id, product_id, quantity) VALUES ('$order_id', '$product_id', '$quantity')";
                $conn->query($insert_order_item_sql);
            }

            // Clear the cart after placing the order
            unset($_SESSION['cart']);

            // Redirect to a thank you page or order confirmation page
            header("Location: order_confirmation.php?order_id=$order_id");
            exit();
        } else {
            echo "Error: " . $insert_order_sql . "<br>" . $conn->error;
        }
    } else {
        // Redirect the user to the login page if not authenticated
        header("Location: login.php");
        exit();
    }

    // Close the database connection
    $conn->close();
}
?>
