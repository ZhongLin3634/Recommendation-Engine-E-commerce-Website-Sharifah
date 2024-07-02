<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin_dashboard.css">

    <script>
    function filterOrders(status) {
        // Redirect to the same page with the status as a query parameter
        window.location.href = window.location.pathname + '?status=' + status;
    }

    function showAllOrders() {
        // Redirect to the same page without any status filter
        window.location.href = window.location.pathname;
    }
    </script>
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
                    <h2>Admin Dashboard - Orders</h2>
                    <div>
                        <button class="btn btn-primary" onclick="filterOrders('Pending')">Pending</button>
                        <button class="btn btn-primary" onclick="filterOrders('Processing')">Processing</button>
                        <button class="btn btn-primary" onclick="filterOrders('Shipped')">Shipped</button>
                        <button class="btn btn-primary" onclick="filterOrders('Delivered')">Delivered</button>
                        <button class="btn btn-secondary" onclick="showAllOrders()">Show All</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>User ID</th>
                                    <th>User Address</th>
                                    <th>Date</th>
                                    <th>Total Amount</th>
                                    <th>Products</th>
                                    <th>Status</th>
                                    <th>Tracking Code</th>                
                                    <th>Action</th>                
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                <?php
                // Database connection
                $conn = new mysqli("localhost", "root", "", "user_sharifah");
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Pagination
                $limit = 10;
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $offset = ($page - 1) * $limit;
                // Fetch all orders or filter by status if provided
                $status = isset($_GET['status']) ? $_GET['status'] : 'All';
                if ($status === 'All') {
                    // Change the query to order by order_date in descending order
                    $sql = "SELECT * FROM orders ORDER BY order_date DESC LIMIT $limit OFFSET $offset";
                } else {
                    // Change the query to order by order_date in descending order
                    $sql = "SELECT * FROM orders WHERE status = '$status' ORDER BY order_date DESC LIMIT $limit OFFSET $offset";
                }
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['order_id'] . "</td>";
                        echo "<td>" . $row['user_id'] . "</td>";
                        
                        // Fetch user address associated with the user_id
                        $user_id = $row['user_id'];
                        $addressSql = "SELECT shipping_address FROM user WHERE id = '$user_id'";
                        $addressResult = $conn->query($addressSql);
                        if ($addressResult->num_rows > 0) {
                            $addressRow = $addressResult->fetch_assoc();
                            echo "<td>" . $addressRow['shipping_address'] . "</td>";
                        } else {
                            echo "<td>No address found</td>";
                        }
                        
                        echo "<td>" . $row['order_date'] . "</td>";
                        echo "<td>RM" . $row['total_amount'] . "</td>";
                        echo "<td>";
                        
                        // Fetch product names and quantities associated with the order
                        $product_ids = explode(',', $row['product_ids']);
                        $quantities = explode(',', $row['quantities']);
                        echo "<ul>";
                        foreach ($product_ids as $index => $product_id) {
                            $productSql = "SELECT Product_Name FROM product WHERE Product_Code = '$product_id'";
                            $productResult = $conn->query($productSql);
                            if ($productResult->num_rows > 0) {
                                $product = $productResult->fetch_assoc();
                                echo "<li>" . $product['Product_Name'] . " - Quantity: " . $quantities[$index] . "</li>";
                            }
                        }
                        echo "</ul>";
                        
                        echo "</td>";
                        echo "<td>" . $row['status'] . "</td>";
                        echo "<td>" . $row['tracking_code'] . "</td>"; 
                        echo "<td>";
                        
                        // Update status form
                        echo "<form action='update_status.php' method='POST'>";
                        echo "<input type='hidden' name='order_id' value='" . $row['order_id'] . "'>";
                        echo "<select name='status'>";
                        echo "<option value='Pending' " . ($row['status'] == 'Pending' ? 'selected' : '') . ">Pending</option>";
                        echo "<option value='Processing' " . ($row['status'] == 'Processing' ? 'selected' : '') . ">Processing</option>";
                        echo "<option value='Shipped' " . ($row['status'] == 'Shipped' ? 'selected' : '') . ">Shipped</option>";
                        echo "<option value='Delivered' " . ($row['status'] == 'Delivered' ? 'selected' : '') . ">Delivered</option>";
                        echo "</select>";
                        echo "<td>";
                        echo "<button type='submit' class='btn btn-primary'>Update Status</button>";
                        echo "</td>";
                        echo "</form>";
                        
                        // Tracking code form
                        echo "<form action='update_tracking_code.php' method='POST'>";
                        echo "<input type='hidden' name='order_id' value='" . $row['order_id'] . "'>";
                        echo "<td>";

                        echo "<input type='text' name='tracking_code' value='" . $row['tracking_code'] . "' placeholder='Enter Tracking Code'>";
                        echo "<button type='submit' class='btn btn-primary'>Update Tracking Code</button>";
                        echo "</td>";

                        echo "</form>";
                        echo "</td>";
                        
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No orders found.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <?php
        // Database connection
        $conn = new mysqli("localhost", "root", "", "user_sharifah");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Count total number of rows
        if ($status === 'All') {
            $countSql = "SELECT COUNT(*) AS count FROM orders";
        } else {
            $countSql = "SELECT COUNT(*) AS count FROM orders WHERE status = '$status'";
        }
        $countResult = $conn->query($countSql);
        $rowCount = $countResult->fetch_assoc()['count'];

        // Calculate total pages
        $totalPages = ceil($rowCount / $limit);

        // Display pagination links
        echo "<ul class='pagination'>";
        for ($i = 1; $i <= $totalPages; $i++) {
            echo "<li class='page-item'><a class='page-link' href='?status=$status&page=$i'>$i</a></li>";
        }
        echo "</ul>";

        $conn->close();
        ?>
    </div>
</div>
            </div>
        </div>
    </div>

</body>
</html>
