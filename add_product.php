<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - Admin Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin_dashboard.css">

</head>
<body>
<div class="container-fluid">
<?php
// Define the active page based on the current file name
$activePage = basename($_SERVER['PHP_SELF']);
?>
    <div class="row">
    <div class="col-md-2 sidebar">
            <h3>Sharifah Ready-to-Eat</h3>
            <ul class="list-group">
                    <li class="list-group-item <?php echo ($activePage === 'admin_dashboard.php') ? 'active' : ''; ?>"><button class="sidebar-btn" onclick="window.location.href='admin_dashboard.php'">Dashboard</button></li>
                    <li class="list-group-item <?php echo ($activePage === 'add_product.php') ? 'active' : ''; ?>"><button class="sidebar-btn" onclick="window.location.href='add_product.php'">Add Product</button></li>
                    <li class="list-group-item <?php echo ($activePage === 'CRUD_Product.php') ? 'active' : ''; ?>"><button class="sidebar-btn" onclick="window.location.href='CRUD_Product.php'">Update Product</button></li>
                    <li class="list-group-item <?php echo ($activePage === 'login.php') ? 'active' : ''; ?>"><button class="sidebar-btn" onclick="window.location.href='login.php'">Logout</button></li>

                    <!-- Add more sidebar links as needed -->
                </ul>
            </div>
            <div class="col-md-9">
                <div class="container">
                    <h2>Add New Product</h2>
                    <form action="add_product.php" method="POST">
                        <div class="form-group">
                            <label for="product_code">Product Code:</label>
                            <input type="text" class="form-control" id="product_code" name="product_code" required>
                        </div>
                        <div class="form-group">
                            <label for="product_name">Product Name:</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="number" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form submitted, process the data
    $product_code = $_POST["product_code"];
    $product_name = $_POST["product_name"];
    $price = $_POST["price"];
    $description = $_POST["description"];

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

    // SQL query to insert new product
    $sql = "INSERT INTO product (Product_Code, Product_Name, Price, description) VALUES ('$product_code', '$product_name', $price, '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('New product added successfully');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>

</body>
</html>
