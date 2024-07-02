<?php
session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database credentials
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

    // Retrieve and sanitize input
    $payment_method = $conn->real_escape_string($_POST['payment_method']);
    $total_amount = $conn->real_escape_string($_POST['total_amount']);
    $user_id = $_SESSION['user_id']; // Assuming the user's ID is stored in session

    // Insert order into orders table
    $sql = "INSERT INTO orders (user_id, total_amount, payment_method) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("ids", $user_id, $total_amount, $payment_method);
    if ($stmt->execute() === false) {
        die("Error executing statement: " . $stmt->error);
    }

    // Assuming you have an `order_id` that's auto-incremented
    $order_id = $stmt->insert_id;
    $stmt->close();

    // Now, iterate through the cart items and insert them into an order_items table
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        $sql_item = "INSERT INTO order_items (order_id, product_code, quantity, price) VALUES (?, ?, ?, ?)";
        
        foreach ($_SESSION['cart'] as $product_id => $quantity) {
            // Check if cart_prices is set and is an array
            if (isset($_SESSION['cart_prices']) && is_array($_SESSION['cart_prices']) && isset($_SESSION['cart_prices'][$product_id])) {
                $price = $_SESSION['cart_prices'][$product_id];
            } else {
                // Handle error: Price not found
                // For simplicity, we're logging and skipping this item. You might handle this differently.
                error_log("Price for product_id $product_id not found in session.");
                continue; // Skip this item
            }

            $stmt_item = $conn->prepare($sql_item);
            if ($stmt_item === false) {
                die("Error preparing statement for item: " . $conn->error);
            }

            $stmt_item->bind_param("iiid", $order_id, $product_id, $quantity, $price);
            if ($stmt_item->execute() === false) {
                die("Error executing statement for item: " . $stmt_item->error);
            }
            $stmt_item->close();
        }
    }

    $conn->close();

    // Clear the cart session after processing
    unset($_SESSION['cart'], $_SESSION['cart_prices']);

    // Redirect to a confirmation page or order summary
    header("Location: order_confirmation.php?order_id=" . $order_id);
    exit();
} else {
    // Redirect back to cart page if the form wasn't submitted properly
    header("Location: cart.php");
    exit();
}
?>
