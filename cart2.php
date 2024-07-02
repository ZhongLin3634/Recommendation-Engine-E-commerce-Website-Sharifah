<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="cart.css">

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkboxes = document.querySelectorAll('input[name="selectedProducts[]"]');
            const quantityInputs = document.querySelectorAll('input[name^="quantity"]');
            const colorSelects = document.querySelectorAll('select[name^="color"]');
            const totalPriceDisplay = document.querySelector('.total-price');

            checkboxes.forEach(function (checkbox) {
                checkbox.addEventListener('change', updateTotalPrice);
            });

            quantityInputs.forEach(function (input) {
                input.addEventListener('input', updateTotalPrice);
            });

            colorSelects.forEach(function (select) {
                select.addEventListener('change', updateTotalPrice);
            });

            function updateTotalPrice() {
                let totalPrice = 0;

                checkboxes.forEach(function (checkbox, index) {
                    if (checkbox.checked) {
                        const quantity = parseInt(quantityInputs[index].value);
                        const price = parseFloat(checkbox.dataset.price);
                        totalPrice += quantity * price;
                    }
                });

                totalPriceDisplay.textContent = 'Total Price: RM' + totalPrice.toFixed(2);
            }
        });
    </script>
</head>

<body>

    <header>
        <!-- Navigation Bar -->
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
                </ul>
            </div>
            <div>
                <a class="navbar-brand" href="cart.php">
                <img src="cart.png" alt="Add to Cart" width="30" height="30">
                </a>
            </div>
        </nav>
    </header>

    <!-- Display Selected Products -->
    <form action="payment.php" method="post">
        <!-- Product 1 -->
        <div class="product-item">
            <img class="product-image" src="image1.jpg" alt="Product 1">
            <div class="product-details">
                <div class="product-info">
                    <p class="product-name">Product 1</p>
                    <p class="product-price">Price: RM10.00</p>
                </div>
                <div class="quantity-section">
                    <label class="quantity-label" for="quantity1">Quantity:</label>
                    <input type="number" id="quantity1" name="quantity1" class="quantity-input" value="1" min="1"
                        data-price="10.00">
                </div>
                <div class="color-section">
                    <label class="color-label" for="color1">Color:</label>
                    <select id="color1" name="color1">
                        <option value="black">Black</option>
                        <option value="white">White</option>
                        <!-- Add more color options as needed -->
                    </select>
                </div>
                <div class="select-section">
                    <input type="checkbox" id="product1" name="selectedProducts[]" value="product1" data-price="10.00">
                    <label class="select-pay-label" for="product1">Select to Pay</label>
                </div>
            </div>
        </div>

        <!-- Product 2 -->
        <div class="product-item">
            <img class="product-image" src="image2.png" alt="Product 2">
            <div class="product-details">
                <div class="product-info">
                    <p class="product-name">Product 2</p>
                    <p class="product-price">Price: RM15.00</p>
                </div>
                <div class="quantity-section">
                    <label class="quantity-label" for="quantity2">Quantity:</label>
                    <input type="number" id="quantity2" name="quantity2" class="quantity-input" value="1" min="1"
                        data-price="15.00">
                </div>
                <div class="color-section">
                    <label class="color-label" for="color2">Color:</label>
                    <select id="color2" name="color2">
                        <option value="black">Black</option>
                        <option value="white">White</option>
                        <!-- Add more color options as needed -->
                    </select>
                </div>
                <div class="select-section">
                    <input type="checkbox" id="product2" name="selectedProducts[]" value="product2" data-price="15.00">
                    <label class="select-pay-label" for="product2">Select to Pay</label>
                </div>
            </div>
        </div>

        <!-- Product 3 -->
        <div class="product-item">
            <img class="product-image" src="image3.jpeg" alt="Product 3">
            <div class="product-details">
                <div class="product-info">
                    <p class="product-name">Product 3</p>
                    <p class="product-price">Price: RM20.00</p>
                </div>
                <div class="quantity-section">
                    <label class="quantity-label" for="quantity3">Quantity:</label>
                    <input type="number" id="quantity3" name="quantity3" class="quantity-input" value="1" min="1"
                        data-price="20.00">
                </div>
                <div class="color-section">
                    <label class="color-label" for="color3">Color:</label>
                    <select id="color3" name="color3">
                        <option value="black">Black</option>
                        <option value="white">White</option>
                        <!-- Add more color options as needed -->
                    </select>
                </div>
                <div class="select-section">
                    <input type="checkbox" id="product3" name="selectedProducts[]" value="product3" data-price="20.00">
                    <label class="select-pay-label" for="product3">Select to Pay</label>
                </div>
            </div>
        </div>

        <!-- Add more products as needed -->

        <!-- Calculate Total Price -->
        <p class="total-price">Total Price: RM0.00</p>

        <!-- Pay Button -->
        <button type="submit">Pay Now</button>
    </form>

    <!-- Footer -->
    <footer class="fixed-footer">
        <p>&copy; <?php echo date("Y"); ?> Your Website. All rights reserved.</p>
    </footer>

</body>

</html>
