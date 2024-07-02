<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="res.css">
    <link rel="stylesheet" href="product_details.css"> 
    <!-- Include the product_details.css file -->
    <!-- Add other head elements as needed -->
    <!--Use to change image on Product details-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="path/to/bootstrap.min.css">
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
<?php
    // Get the product ID from the URL
    $product_id = $_GET['id'];




    // Now you can use $product_id to retrieve the details of the selected product
    // For example, you can fetch product details from a database based on this ID
    ?>

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

    <div class="container product-details-container">
    <div class="row">
        <div class="col-md-6">

            <!-- Product image -->
<?php
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

// SQL query to retrieve product details
$sql = "SELECT Product_Name, Price, Description, Product_Image_2 FROM product WHERE Product_Code = '$product_id'";

// Execute SQL query
$result = $conn->query($sql);

// Check if query was successful
if ($result) {
    // Fetch row from result
    $row = $result->fetch_assoc();

    // Check if row was found
    if ($row) {
        // Use the fetched row to display product details
        echo '<img id="mainImage" src="Product Image/Original/' . $row["Product_Image_2"] . '" alt="' . $row["Product_Name"] . '" class="img-fluid">';

        // You can display other product details here
    } else {
        echo "Product not found";
    }
} else {
    echo "Error executing query: " . $conn->error;
}

// Close connection
$conn->close();
?>            <!-- Additional images below the main image -->
            <div class="row mt-3">
                <div class="col-3">
                    <img src="Product Image/Original/KA.png" alt="Image 2" class="thumbnail img-fluid" data-main-image="Product Image/Original/KA.png">
                </div>
                <div class="col-3">
                    <img src="Product Image/Original/SD.png" alt="Image 3" class="thumbnail img-fluid" data-main-image="Product Image/Original/SD.png">
                </div>
                <div class="col-3">
                    <img src="Product Image/Original/PNGK.png" alt="Image 4" class="thumbnail img-fluid" data-main-image="Product Image/Original/STIB.png">
                </div>
                <div class="col-3">
                    <img src="Product Image/Original/PMK.png" alt="Image 5" class="thumbnail img-fluid" data-main-image="Product Image/Original/PMG.png">
                </div>
                <div class="col-3">
                    <img src="Product Image/Original/PAP.png" alt="Image 3" class="thumbnail img-fluid" data-main-image="Product Image/Original/PBG.png">
                </div>
            </div>
        </div>
        <!-- Small container to display the selected image -->
        <div id="selectedImageContainer" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 999;">
            <img id="selectedImage" alt="Selected Image" class="img-fluid">
        </div>

        <div class="col-md-6">
            <!-- Product details form -->
            <form action="add_to_cart.php" method="post">
                <div class="product-details">
                    <?php
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
                    // Check if product ID is provided in the URL
                    if (isset($_GET['id']) && !empty($_GET['id'])) {
                        // Sanitize the input to prevent any malicious input
                        $product_id = htmlspecialchars($_GET['id']);

                        // Query to retrieve product details based on Product_Code
                        $sql = "SELECT Product_Name, Price, Description FROM product WHERE Product_Code = '$product_id'";

                        // Execute query
                        $result = $conn->query($sql);

                        // Check if there are any results
                        if ($result->num_rows > 0) {
                            // Fetch product details
                            $row = $result->fetch_assoc();
                            $product_name = $row["Product_Name"];
                            $product_price = $row["Price"];
                            $product_description = $row["Description"];

                            // Display the product details
                            echo '<h3>' . $product_name . '</h3>';
                            echo '<p>Price: RM' . $product_price . '</p>';
                            echo '<p>Description: ' . $product_description . '</p>';
                            // Add a hidden input field to pass the product ID along with the form submission
                            echo '<input type="hidden" name="product_id" value="' . $product_id . '">';
                        } else {
                            // If product with the given code is not found in the database
                            echo 'Product not found.';
                        }
                    } else {
                        // If product ID is missing in the URL
                        echo 'Product ID is missing.';
                    }
                    ?>

                    <!-- Quantity input -->
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" value="1" min="1">
                    <br>

                    <!-- Add to Cart button -->
                    <div class="button-container">
                        <!-- Change anchor tag to a submit button -->
                        <button type="submit" class="view-details add-to-cart">Add to Cart</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>



<br>

<?php

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

