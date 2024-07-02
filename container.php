<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Containers</title>
    <link rel="stylesheet" href="container.css">


    <!--<style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        section {
            display: flex;
            justify-content: space-around;
            padding: 20px;
        }

        .container {
            text-align: center;
            width: 550px; /* Adjust the width as needed */
            border: 1px solid #ddd; /* Light gray border */
            box-sizing: border-box;
            padding: 15px;
            height: 400px; /* Set a fixed height for the container */
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #fff;
            transition: box-shadow 0.3s ease; /* Add box shadow transition effect */
        }

        .container:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add shadow on hover */
        }

        .container img {
            max-width: 100%;
            max-height: 70%; /* Ensure the image does not exceed 70% of the container's height */
            object-fit: cover; /* Maintain aspect ratio while covering the container */
            margin-bottom: 15px;
            border-bottom: 1px solid #ddd; /* Add a border between image and text */
        }

        .product-name {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .add-to-cart {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease; /* Add background color transition effect */
        }

        .add-to-cart:hover {
            background-color: #45a049; /* Darker green on hover */
        }
    </style>-->
</head>
<body>

    <section>
        <div class="container">
            <img src="image1.jpg" alt="Product 1">
            <p class="product-name">Product 1</p>
            <p class="product-price">RM10.00</p>
            <button class="add-to-cart">Add to Cart</button>
        </div>
        <div class="container">
            <img src="image2.png" alt="Product 2">
            <p class="product-name">Product 2</p>
            <p class="product-price">RM20.00</p>
            <button class="add-to-cart">Add to Cart</button>
        </div>
        <div class="container">
            <img src="image3.jpeg" alt="Product 3">
            <p class="product-name">Product 3</p>
            <p class="product-price">RM25.00</p>
            <button class="add-to-cart">Add to Cart</button>
        </div>
        <div class="container">
            <img src="image4.jpg" alt="Product 4">
            <p class="product-name">Product 4</p>
            <p class="product-price">RM30.00</p>
            <button class="add-to-cart">Add to Cart</button>
        </div>
    </section>

</body>
</html>
