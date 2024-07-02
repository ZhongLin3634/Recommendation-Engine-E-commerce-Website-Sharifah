<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="res.css">
    <!-- Add this line to link animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-lS9F8PvCkHoN9e3U3f+cv2FmZaA/ZmVYY1Pk0adz3lpC2BRQ8cZKKaG28pF7fJ89"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    <div class="my-carousel-container">
        <?php
        function createCarousel($imageUrls)
        {
            echo '<div id="myCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">';

            $active = true;

            foreach ($imageUrls as $imageUrl) {
                echo '<div class="carousel-item ' . ($active ? 'active' : '') . '">
                        <img src="' . $imageUrl . '" class="d-block w-100" alt="Image">
                      </div>';
                $active = false;
            }

            echo '</div>
                <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>';
        }

        
        // Directory path
        $directory = 'Product Image/Original/';
        
        // Get all files in the directory
        $imageFiles = scandir($directory);
        
        // Filter out non-image files (directories, etc.)
        $imageFiles = array_filter($imageFiles, function ($file) {
            return preg_match('/\.(jpg|jpeg|png|gif)$/i', $file);
        });
        
        // Create an array of image URLs
        $carouselImageUrls = array_map(function ($file) use ($directory) {
            return $directory . $file;
        }, $imageFiles);
        
        // Shuffle the array to randomize the order
        shuffle($carouselImageUrls);
        

        createCarousel($carouselImageUrls);
        ?>
    </div>

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

// Fetch a random product from the database
$sql = "SELECT Product_Code, Product_Name, Price,Product_Image,Product_Image_2 FROM product ORDER BY RAND() LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $product_id = $row['Product_Code'];
    $product_name = $row['Product_Name'];
    $product_price = $row['Price'];
    $product_image=$row['Product_Image'];
    $product_image_2 = $row['Product_Image_2'];

}
?>

<!-- Modal -->
<div class="modal fade" id="recommendModal" tabindex="-1" role="dialog" aria-labelledby="recommendModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="recommendModalLabel">Today Recommend !!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Display the random product details -->
                <h5><?php echo $product_name; ?></h5>
                <!-- Display the product image from Product_Image_2 -->
                <img src="Product Image/<?php echo $product_image_2; ?>" alt="<?php echo $product_name; ?>" class="card-img-top">
                <p>Price: RM<?php echo $product_price; ?></p>
            </div>
            <div class="modal-footer">
                <!-- Link to product_details.php with product ID -->
                <a href="product_details.php?id=<?php echo $product_id; ?>" class="btn btn-primary">View Details</a>
            </div>
        </div>
    </div>
</div>



<!--Using res.css-->
<div class="container2">
         <div class="card__container">
            <article class="card__article">
               <img src="Product Image/Original/KA.png" alt="image" class="card__img">

               <div class="card__data">
                  <span class="card__description">Sharifah Ready To Eat</span>
                  <h2 class="card__title">Ready To Eat</h2>
                  <a href="#RTE" class="card__button">View More</a>
               </div>
            </article>

            <article class="card__article">
               <img src="Product Image/Original/PMG.png" alt="image" class="card__img">

               <div class="card__data">
                  <span class="card__description">Sharifah Ready To Eat</span>
                  <h2 class="card__title">Ready To Cook</h2>
                  <a href="#RTC" class="card__button">View More</a>
               </div>
            </article>

            <article class="card__article">
               <img src="Product Image/Original/STIB.png" alt="image" class="card__img">

               <div class="card__data">
                  <span class="card__description">Sharifah Ready To Eat</span>
                  <h2 class="card__title">Paste & Others</h2>
                  <a href="#PO" class="card__button">View More</a>
               </div>
            </article>
            
         </div>
      </div>

      <?php
// Product data
$products = [
    ["id" => "DS/NP", "name" => "Daging Salai","total_sales" => 14265.0, "image_url" => "Product Image/Original/NBGA.png"],

    ["id" => "NGK","name" => "Nasi Goreng Kampung", "total_sales" => 12385.0, "image_url" => "Product Image/Original/NBGA.png"],
    ["id" => "NBGA","name" => "Nasi Briyani Gam Ayam", "total_sales" => 10939.0, "image_url" => "Product Image/Original/NBGA.png"],
    ["id" => "NGA","name" => "Nasi Goreng Ayam", "total_sales" => 9909.0, "image_url" =>  "Product Image/Original/NBGA.png"],
    ["id" => "NGIM","name" => "Nasi Goreng Ikan Masin", "total_sales" => 9784.0, "image_url" => "Product Image/Original/NGIM.png"],
    ["id" => "NGD", "name" => "Nasi Goreng Daging","total_sales" => 9742.0, "image_url" => "Product Image/Original/NGD.png"],
    ["id" => "SSK","name" => "Sambal Sotong Kering", "total_sales" => 9520.0, "image_url" => "Product Image/Original/SSK.png"],
    ["id" => "STIB","name" => "Sambal Tumis Ikan Bilis", "total_sales" => 8756.0, "image_url" => "Product Image/Original/STIB.png"],
    ["id" => "KA", "name" => "Kari Ayam","total_sales" => 7420.0, "image_url" => "Product Image/Original/KA.png"],
    ["id" => "RD", "name" => "Rendang Dendeng","total_sales" => 6964.0, "image_url" => "Product Image/Original/RD.png"]
];


