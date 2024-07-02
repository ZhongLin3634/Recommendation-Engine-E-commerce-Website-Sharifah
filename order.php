<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="res.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                    <a class="nav-link" href="order.php">Your Order</a>
                </li>
            </ul>
        </div>
        <div>
            <a class="navbar-brand" href="cart.php">
                <img src="cart.png" alt="Add to Cart" width="30" height="30">
            </a>
        </div>
    </nav>
</header>

<div class="container mt-5">
    <h2>Order Management</h2>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Quantity</th>
                        <th>Order_Status</th>
                        <th>Total_amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Database parameters
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $databaseName = "user_sharifah"; // Change this to your actual database name

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $databaseName);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Retrieve order data from the database
                    $sql = "SELECT order_id, product_name, product_price, product_quantity, order_status, total_amount FROM order_summary";
                    $result = $conn->query($sql);

                    // Check if there are any orders
                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["order_id"] . "</td>";
                            echo "<td>" . $row["product_name"] . "</td>";
                            echo "<td>" . $row["product_price"] . "</td>";
                            echo "<td>" . $row["product_quantity"] . "</td>";
                            echo "<td>" . $row["order_status"] . "</td>";
                            echo "<td>" . $row["total_amount"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No orders found.</td></tr>";
                    }

                    // Close the database connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Total amount of all orders -->
    <div class="row">
        <div class="col-md-12">
            <?php
            // Retrieve total amount of all orders from the database
            $conn = new mysqli($servername, $username, $password, $databaseName);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Retrieve total amount from the database
            $sql = "SELECT SUM(total_amount) AS total FROM order_summary";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $total_amount = $row["total"];

            echo "<h4>Total Amount: " . $total_amount . "</h4>";

            // Close the database connection
            $conn->close();
            ?>
        </div>
    </div>
</div>

<footer class="fixed-footer">
    <p>&copy; <?php echo date("Y"); ?> Your Website. All rights reserved.</p>
</footer>

</body>

</html>
