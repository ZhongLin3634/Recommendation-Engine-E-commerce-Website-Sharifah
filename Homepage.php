<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="homepage.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>

<!-- Add this in the <head> section of your HTML file -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<!-- Add this before the closing </body> tag of your HTML file -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-lS9F8PvCkHoN9e3U3f+cv2FmZaA/ZmVYY1Pk0adz3lpC2BRQ8cZKKaG28pF7fJ89" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<body>
    <header class="fixed-header">
        <!-- Your header content goes here -->
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
    <div class="container">
        <!-- Your content goes here -->
        <h1>Here is the container</h1>
    </div>
        <section class="container big-section">
            <h2>Big Section</h2>
            <div class="carousel">
                <!-- Carousel Content -->
                <div>
                    <img src="image1.jpg" alt="Image 1">
                    <div class="carousel-text">Text for Image 1</div>
                </div>
                <div>
                    <img src="image2.png" alt="Image 2">
                    <div class="carousel-text">Text for Image 2</div>
                </div>
                <div>
                    <img src="image3.jpeg" alt="Image 3">
                    <div class="carousel-text">Text for Image 3</div>
                </div>
            </div>
        </section>
        function createCarousel($imageUrls) {
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

        <!-- Other Sections -->
        <section class="container other-section">
            <h2>Other Section 1</h2>
            <!-- Content for other sections goes here -->
        </section>

        <section class="container other-section">
            <h2>Other Section 2</h2>
            <!-- Content for other sections goes here -->
        </section>

        <!-- Add more sections as needed -->
        <div class="w3-container">
            <h2>London</h2>
            <p>London is the most populous city in the United Kingdom,
            with a metropolitan area of over 9 million inhabitants.</p>
        </div>

        <article class="w3-container">
            <h2>Paris</h2>
            <p>The Paris area is one of the largest population centers in Europe,
            with more than 2 million inhabitants.</p>
        </article>

        <section class="w3-container">
            <h2>Tokyo</h2>
            <p>Tokyo is the center of the Greater Tokyo Area,
            and the most populous metropolitan area in the world.</p>
        </section>
    </main>

    <footer class="fixed-footer">
        <!-- Your footer content goes here -->
        <p>&copy; 2024 My Website. All rights reserved.</p>
    </footer>

    <!-- Add this at the end of the body section -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.carousel').slick({
                dots: true,
                infinite: true,
                speed: 500,
                slidesToShow: 1,
                slidesToScroll: 1
            });
        });
    </script>
</body>
</html>
