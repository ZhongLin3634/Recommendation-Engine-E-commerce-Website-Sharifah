<?php
// Start session to manage the cart
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if product ID and quantity are provided
    if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
        // Sanitize inputs
        $product_id = htmlspecialchars($_POST['product_id']);
        $quantity = intval($_POST['quantity']); // Convert quantity to integer

        // Validate quantity
        if ($quantity <= 0) {
            // Quantity must be a positive integer
            echo "Invalid quantity.";
            exit; // Stop further execution
        }

        // Now, you can add the product to the cart
        // Create or initialize cart session variable if not already exists
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        // Check if the product is already in the cart
        if (isset($_SESSION['cart'][$product_id])) {
            // If product already exists in the cart, update its quantity
            $_SESSION['cart'][$product_id] += $quantity;
        } else {
            // If product doesn't exist in the cart, add it with the provided quantity
            $_SESSION['cart'][$product_id] = $quantity;
        }

        // Redirect back to the product page or any other appropriate page
        header("Location: product_details.php?id=$product_id"); // Redirect to the product_details page
        exit; // Stop further execution
    } else {
        // If product ID or quantity is missing
        echo "Product ID or quantity is missing.";
    }
} else {
    // If form is not submitted
    echo "Invalid request.";
}
?>