// Array of recommendations new version database
$recommendations = [
    "NBGA" => [
        "NGIM", "NGS", "NGD", "NGK", "NGU"
    ],
    "DS/NP" => [
        "KA", "NGK", "NGU", "NGA", "RD"
    ],
    "NBGD" => [
        "NBGK", "RM", "NGD", "NGA", "RD"
    ],
    "NGK" => [
        "NGD", "NGA", "NGU", "NGS", "NGIM"
    ],
    "SSK" => [
        "KA", "NGK", "NGA", "RD", "NGD"
    ],
    "RD" => [
        "RM", "NGK", "KA", "NGD", "NGA"
    ],
    "RDm" => [
        "KA", "STIB", "SSK", "DS/NP", "RD"
    ],
    "RM" => [
        "RD", "NBGD", "NBGK", "NGA", "NGD"
    ],
    "STIB" => [
        "KA", "NGD", "NGA", "NGK", "RD"
    ],
    "NL" => [
        "NGK", "NGU", "NGA", "TGA", "NGD"
    ],
    "NGU" => [
        "NGD", "NGK", "NGA", "NGS", "NGIM"
    ],
    "NBG" => [
        "NBB", "NBH", "NBT", "RD", "NGA"
    ],
    "PKKI" => [
        "PMTR", "PAP", "PMK", "PNGK", "PST"
    ],
    "PNBG" => [
        "PMK", "PAP", "PNGK", "PMTR", "PMG"
    ],
    "TGR" => [
        "PMG", "TGA", "PAP", "PMK", "PMTR"
    ],
    "Santan" => [
        "NBH", "NBT", "TGA", "NBB", "NL"
    ],
    "KD" => [
        "KA", "TAM", "RM", "NBGK", "NGK"
    ],
    "TAM" => [
        "KA", "KD", "RM", "NGD", "STIB"
    ],
    "PMTR" => [
        "PMK", "PAP", "PMG", "PST", "PKKI"
    ],
    "PNGK" => [
        "PMTR", "PKKI", "PMK", "PAP", "PMG"
    ],
    "PST" => [
        "PMTR", "PAP", "PMG", "PMK", "PKKI"
    ],
    "PMG" => [
        "PAP", "PMK", "PMTR", "TGR", "PST"
    ],
    "TGA" => [
        "TGR", "PMTR", "PMK", "PMG", "PKKI"
    ],
    "NBGK" => [
        "NBGD", "RM", "NGU", "NGD", "NGK"
    ],
    "NGIM" => [
        "NBGA", "NGS", "NGD", "NGK", "NGU"
    ],
    "NGA" => [
        "NGD", "NGK", "NGU", "KA", "NGS"
    ],
    "KA" => [
        "NGA", "KD", "NGK", "NGD", "STIB"
    ],
    "NGS" => [
        "NGIM", "NBGA", "NGD", "NGK", "NGU"
    ],
    "NGD" => [
        "NGA", "NGK", "NGU", "NGS", "NGIM"
    ],
    "NBH" => [
        "NBT", "NBB", "NBG", "TGA", "Santan"
    ],
    "NBT" => [
        "NBH", "NBB", "NBG", "TGA", "NBGK"
    ],
    "NBB" => [
        "NBG", "NBT", "NBH", "NBGK", "RD"
    ],
    "PMK" => [
        "PMTR", "PAP", "PMG", "PST", "PKKI"
    ],
    "PAP" => [
        "PMG", "PMTR", "PMK", "PST", "PKKI"
    ]
];
$current_product = isset($_GET['id']) ? $_GET['id'] : null; // Get product ID from GET parameter
$current_product_name = isset($_GET['name']) ? htmlspecialchars($_GET['name']) : null;

echo '<div class="product-category">';
echo '<h2>Recommendations for ' . $current_product . ':</h2>';
echo '<div class="product-container">';

