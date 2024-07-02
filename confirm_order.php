<?php
// Process the order confirmation
// Assuming the order confirmation process here

// Display "Order successful" message
echo "<script>alert('Order successful');</script>";

// Redirect to view_order.php
header("Location: view_order.php");
exit(); // Make sure to exit after redirection
?>
