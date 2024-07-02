<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
        <link rel="stylesheet" href="payment.css">
        <link rel="stylesheet" href="home.css">


</head>

<body>

    <header>
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="Home.php">Sharifah Ready to Eat</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="Home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="cart.php">Cart</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="container">
        <h2>Payment Options</h2>
        <form action="process_payment.php" method="post">
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Bank Transfer" name="payment_method[]"
                        id="bankTransfer">
                    <label class="form-check-label" for="bankTransfer">
                        Bank Transfer - 1234567 Public Bank
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Visa/Credit Card" name="payment_method[]"
                        id="creditCard">
                    <label class="form-check-label" for="creditCard">
                        Visa/Credit Card
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="TNG" name="payment_method[]" id="tng">
                    <label class="form-check-label" for="tng">
                        TNG - 012-3456789
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Proceed to Payment</button>
        </form>
    </div>

    <!-- Footer -->
    <footer class="fixed-footer">
        <p>&copy; <?php echo date("Y"); ?> Your Website. All rights reserved.</p>
    </footer>

</body>

</html>
