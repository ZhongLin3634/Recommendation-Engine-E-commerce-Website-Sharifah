<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="CURD.css">
    <link rel="stylesheet" href="admin_dashboard.css">



</head>
<body>

<div class="container-fluid">
<?php
// Define the active page based on the current file name
$activePage = basename($_SERVER['PHP_SELF']);
?>
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 sidebar">
            <h3>Sharifah Ready-to-Eat</h3>
            <ul class="list-group">
                    <li class="list-group-item <?php echo ($activePage === 'admin_dashboard.php') ? 'active' : ''; ?>"><button class="sidebar-btn" onclick="window.location.href='admin_dashboard.php'">Dashboard</button></li>
                    <li class="list-group-item <?php echo ($activePage === 'add_product.php') ? 'active' : ''; ?>"><button class="sidebar-btn" onclick="window.location.href='add_product.php'">Add Product</button></li>
                    <li class="list-group-item <?php echo ($activePage === 'CRUD_Product.php') ? 'active' : ''; ?>"><button class="sidebar-btn" onclick="window.location.href='CRUD_Product.php'">Update Product</button></li>
                    <li class="list-group-item <?php echo ($activePage === 'login.php') ? 'active' : ''; ?>"><button class="sidebar-btn" onclick="window.location.href='login.php'">Logout</button></li>

                    <!-- Add more sidebar links as needed -->
                </ul>
            </div>
            <!-- Main Content -->
            <div class="col-md-9">
            <div class="container">
                <h2>Update Product</h2>
                <?php
                // Check if product ID is provided in the URL
                if (isset($_GET['id']) && !empty($_GET['id'])) {
                    // Retrieve the product ID from the URL
                    $product_id = $_GET['id'];
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
                    // SQL query to retrieve product details based on Product_Code
                    $sql = "SELECT * FROM product WHERE Product_Code = '$product_id'";
                    // Execute query
                    $result = $conn->query($sql);
                    // Check if there are any results
                    if ($result->num_rows > 0) {
                        // Fetch product details
                        $row = $result->fetch_assoc();
                        $product_name = $row["Product_Name"];
                        $price = $row["Price"];
                        $description = $row["description"];
                        // Display the update form
                        ?>
                        <form action="update_product_process.php" method="post">
                            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                            <div class="form-group">
                                <label for="product_name">Product Name:</label>
                                <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo $product_name; ?>">
                            </div>
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="text" class="form-control" id="price" name="price" value="<?php echo $price; ?>">
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea class="form-control" id="description" name="description"><?php echo $description; ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Product</button>
                        </form>
                        <?php
                        } else {
                            echo "Product not found.";
                        }
                    } else {
                        echo "Product ID is missing.";
                    }
                    // Close connection
                    $conn->close();
                    ?>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>
