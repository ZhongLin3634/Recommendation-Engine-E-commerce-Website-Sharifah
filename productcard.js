$(document).ready(function () {
    // Function to create and append product cards
    function createProductCard(container, imageUrl, name, price) {
        const card = $(`
            <div class="card">
                <img src="${imageUrl}" alt="${name}">
                <div class="card-details">
                    <p class="product-name">${name}</p>
                    <p class="product-price">${price}</p>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
            </div>
        `);

        container.append(card);

        // Add animation class to each card for a smooth appearance
        card.addClass('animate__animated animate__fadeInUp');
    }

    // Sample product data
    const products = [
        { imageUrl: 'image1.jpg', name: 'Product 1', price: 'RM10.00' },
        { imageUrl: 'image2.png', name: 'Product 2', price: 'RM20.00' },
        { imageUrl: 'image3.jpeg', name: 'Product 3', price: 'RM25.00' },
        { imageUrl: 'image4.jpg', name: 'Product 4', price: 'RM30.00' },
    ];

    // Create and append product cards
    const productContainer = $('#productContainer');
    products.forEach(product => {
        createProductCard(productContainer, product.imageUrl, product.name, product.price);
    });
});
