<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Example with Toast Notification</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

<!-- Button to add an item to the cart -->
<button class="btn btn-primary" onclick="addItemToCart({name: 'Sample Product'})">Add to Cart</button>

<!-- Toast Container -->
<div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px;">
    <!-- Position it -->
    <div style="position: absolute; top: 0; right: 0;">

        <!-- Toast -->
        <div class="toast" id="cartToast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
            <div class="toast-header">
                <strong class="mr-auto">Cart Update</strong>
                <small>Just now</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                Item added to your cart successfully.
            </div>
        </div>

    </div>
</div>

<!-- JavaScript -->
<!-- jQuery and Bootstrap JS for toast functionality -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-lS9F8PvCkHoN9e3U3f+cv2FmZaA/ZmVYY1Pk0adz3lpC2BRQ8cZKKaG28pF7fJ89" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>
function addItemToCart(item) {
    // Here, you would typically add the item to your cart (session storage, local storage, or database)
    
    // Update the toast message dynamically based on the item added
    $('#cartToast .toast-body').text(`${item.name} added to your cart successfully.`);
    
    // Show the toast notification
    $('#cartToast').toast('show');
}
</script>

</body>
</html>
