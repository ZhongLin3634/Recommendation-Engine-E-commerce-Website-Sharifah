<div class="product-category">
    <h2>Paste & Others</h2>
    <div class="product-container">
        <div class="card">
            <img src="image1.jpg" alt="Product 1" class="card-img">
            <div class="card-details">
                <p class="product-name">Product 1</p>
                <p class="product-price">RM10.00</p>
                <div class="rating">
                    <!-- Add stars here based on the product's rating -->
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                </div>
                <button class="add-to-cart">Add to Cart</button>
            </div>
        </div>

        <div class="card">
            <img src="image2.png" alt="Product 2" class="card-img">
            <div class="card-details">
                <p class="product-name">Product 2</p>
                <p class="product-price">RM20.00</p>
                <div class="rating">
                    <!-- Add stars here based on the product's rating -->
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                </div>
                <button class="add-to-cart">Add to Cart</button>
            </div>
        </div>

        <div class="card">
            <img src="image3.jpeg" alt="Product 3" class="card-img">
            <div class="card-details">
                <p class="product-name">Product 3</p>
                <p class="product-price">RM25.00</p>
                <div class="rating">
                    <!-- Add stars here based on the product's rating -->
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                </div>
                <div class="button-container">
                    <button class="add-to-cart">Add to Cart</button>
                    <a href="product_details.php" class="view-details add-to-cart">View Details</a>
    </div>
            </div>
        </div>

        <div class="card">
            <img src="image4.png" alt="Product 4" class="card-img">
            <div class="card-details">
                <p class="product-name">Product 4</p>
                <p class="product-price">RM30.00</p>
                <div class="rating">
                    <!-- Add stars here based on the product's rating -->
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                </div>
                <button class="add-to-cart">Add to Cart</button>
            </div>
        </div>
    </div>
</div>


.product-category {
    text-align: center;
    margin-top: 20px;
    width:100%;

}

.product-container {
    display: flex;
    justify-content: space-around;
    align-items: center;
    flex-wrap: wrap;
    width: 100%;
    max-width:1200px;
    margin:0 auto;
}

.card {
    width: 200px;
    margin: 10px;
}

.card img {
    width: 100%;
    height: auto;
    object-fit: cover;
}

.card-details {
    text-align: center;
}

.product-name {
    font-weight: bold;
    margin-bottom: 10px;
}

.product-price {
    color: #555;
}

.rating {
    margin-bottom: 10px;
}

.star {
    color: #ffc107;
}

.button-container {
    display: flex;
    justify-content: space-between;
    margin-top: 10px;
}

.add-to-cart,
.view-details {
    background-color: #4CAF50;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.add-to-cart:hover,
.view-details:hover {
    background-color: #45a049;
}

@media (max-width: 768px) {
    .product-container {
        justify-content: center;
    }

    .card {
        width: 200px;
    }
}
