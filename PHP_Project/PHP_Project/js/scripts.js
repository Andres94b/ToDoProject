// Event handlers
$(document).ready(function () {
    let history = [];
    let totalPrice = 0;
	let taskGrid = [];

    // Add tasks
	$('#add-task').click(function(){
		window.open("task_popup.html","","width=600,height=250,left=400,top=200");
	});
	
	$("#list-tasks").click(function(){
		
	});
	
    // Add to History functionality for the entire product box
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

		
        // Update history UI
        updateHistory();
    });

	$("#popup").on("click", btnAddNote_onclick);
	
    // Remove item from cart when clicked
    $(document).on('click', '.history-item', function () {
        const taskId = $(this).data('id');

        // Remove product from cart
        history = history.filter(item => item.id !== taskId);

        // Update cart UI
        updateHistory();
    });

    // Checkout button
    $('#checkout-button').click(function () {
        alert('Proceeding to checkout. Total: $' + totalPrice.toFixed(2));
        history = [];  // Clear the cart
        updateHistory();  // Update UI
    });
});

// Support Functions
function btnAddNote_onclick() {
    window.open("pop_up.php", "", "width=600,height=250,left=400,top=200");
}
// Update History
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

function displayTasks(){
	
}

function receiveTaskData(task, save) {
			if (save) {
			    saveToStorage(task, function () {
					console.log("saved succesfully");
			    });
			}
		}

function openModal(date) {
    document.getElementById('note_date').value = date; // Set the date in the hidden input
    document.getElementById('addNoteModal').style.display = 'block'; // Show the modal
}

// Close the modal when the user clicks outside of it
window.onclick = function(event) {
    const modal = document.getElementById('addNoteModal');
    if (event.target === modal) {
        modal.style.display = "none";
    }
}

// Close the modal when the close button is clicked
document.querySelector('.close').onclick = function() {
    document.getElementById('addNoteModal').style.display = 'none';
};

function myFunction() {
	alert ("My function to debug.")
	var popup = document.getElementById("myPopup");
    popup.classList.toggle("show");
}