// Check if the current product exists in the recommendations array
if (array_key_exists($current_product, $recommendations)) {
    // Loop through each recommendation for the current product
    foreach ($recommendations["$current_product"] as $id) {
        // Query to retrieve product details based on Product_Code
        $sql = "SELECT Product_Name, Price, Product_Image,Product_Image_2 FROM product WHERE Product_Code = '$id'";
        
        // Execute query
        $result = $conn->query($sql);
        
        // Check for query errors
        if (!$result) {
            echo "Error executing query: " . $conn->error;
            continue; // Skip to the next iteration
        }
        
        // Check if there are any results
        if ($result->num_rows > 0) {
            // Output data of each row in a clickable card
            while ($row = $result->fetch_assoc()) {
                echo '<div class="card-container">';
                echo '<a href="product_details.php?id=' . $id . '" class="card-link">'; // Add the link to product details page
                echo '<div class="card">';
                echo '<img src="Product Image/Original/' . $row["Product_Image_2"] . '" alt="' . $row["Product_Name"] . '" class="card-img-top">'; // Display the product image from file path
                $imageData = base64_encode($row["Product_Image"]);
             //   echo '<img src="data:image/jpeg;base64,' . $imageData . '" alt="' . $row["Product_Name"] . '" class="card-img-top">'; // Display the product image
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $row["Product_Name"] . '</h5>';
                echo '<p class="card-text">Price: ' . $row["Price"] . '</p>';
                // Add more product details here if needed
                echo '</div></div>';
                echo '</a>'; // Close anchor tag
                echo '</div>'; // Close card-container
            }
        } else {
            echo "Product with ID $id not found<br>";
        }
    }
} else {
// If the current product is not found in recommendations, randomly recommend 8 products from the database
$sql = "SELECT Product_Code, Product_Name, Price, Product_Image_2 FROM product ORDER BY RAND() LIMIT 8";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo '<div class="product-category">';
    echo '<div class="product-container">';
    while ($row = $result->fetch_assoc()) {
        echo '<div class="card">';
        echo '<a href="product_details.php?id=' . $row["Product_Code"] . '" class="card-link">';
        echo '<div class="card-img-container">';
        echo '<img src="Product Image/Original/' . $row["Product_Image_2"] . '" alt="' . $row["Product_Name"] . '" class="card-img">';
        echo '</div>';
        echo '<div class="card-details">';
        echo '<h5 class="card-title">' . $row["Product_Name"] . '</h5>';
        echo '<p class="card-text">Price: ' . $row["Price"] . '</p>';
        // Add more product details here if needed
        echo '</div></div>';
        echo '</a>';
    }
    echo '</div></div>';
} else {
    echo "No products found in the database.";
}
}

echo '</div></div>'; // Close product-container and product-category divs

// Close connection
$conn->close();
?>
<div class="product-category">
    <h2>You Might Like</h2>
    <div class="product-container">
        <?php
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

        // SQL query to select random 8 products with Product_Code
        $sql = "SELECT Product_Code, Product_Name, Price, Product_Image_2 FROM product ORDER BY RAND() LIMIT 16";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                $product_code = $row['Product_Code'];
                $product_name = $row['Product_Name'];
                $product_price = $row['Price'];
                $product_image = $row['Product_Image_2'];
        ?>
                <div class="card">
                    <a href="product_details.php?id=<?php echo $product_code; ?>" class="card-link">
                    <img src="<?php echo 'Product Image/Original/' . $row["Product_Image_2"]; ?>" alt="<?php echo $row["Product_Name"]; ?>" class="card-img">

                        <div class="card-details">
                            <p class="product-name"><?php echo $product_name; ?></p>
                            <p class="product-price">RM<?php echo $product_price; ?></p>
                            <!-- You can add other details like sold count and ratings here -->
                        </div>
                    </a>
                </div>
        <?php
            }
        } else {
            echo "No products found.";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</div>





<!--change image function-->
<script>
    $(document).ready(function () {
        var defaultImageSrc = $('#mainImage').attr('src'); // Store the default image source

        // Handle hover/press on small images
        $('.thumbnail').hover(function () {
            var newImageSrc = $(this).data('main-image');
            $('#mainImage').attr('src', newImageSrc);
        }, function () {
            // Handle when mouse leaves the small image
            $('#mainImage').attr('src', defaultImageSrc);
        });
    });
</script>
<script>
    $(document).ready(function () {
        // Add animation when "Add to Cart" button is clicked
        $('.add-to-cart').click(function () {
            $(this).addClass('add-to-cart-animation'); // Add animation class
            setTimeout(() => {
                $(this).removeClass('add-to-cart-animation'); // Remove animation class after 0.5 seconds
            }, 500);
        });
    });
</script>




    <footer class="fixed-footer">
        <p>&copy; <?php echo date("Y"); ?> Your Website. All rights reserved.</p>
    </footer>

</body>

</html>
