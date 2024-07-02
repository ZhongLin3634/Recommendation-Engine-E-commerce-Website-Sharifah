<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="home3.css">

    <link rel="stylesheet" href="res.css">


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


</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Sharifah Ready to Eat</a>
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


<!--Using res.css-->
<div class="container2">
         <div class="card__container">
            <article class="card__article">
               <img src="image1.jpg" alt="image" class="card__img">

               <div class="card__data">
                  <span class="card__description">Vancouver Mountains, Canada</span>
                  <h2 class="card__title">The Great Path</h2>
                  <a href="#" class="card__button">Read More</a>
               </div>
            </article>

            <article class="card__article">
               <img src="image2.png" alt="image" class="card__img">

               <div class="card__data">
                  <span class="card__description">Poon Hill, Nepal</span>
                  <h2 class="card__title">Starry Night</h2>
                  <a href="#" class="card__button">Read More</a>
               </div>
            </article>

            <article class="card__article">
               <img src="image3.jpeg" alt="image" class="card__img">

               <div class="card__data">
                  <span class="card__description">Bojcin Forest, Serbia</span>
                  <h2 class="card__title">Path Of Peace</h2>
                  <a href="#" class="card__button">Read More</a>
               </div>
            </article>
            <article class="card__article">
               <img src="image4.png" alt="image" class="card__img">

               <div class="card__data">
                  <span class="card__description">Bojcin Forest, Serbia</span>
                  <h2 class="card__title">Path Of Peace</h2>
                  <a href="#" class="card__button">Read More</a>
               </div>
            </article>
            <article class="card__article">
               <img src="image1.jpg" alt="image" class="card__img">

               <div class="card__data">
                  <span class="card__description">Vancouver Mountains, Canada</span>
                  <h2 class="card__title">The Great Path</h2>
                  <a href="#" class="card__button">Read More</a>
               </div>
            </article>
            <article class="card__article">
               <img src="image3.jpeg" alt="image" class="card__img">

               <div class="card__data">
                  <span class="card__description">Bojcin Forest, Serbia</span>
                  <h2 class="card__title">Path Of Peace</h2>
                  <a href="#" class="card__button">Read More</a>
               </div>
            </article>
         </div>
      </div>






    <footer class="fixed-footer">
        <p>&copy; <?php echo date("Y"); ?> Your Website. All rights reserved.</p>
    </footer>

</body>

</html>
