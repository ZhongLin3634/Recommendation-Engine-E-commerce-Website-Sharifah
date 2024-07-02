<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Your Website</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">
    /* Add your additional styles here */
    
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Your Website</a>
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
                </ul>
            </div>
            <div>
                <a class="navbar-brand" href="cart.php">
                    <img src="add_to_cart_icon.png" alt="Add to Cart" width="30" height="30">
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

        $carouselImageUrls = [
            'image1.jpg',
            'image2.png',
            'image3.jpeg',
        ];

        createCarousel($carouselImageUrls);
        ?>
    </div>



    <div class="product-category">
        <h2>Paste & Others</h2>
        <div class="product-container">
            <!-- Your existing product cards go here -->
        </div>
    </div>

    <footer class="fixed-footer">
        <p>&copy; <?php echo date("Y"); ?> Your Website. All rights reserved.</p>
    </footer>

</body>

</html>
