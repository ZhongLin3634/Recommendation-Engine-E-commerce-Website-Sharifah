<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id']) && isset($_POST['new_quantity'])) {
    $product_id = $_POST['product_id'];
    $new_quantity = $_POST['new_quantity'];

    // Update the session variable with the new quantity
    $_SESSION['cart'][$product_id] = $new_quantity;

    // Return a success message or any other response if needed
    echo "Quantity updated successfully.";
} else {
    // Return an error message if the request is invalid
    echo "Invalid request.";
}
?>
