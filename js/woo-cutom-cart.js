document.addEventListener('DOMContentLoaded', function() {
    var addToCartButtons = document.querySelectorAll('.add-to-cart-btn');

    addToCartButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            var productId = button.getAttribute('data-product-id');
            var quantity = parseInt(document.querySelector('.quantity-input').value, 10);
            addToCart(productId, quantity);
        });
    });

    function addToCart(productId, quantity) {
        jQuery.ajax({
            type: 'POST',
            url: wc_add_to_cart_params.ajax_url,
            data: {
                action: 'add_to_cart',
                product_id: productId,
                quantity: quantity,
            },
            success: function (response) {
                // Handle the response (e.g., show a success message)
                window.location.href = wc_add_to_cart_params.cart_url;
            },
        });
    }

    var quantityInput = document.querySelector('.quantity-input');
        var decreaseButton = document.querySelector('[data-action="decrease"]');
        var increaseButton = document.querySelector('[data-action="increase"]');

        decreaseButton.addEventListener('click', function (e) {
            e.preventDefault();
            var currentValue = parseInt(quantityInput.value, 10);
            quantityInput.value = currentValue > 1 ? currentValue - 1 : 1;
        });

        increaseButton.addEventListener('click', function (e) {
            e.preventDefault();
            var currentValue = parseInt(quantityInput.value, 10);
            quantityInput.value = currentValue + 1;
        });
  });