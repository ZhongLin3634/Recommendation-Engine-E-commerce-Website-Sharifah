<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sharifah Ready to Eat - Your Cart</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="cart2.css">
    <?php
    // Now you can access session variables, such as $_SESSION['user_id']
    // Example usage:
    session_start();
    if(isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        echo "Logged in user ID: $user_id";
    } else {
        // Redirect the user to the login page if not authenticated
        header("Location: login.php");
        exit();
    }
    ?>
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

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2>Your Cart</h2>
            <div class="cart-items">
                <?php
                // Start session to manage the cart
                // Check if cart session variable exists and is not empty
                if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
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

                    // Initialize an array to store product IDs
                    $product_ids = array_keys($_SESSION['cart']);

                    // Retrieve product details based on product IDs
                    $sql = "SELECT Product_Code, Product_Name, Price,Product_Image_2 FROM product WHERE Product_Code IN ('" . implode("','", $product_ids) . "')";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Display the products in the cart
                        while ($row = $result->fetch_assoc()) {
                            $product_id = $row['Product_Code'];
                            $product_name = $row['Product_Name'];
                            $product_price = $row['Price'];
                            $product_image = $row['Product_Image_2'];
                            $quantity = $_SESSION['cart'][$product_id];

                            // Output product information
                            echo "<div class='cart-item'>";
                            echo "<div class='row'>";
                            echo "<div class='col-md-2'>";
                            echo "<img src='Product Image/Original/$product_image' alt='$product_name' class='img-fluid'>"; // Product Image
                            echo "</div>";
                            echo "<div class='col-md-2'>";
                            echo "<p>$product_name</p>";
                            echo "</div>";
                            echo "<div class='col-md-2'>";
                            echo "<p>RM$product_price</p>";
                            echo "</div>";
                            echo "<div class='col-md-2'>";
                            echo "<input type='number' name='quantity[$product_id]' value='$quantity' min='1' style='width: 70px; padding: 5px;' onchange='updateQuantity(this)'>"; // Quantity input with adjusted size
                            echo "</div>";
                            echo "<div class='col-md-2'>";
                            echo "</div>"; // Close previous column
                            echo "<div class='col-md-2'>";
                            echo "<input type='checkbox' name='selectedProducts[]' data-price='$product_price'>"; // Checkbox for product selection
                            echo "</div>";

                            echo "<div class='col-md-2'>";
                            echo "<form action='remove_from_cart.php' method='post'>";
                            echo "<input type='hidden' name='product_id' value='$product_id'>";
                            echo "<button type='submit' class='btn btn-danger'>Remove</button>";
                            echo "</form>";
                            echo "</div>";
                            echo "</div>"; // Closing row div
                            echo "</div>"; // Closing cart-item div
                        }
                    } else {
                        // If no products found in the database
                        echo "No products found in the database.";
                    }

                    // Close the database connection
                    $conn->close();
                } else {
                    // If the cart is empty
                    echo "Your cart is empty.";
                }
                ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="payment-options">
                <h2>Payment Options</h2>
                <form action="process_payment.php" method="POST" id="paymentForm">
                    <div class="form-group">
                        <label for="payment_method">Select Payment Method:</label><br>
                        <input type="radio" name="payment_method" value="Bank Transfer" id="bankTransfer">
                        <label for="bankTransfer">Bank Transfer</label><br>
                        <input type="radio" name="payment_method" value="Visa/Credit Card" id="creditCard">
                        <label for="creditCard">Visa/Credit Card</label><br>
                        <input type="radio" name="payment_method" value="TNG" id="tng">
                        <label for="tng">Touch 'n Go eWallet</label><br>
                    </div>
                    <button type="submit" class="btn btn-primary">Proceed to Payment</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap and other JavaScript libraries -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
<script>
    function updateQuantity(input) {
        const product_id = input.name.split('[')[1].split(']')[0]; // Extract product ID from input name
        const new_quantity = input.value; // Get the new quantity

        // Send an AJAX request to update_cart.php with product ID and new quantity
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_cart.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (xhr.status === 200) {
                console.log(xhr.responseText); // Log the response
                // You can update the total price if needed here
            }
        };
        xhr.send('product_id=' + product_id + '&new_quantity=' + new_quantity);
    }
</script>

</body>

</html>
