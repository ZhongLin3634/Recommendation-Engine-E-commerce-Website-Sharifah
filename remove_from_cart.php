<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the product_id is set
    if(isset($_POST['product_id'])) {
        // Get the product_id from the POST data
        $product_id = $_POST['product_id'];

        // Check if the product exists in the cart
        if(isset($_SESSION['cart'][$product_id])) {
            // Remove the product from the cart
            unset($_SESSION['cart'][$product_id]);
            // Redirect back to cart.php
            header("Location: cart.php");
            exit(); // Ensure script execution stops after redirection
        } else {
            // If the product does not exist in the cart
            echo "Product not found in cart.";
        }
    } else {
        // If product_id is not set in the POST data
        echo "Invalid request.";
    }
} else {
    // If the request method is not POST
    echo "Invalid request method.";
}
?>
