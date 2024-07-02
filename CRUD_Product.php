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
            <!-- Main Content -->
            <div class="col-md-9">
            <div class="container">
    <h2>Sharifah Ready-to-Eat Product List</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Product Code</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
        <?php
// Define the number of products to display per page
$productsPerPage = 10;

// Get the current page number, default to 1 if not set
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset
$offset = ($page - 1) * $productsPerPage;

// Function to retrieve product data from the database with pagination
function getProducts($offset, $limit)
{
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

    // SQL query to retrieve products with pagination
    $sql = "SELECT * FROM product LIMIT $offset, $limit";

    // Execute SQL query
    $result = $conn->query($sql);

    // Check if there are any results
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            // Display product details
            echo "<tr>";
            echo "<td>" . $row["Product_Code"] . "</td>";
            echo "<td>" . $row["Product_Name"] . "</td>";
            echo "<td>RM" . $row["Price"] . "</td>";
            echo "<td>" . $row["description"] . "</td>";
            // Add update button with link to update_product.php and passing product ID
            echo "<td><a href='update_product.php?id=" . $row["Product_Code"] . "' class='btn btn-primary'>Update</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No products found.</td></tr>";
    }

    // Close connection
    $conn->close();
}

// Function to get total number of products
function getTotalProducts()
{
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

    // SQL query to count total number of products
    $sql = "SELECT COUNT(*) as total FROM product";

    // Execute SQL query
    $result = $conn->query($sql);

    // Get total number of products
    $total = $result->fetch_assoc()['total'];

    // Close connection
    $conn->close();

    return $total;
}

// Get total number of products
$totalProducts = getTotalProducts();

// Calculate total number of pages
$totalPages = ceil($totalProducts / $productsPerPage);

// Call the getProducts function to display product data with pagination
getProducts($offset, $productsPerPage);

// Pagination links
echo "<div class='pagination'>";
for ($i = 1; $i <= $totalPages; $i++) {
    echo "<button class='page-btn' onclick='window.location.href=\"CRUD_Product.php?page=$i\"'>$i</button>";
}
echo "</div>";
?>

        </tbody>
    </table>
</div>

            </div>
        </div>
    </div>

</body>
</html>