echo '<div class="product-category">';
echo '<h2 class="category-title">Ready To Eat Top Sales</h2>'; // Removed inline styles for best practices
echo '<div class="product-container">';

// Counter to keep track of products
$counter = 0;

// Iterate over products
foreach ($products as $product) {
    // Every 5 products, close the previous row and start a new one
    if ($counter % 5 == 0) {
        // Close the previous row unless it's the first product
        if ($counter > 0) {
            echo '</div>'; // Close the previous row
        }
        echo '<div class="row">'; // Start a new row
    }

    // Output product card with link including product ID and name
    echo '<div class="card">';
    echo '<a href="product_details.php?id=' . $product["id"] . '&name=' . urlencode($product["name"]) . '" class="card-link">';
    echo '<img src="' . $product["image_url"] . '" alt="' . htmlspecialchars($product["name"], ENT_QUOTES, 'UTF-8') . '" class="card-img">';
    echo '<div class="card-details">';
    echo '<p class="product-name">' . htmlspecialchars($product["name"], ENT_QUOTES, 'UTF-8') . '</p>';
    echo '<p class="product-price">Total Sales Volume: ' . $product["total_sales"] . '</p>';
    echo '</div></a></div>';

    $counter++; // Increment the counter
}

// Close the last row if it's not empty
if ($counter % 5 != 0) {
    echo '</div>'; // Close the last row
}

echo '</div></div>';

?>

<style>
    /* CSS animation for the heading */
    @keyframes hotEffect {
        0% { color: black; }
        50% { color: red; }
        100% { color: black; }
    }
</style>


<div class="product-category" id="RTE" ><!--RTE-->
<?php
$products = [
    "NL","NBGA","NBGD","NBGK",
    "SSK","STIB","RD","RM",
    "NGK","NGU","NGIM","NGS",
    "NGA","NGD","KA","KD",
    "TYA","DS/NP"
];
// Database parameters
$servername = "localhost";
$username = "root";
$password = "";
$databaseName = "user_sharifah";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $databaseName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Generate HTML
echo '<div class="product-category">';
echo '<h2 style="animation: hotEffect 2s infinite; cursor: pointer;" onmouseover="this.style.transform=\'scale(1.1)\'" onmouseout="this.style.transform=\'scale(1)\'">Ready To Eat </h2>'; // Add inline style and hover effect for h2
echo '<div class="product-container">';

// Counter for tracking products per row
$product_count = 0;

// Iterate over products
foreach ($products as $product_id) {
    // Query to retrieve product details based on Product_Code
    $sql = "SELECT Product_Name, Price, Product_Image, Product_Image_2 FROM product WHERE Product_Code = '$product_id'";
    
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
            // Start a new row if the product count is divisible by 5
            if ($product_count % 6 === 0) {
                echo '<div class="row">';
            }
            
            // Output product card with link including product name and image
            echo '<div class="card">';
            echo '<a href="product_details.php?id=' . $product_id . '&name=' . urlencode($row["Product_Name"]) . '" class="card-link">';
            echo '<img src="Product Image/Original/' . $row["Product_Image_2"] . '" alt="' . $row["Product_Name"] . '" class="card-img-top">'; // Display the product image from file path

          //  echo '<img src="' . $row["Product_Image_2"] . '" alt="' . $row["Product_Name"] . '" class="card-img">';
            echo '<div class="card-details">';
            echo '<p class="product-name">' . $row["Product_Name"] . '</p>'; // Display product name instead of ID
            echo '<p class="card-text">Price: ' . $row["Price"] . '</p>';

            echo '</div></a></div>';
            
            // Increment product count
            $product_count++;
            
            // Close the row if the product count reaches 6
            if ($product_count % 6 === 0) {
                echo '</div>'; // Close the row
            }
        }
    } else {
        echo "No products found with ID: $product_id<br>";
    }
}

// Close the row if the last row has less than 6 products
if ($product_count % 6 !== 0) {
    echo '</div>'; // Close the row
}

echo '</div></div>'; // Close the product-container and product-category divs

