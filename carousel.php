<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Add this in the <head> section of your HTML file -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="carousel.css">

    <!-- Add this before the closing </body> tag of your HTML file -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-lS9F8PvCkHoN9e3U3f+cv2FmZaA/ZmVYY1Pk0adz3lpC2BRQ8cZKKaG28pF7fJ89" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>

<!-- Header -->
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Your Website</a>
        <!-- You can customize your navigation links here -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
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
            </ul>
        </div>
        <!-- Add to Cart Logo and Link -->
        <div>
            <a class="navbar-brand" href="cart.php">
                <img src="add_to_cart_icon.png" alt="Add to Cart" width="30" height="30">
            </a>
        </div>
    </nav>
</header>


<!-- Carousel Section -->
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

    // Example usage
    $imageUrls = [
        'image1.jpg',
        'image2.png',
        'image3.jpeg',
        // Add more image URLs as needed
    ];

    createCarousel($imageUrls);
    ?>
</div>



<!-- Footer -->
<footer class="fixed-footer">
    <!-- Your footer content goes here -->
    <p>&copy; <?php echo date("Y"); ?> Your Website. All rights reserved.</p>
</footer>

</body>
</html>
