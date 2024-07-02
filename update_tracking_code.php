<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "user_sharifah");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id'];
    $tracking_code = $_POST['tracking_code']; // Retrieve tracking code from form

    // Update tracking code in the orders table
    $updateSql = "UPDATE orders SET tracking_code='$tracking_code' WHERE order_id=$order_id";
    if ($conn->query($updateSql) === TRUE) {
        echo "<div id='successMessage'>Tracking code updated successfully.</div>";
    } else {
        echo "<div id='errorMessage'>Error updating record: " . $conn->error . "</div>";
    }
}

$conn->close();
?>
<script>
    // Redirect back to admin_dashboard.php after 2 seconds
    setTimeout(function() {
        window.location.href = 'admin_dashboard.php';
    }, 2000);

    // Add animation to the message
    var messageDiv = document.getElementById('successMessage') || document.getElementById('errorMessage');
    if (messageDiv) {
        messageDiv.style.transition = 'opacity 1s ease-in-out';
        messageDiv.style.opacity = '1';
        setTimeout(function() {
            messageDiv.style.opacity = '0';
        }, 1500);
    }
</script>