// Close the database connection
$conn->close();

?>
</div>
<div class="product-category" id="RTC"><!--RTC-->
<?php
/*$products = [
    ["id"=>"NBG","name"=>"Nasi Briyani Gam","image_url"=>"Product Image/NBGA.jpg"],
    ["id"=>"NBH","name"=>"Nasi Briyani Herba","image_url"=>"Product Image/NBGA.jpg"],
    ["id"=>"NBT","name"=>"Nasi Briyani Tomato","image_url"=>"Product Image/NBGA.jpg"],
    ["id"=>"NBB","name"=>"Nasi Briyani Bukhari","image_url"=>"Product Image/NBGA.jpg"],

];*/
$products=[
    "NBG","NBH","NBT","NBB"
];
// Database parameters
$servername = "localhost";
$username = "root";
$password = "";
$databaseName = "user_sharifah";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $databaseName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Generate HTML
echo '<div class="product-category">';
echo '<h2 style="animation: hotEffect 2s infinite; cursor: pointer;" onmouseover="this.style.transform=\'scale(1.1)\'" onmouseout="this.style.transform=\'scale(1)\'">Ready To Cook </h2>'; // Add inline style and hover effect for h2
echo '<div class="product-container">';

// Counter for tracking products per row
$product_count = 0;

// Iterate over products
foreach ($products as $product_id) {
    // Query to retrieve product details based on Product_Code
    $sql = "SELECT Product_Name, Price, Product_Image, Product_Image_2 FROM product WHERE Product_Code = '$product_id'";
    
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
            // Start a new row if the product count is divisible by 5
            if ($product_count % 4 === 0) {
                echo '<div class="row">';
            }
            
            // Output product card with link including product name and image
            echo '<div class="card">';
            echo '<a href="product_details.php?id=' . $product_id . '&name=' . urlencode($row["Product_Name"]) . '" class="card-link">';
            echo '<img src="Product Image/Original/' . $row["Product_Image_2"] . '" alt="' . $row["Product_Name"] . '" class="card-img-top">'; // Display the product image from file path

          //  echo '<img src="' . $row["Product_Image_2"] . '" alt="' . $row["Product_Name"] . '" class="card-img">';
            echo '<div class="card-details">';
            echo '<p class="product-name">' . $row["Product_Name"] . '</p>'; // Display product name instead of ID
            echo '<p class="card-text">Price: ' . $row["Price"] . '</p>';

            echo '</div></a></div>';
            
            // Increment product count
            $product_count++;
            
            // Close the row if the product count reaches 6
            if ($product_count % 4 === 0) {
                echo '</div>'; // Close the row
            }
        }
    } else {
        echo "No products found with ID: $product_id<br>";
    }
}

// Close the row if the last row has less than 6 products
if ($product_count % 6 !== 0) {
    echo '</div>'; // Close the row
}

echo '</div></div>'; // Close the product-container and product-category divs

// Close the database connection
$conn->close();

?>
</div>
<div class="product-category" id="PO"><!--PO-->
<?php
$products = [
    "PKKI",
    "PNGK",
    "PMK",
    "PST",
    "PAP",
    "PMTR",
    "PMG",
    "TGA",
    "TGR",
    "Santan"
];
// Database parameters
$servername = "localhost";
$username = "root";
$password = "";
$databaseName = "user_sharifah";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $databaseName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Generate HTML
echo '<div class="product-category">';
echo '<h2 style="animation: hotEffect 2s infinite; cursor: pointer;" onmouseover="this.style.transform=\'scale(1.1)\'" onmouseout="this.style.transform=\'scale(1)\'">Paste & Other </h2>'; // Add inline style and hover effect for h2
echo '<div class="product-container">';

// Counter for tracking products per row
$product_count = 0;

// Iterate over products
foreach ($products as $product_id) {
    // Query to retrieve product details based on Product_Code
    $sql = "SELECT Product_Name, Price, Product_Image, Product_Image_2 FROM product WHERE Product_Code = '$product_id'";
    
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
            // Start a new row if the product count is divisible by 5
            if ($product_count % 5 === 0) {
                echo '<div class="row">';
            }
            
            // Output product card with link including product name and image
            echo '<div class="card">';
            echo '<a href="product_details.php?id=' . $product_id . '&name=' . urlencode($row["Product_Name"]) . '" class="card-link">';
            echo '<img src="Product Image/Original/' . $row["Product_Image_2"] . '" alt="' . $row["Product_Name"] . '" class="card-img-top">'; // Display the product image from file path

          //  echo '<img src="' . $row["Product_Image_2"] . '" alt="' . $row["Product_Name"] . '" class="card-img">';
            echo '<div class="card-details">';
            echo '<p class="product-name">' . $row["Product_Name"] . '</p>'; // Display product name instead of ID
            echo '<p class="card-text">Price: ' . $row["Price"] . '</p>';

            echo '</div></a></div>';
            
            // Increment product count
            $product_count++;
            
            // Close the row if the product count reaches 6
            if ($product_count % 5 === 0) {
                echo '</div>'; // Close the row
            }
        }
    } else {
        echo "No products found with ID: $product_id<br>";
    }
}

