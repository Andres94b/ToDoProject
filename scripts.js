$(document).ready(function () {
    let history = [];
    let totalPrice = 0;

    // Add to Cart functionality for the entire product box
    $('.task').click(function () {
        const task = $(this);
        const taskId = task.data('id');
        const taskName = task.data('name');
        const taskPrice = parseFloat(task.data('price'));

        // Check if the product is already in the cart
        const existingTask = history.find(item => item.id === taskId);
        if (existingTask) {
            existingTask.quantity += 1;
        } else {
            history.push({ id: taskId, name: taskName, price: taskPrice, quantity: 1 });
        }

        // Update cart UI
        updateHistory();
    });

    // Remove item from cart when clicked
    $(document).on('click', '.history-item', function () {
        const taskId = $(this).data('id');

        // Remove product from cart
        history = history.filter(item => item.id !== taskId);

        // Update cart UI
        updateHistory();
    });

    // Update Cart
    function updateHistory() {
        const historyItemsContainer = $('.history-grid');
        historyItemsContainer.empty();

        totalPrice = 0;
        history.forEach(item => {
            totalPrice += item.price * item.quantity;

            const historyItemHtml = `
                <div class="history-item" data-id="${item.id}">
                    <h3>${item.name}</h3>
                    <p>Quantity: ${item.quantity}</p>
                    <p>$${(item.price * item.quantity).toFixed(2)}</p>
                </div>
            `;
            historyItemsContainer.append(historyItemHtml);
        });

        $('#total-price').text(totalPrice.toFixed(2));
    }

    // Checkout button
    $('#checkout-button').click(function () {
        alert('Proceeding to checkout. Total: $' + totalPrice.toFixed(2));
        history = [];  // Clear the cart
        updateHistory();  // Update UI
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
