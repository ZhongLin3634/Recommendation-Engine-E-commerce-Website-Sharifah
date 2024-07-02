<?php
// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

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

    // SQL query to update product details
    $sql = "UPDATE product SET Product_Name = '$product_name', Price = '$price', Description = '$description' WHERE Product_Code = '$product_id'";

    // Execute SQL query
    if ($conn->query($sql) === TRUE) {
        echo "Product updated successfully";
        // Close connection
        $conn->close();
        // Redirect to update_product.php after 2 seconds with the product ID
        header("refresh:2; url=update_product.php?id=$product_id");
        exit(); // Terminate the script execution after redirection
    } else {
        echo "Error updating product: " . $conn->error;
    }

    // Close connection
    $conn->close();
} else {
    // If form data is not submitted through POST method
    echo "Form data not submitted.";
}
?>
