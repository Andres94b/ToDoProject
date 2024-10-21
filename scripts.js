$(document).ready(function () {
    let cart = [];
    let totalPrice = 0;

    // Add to Cart functionality for the entire product box
    $('.product').click(function () {
        const product = $(this);
        const productId = product.data('id');
        const productName = product.data('name');
        const productPrice = parseFloat(product.data('price'));

        // Check if the product is already in the cart
        const existingProduct = cart.find(item => item.id === productId);
        if (existingProduct) {
            existingProduct.quantity += 1;
        } else {
            cart.push({ id: productId, name: productName, price: productPrice, quantity: 1 });
        }

        // Update cart UI
        updateCart();
    });

    // Remove item from cart when clicked
    $(document).on('click', '.cart-item', function () {
        const productId = $(this).data('id');

        // Remove product from cart
        cart = cart.filter(item => item.id !== productId);

        // Update cart UI
        updateCart();
    });

    // Update Cart
    function updateCart() {
        const cartItemsContainer = $('.cart-grid');
        cartItemsContainer.empty();

        totalPrice = 0;
        cart.forEach(item => {
            totalPrice += item.price * item.quantity;

            const cartItemHtml = `
                <div class="cart-item" data-id="${item.id}">
                    <h3>${item.name}</h3>
                    <p>Quantity: ${item.quantity}</p>
                    <p>$${(item.price * item.quantity).toFixed(2)}</p>
                </div>
            `;
            cartItemsContainer.append(cartItemHtml);
        });

        $('#total-price').text(totalPrice.toFixed(2));
    }

    // Checkout button
    $('#checkout-button').click(function () {
        alert('Proceeding to checkout. Total: $' + totalPrice.toFixed(2));
        cart = [];  // Clear the cart
        updateCart();  // Update UI
    });
});
if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/service-worker.js')
        .then((registration) => {
            console.log('Service Worker registered with scope:', registration.scope);
        })
        .catch((error) => {
            console.error('Service Worker registration failed:', error);
        });
}