// Close the row if the last row has less than 6 products
if ($product_count % 5 !== 0) {
    echo '</div>'; // Close the row
}

echo '</div></div>'; // Close the product-container and product-category divs

// Close the database connection
$conn->close();

?>
</div>

<div class="product-category"><!--Bundle-->
<?php
$products=[
    "NGUNGD","NGKNGD","NGKNGA","NGANGD","NGKNGU"
];
/*$products = [
    ["id"=>"1","name"=>"NGK with NGD","image_url"=>"Product Image/NBGA.jpg","description"=>"NGK with NGD"],
    ["id"=>"2","name"=>"NGU with NGD","image_url"=>"Product Image/NBGA.jpg","description"=>"NGU with NGD"],
    ["id"=>"3","name"=>"NGA with NGD","image_url"=>"Product Image/NBGA.jpg","description"=>"NGA with NGD"],
    ["id"=>"4","name"=>"NGK with NGA","image_url"=>"Product Image/NBGA.jpg","description"=>"NGK with NGA"],
    ["id"=>"5","name"=>"NGK with NGD","image_url"=>"Product Image/NBGA.jpg","description"=>"NGK with NGU"],
];*/

// Database parameters
$servername = "localhost";
$username = "root";
$password = "";
$databaseName = "user_sharifah";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $databaseName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Generate HTML
echo '<div class="product-category">';
echo '<h2 style="animation: hotEffect 2s infinite; cursor: pointer;" onmouseover="this.style.transform=\'scale(1.1)\'" onmouseout="this.style.transform=\'scale(1)\'">Bundle Set</h2>'; // Add inline style and hover effect for h2
echo '<div class="product-container">';

// Counter for tracking products per row
$product_count = 0;

// Iterate over products
foreach ($products as $product_id) {
    // Query to retrieve product details based on Product_Code
    $sql = "SELECT Product_Name, Price, Product_Image, Product_Image_2 FROM product WHERE Product_Code = '$product_id'";
    
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
            // Start a new row if the product count is divisible by 5
            if ($product_count % 5 === 0) {
                echo '<div class="row">';
            }
            
            // Output product card with link including product name and image
            echo '<div class="card">';
            echo '<a href="product_details.php?id=' . $product_id . '&name=' . urlencode($row["Product_Name"]) . '" class="card-link">';
            echo '<img src="Product Image/Original/' . $row["Product_Image_2"] . '" alt="' . $row["Product_Name"] . '" class="card-img-top">'; // Display the product image from file path

          //  echo '<img src="' . $row["Product_Image_2"] . '" alt="' . $row["Product_Name"] . '" class="card-img">';
            echo '<div class="card-details">';
            echo '<p class="product-name">' . $row["Product_Name"] . '</p>'; // Display product name instead of ID
            echo '<p class="card-text">Price: ' . $row["Price"] . '</p>';

            echo '</div></a></div>';
            
            // Increment product count
            $product_count++;
            
            // Close the row if the product count reaches 6
            if ($product_count % 5 === 0) {
                echo '</div>'; // Close the row
            }
        }
    } else {
        echo "No products found with ID: $product_id<br>";
    }
}

// Close the row if the last row has less than 6 products
if ($product_count % 5 !== 0) {
    echo '</div>'; // Close the row
}

echo '</div></div>'; // Close the product-container and product-category divs

// Close the database connection
$conn->close();
?>
</div>


    <footer class="fixed-footer">
        <p>&copy; <?php echo date("Y"); ?> Your Website. All rights reserved.</p>
    </footer>

<!-- Add these script tags to include jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
    integrity="sha384-lS9F8PvCkHoN9e3U3f+cv2FmZaA/ZmVYY1Pk0adz3lpC2BRQ8cZKKaG28pF7fJ89"
    crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        // Define an array of image paths
        var imageArray = ["image1.jpg", "image2.png", "image3.jpeg", "image4.png"];

        // Get a random index from the array
        var randomIndex = Math.floor(Math.random() * imageArray.length);

        // Set the source attribute of the image to the randomly selected image
        $('#randomImage').attr('src', imageArray[randomIndex]);

        // Open the modal
        $('#recommendModal').modal('show');
    });
</script>

</body>

</html>
