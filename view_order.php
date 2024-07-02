<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Orders</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="view_order.css">
    <style>
        .pagination {
            justify-content: center;
            margin-top: 20px;
        }
        .pagination a {
            color: #000;
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color .3s;
            border: 1px solid #ddd;
            margin: 0 4px;
        }
        .pagination a.active {
            background-color: #007bff;
            color: white;
            border: 1px solid #007bff;
        }
        .pagination a:hover:not(.active) {background-color: #ddd;}
    </style>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="Home.php">Sharifah Ready to Eat</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="Home.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php">Cart</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="view_order.php">Your Orders</a>
                </li>
            </ul>
        </div>
        <div>
            <a class="navbar-brand" href="cart.php">
                <img src="cart.png" alt="Add to Cart" width="30" height="30">
            </a>
            <a class="navbar-brand" href="profile.php">
                <img src="user.png" alt="User Profile" class="img-fluid rounded-circle" width="30" height="30">
            </a>
            <a class="navbar-brand" href="login.php">
                <img src="logout.png" alt="Logout" width="30" height="30">
            </a>
        </div>
    </nav>
</header>

<div class="container mt-5">
    <h2>Your Orders</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Date</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Tracking Code</th>
            </tr>
        </thead>
        <tbody>
            <?php
            session_start();
            if (!isset($_SESSION['user_id'])) {
                echo "<p>Error: You must be logged in to view your orders.</p>";
                exit;
            }

            $user_id = $_SESSION['user_id'];
            $orders_per_page = 10;
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
            $offset = ($current_page - 1) * $orders_per_page;

            // Database connection
            $conn = new mysqli("localhost", "root", "", "user_sharifah");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Count total orders for pagination
            $count_sql = "SELECT COUNT(*) as total FROM orders WHERE user_id = $user_id";
            $count_result = $conn->query($count_sql);
            $total_orders = $count_result->fetch_assoc()['total'];
            $total_pages = ceil($total_orders / $orders_per_page);

            // Fetch orders for the current page
            $sql = "SELECT * FROM orders WHERE user_id = $user_id ORDER BY order_date DESC LIMIT $orders_per_page OFFSET $offset";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($order = $result->fetch_assoc()) {
                    $product_ids = explode(',', $order['product_ids']);
                    $quantities = explode(',', $order['quantities']);

                    // Start the table row
                    echo "<tr>";
                    echo "<td rowspan='".count($product_ids)."'>".$order['order_id']."</td>";
                    echo "<td rowspan='".count($product_ids)."'>".$order['order_date']."</td>";

                    // Product details
                    foreach ($product_ids as $index => $product_id) {
                        if ($index > 0) echo "<tr>"; // Start a new row after the first product
                        $productSql = "SELECT Product_Name, Price FROM product WHERE Product_Code = '$product_id'";
                        $productResult = $conn->query($productSql);

                        if ($productResult->num_rows > 0) {
                            $product = $productResult->fetch_assoc();
                            echo "<td>".$product['Product_Name']."</td>";
                            echo "<td>".$quantities[$index]."</td>";
                            echo "<td>RM".$product['Price']."</td>";

                            if ($index == 0) { // Only on the first iteration
                                echo "<td rowspan='".count($product_ids)."'>RM".$order['total_amount']."</td>";
                                echo "<td rowspan='".count($product_ids)."'>".$order['status']."</td>";
                                echo "<td rowspan='".count($product_ids)."'>".$order['tracking_code']."</td>";
                            }

                        }
                        if ($index > 0) echo "</tr>"; // End the row after the first product
                    }
                    // Close the first row if there are products, otherwise span across
                    echo (count($product_ids) > 0) ? "</tr>" : "<td colspan='7'>No products found.</td></tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No orders found.</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<!-- Pagination controls -->
<div class="pagination">
    <?php if ($current_page > 1) : ?>
        <a href="?page=<?php echo $current_page - 1; ?>">Previous</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
        <a href="?page=<?php echo $i; ?>" <?php echo ($i == $current_page) ? 'class="active"' : ''; ?>><?php echo $i; ?></a>
    <?php endfor; ?>

    <?php if ($current_page < $total_pages) : ?>
        <a href="?page=<?php echo $current_page + 1; ?>">Next</a>
    <?php endif; ?>

</div>
<br>
    <br>
    <br>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<footer class="fixed-footer" style="margin-top: 40px;"> <!-- Add margin-top to create distance from the pagination -->
    <p>&copy; <?php echo date("Y"); ?> Your Website. All rights reserved.</p>
</footer>
</body>
</html>
