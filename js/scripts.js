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

    // Actions for tasks in history
    $(document).on('click', '.history-item', function () {
        //const taskId = $(this).data('id');

        updateHistory();
    });
	$('#historyFilterDropdown').on('change', function () {
		historyFilterItems(); // Call the filterItems function when the value changes
		}
	);		
	
});

// Support Functions
function historyFilterItems() {
    const selectedCategory = $('#historyFilterDropdown').val();
    const today = new Date();

    $('.history-item').each(function () {
        const itemDate = new Date($(this).data('date')); // Get the item's date
        let showItem = false;

        switch (selectedCategory) {
            case 'all':
                showItem = true;
                break;
            case 'today':
                // Check if the item's date is today
                showItem = isSameDay(today, itemDate);
                break;
            case 'last-week':
                // Check if the item's date is within the last 7 days
                const lastWeek = new Date(today);
                lastWeek.setDate(today.getDate() - 7);
                showItem = itemDate >= lastWeek && itemDate < today;
                break;
            case 'last-month':
                // Check if the item's date is within the last 30 days
                const lastMonth = new Date(today);
                lastMonth.setDate(today.getDate() - 30);
                showItem = itemDate >= lastMonth && itemDate < today;
                break;
        }

        if (showItem) {
            $(this).addClass('active');
        } else {
            $(this).removeClass('active');
        }
    });
}
// Helper function to check if two dates are the same day
function isSameDay(date1, date2) {
    return (
        date1.getFullYear() === date2.getFullYear() &&
        date1.getMonth() === date2.getMonth() &&
        date1.getDate() === date2.getDate()
    );
}
// Update Cart
function updateHistory() {
    const historyItemsContainer = $('.history-grid');
    //historyItemsContainer.empty();

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

if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/service-worker.js')
        .then((registration) => {
            console.log('Service Worker registered with scope:', registration.scope);
        })
        .catch((error) => {
            console.error('Service Worker registration failed:', error);
        });
}



let reminders = [];

/**
 * Add a reminder for a task.
 * @param {string} taskName - Name of the task.
 * @param {Date} dueDate - The due date and time of the task.
 */
function setReminder(taskName, dueDate) {
    reminders.push({ taskName, dueDate });
}

/**
 * Check reminders on page load.
 * This function scans for tasks in the reminder window (15 minutes before dueDate to dueDate).
 */
function checkReminders() {
    const now = new Date();

    reminders.forEach((reminder) => {
        const { taskName, dueDate } = reminder;

        // Calculate the reminder window
        const startReminderTime = new Date(dueDate.getTime() - 15 * 60000); // 15 minutes before dueDate
        const endReminderTime = dueDate;

        console.log(`Task: "${taskName}", Start Reminder: ${startReminderTime}, Due Date: ${endReminderTime}, Current Time: ${now}`);

        // Check if the current time is within the reminder window
        if (now >= startReminderTime && now < endReminderTime) {
            console.log(`Showing reminder for task: "${taskName}"`);
            createPopup(taskName);

            // Remove the task from the reminders list after showing the popup
            reminders = reminders.filter((r) => r.taskName !== taskName);
        } else if (now >= endReminderTime) {
            // Task is overdue
            console.log(`Task "${taskName}" is already overdue.`);
            reminders = reminders.filter((r) => r.taskName !== taskName);
        }
    });
}

/**
 * Create and display a popup reminder.
 * @param {string} taskName - Name of the task.
 */
function createPopup(taskName) {
    // Create the popup element
    const popup = document.createElement('div');
    popup.className = 'reminder-popup';
    popup.innerHTML = `
        <p>Reminder: Your task "${taskName}" is due soon!</p>
        <button onclick="this.parentElement.remove()">Close</button>
    `;

    // Append the popup to the body
    document.body.appendChild(popup);

    // Make the popup draggable
    makeDraggable(popup);
}

/**
 * Make a DOM element draggable.
 * @param {HTMLElement} element - The element to make draggable.
 */
function makeDraggable(element) {
    let mouseX = 0, mouseY = 0;
    let currentX = 0, currentY = 0;

    let isDragging = false;

    element.onmousedown = (e) => {
        e.preventDefault();

        isDragging = true;

        // Store the mouse cursor's initial position
        mouseX = e.clientX;
        mouseY = e.clientY;

        document.onmousemove = (e) => {
            if (!isDragging) return;

            // Calculate the new position
            const deltaX = e.clientX - mouseX;
            const deltaY = e.clientY - mouseY;

            currentX += deltaX;
            currentY += deltaY;

            // Apply the new position using transform
            element.style.transform = `translate(${currentX}px, ${currentY}px)`;

            // Update mouse position
            mouseX = e.clientX;
            mouseY = e.clientY;
        };

        document.onmouseup = () => {
            isDragging = false;
            document.onmousemove = null;
            document.onmouseup = null;
        };
    };
}


document.addEventListener("DOMContentLoaded", () => {
    console.log("Page loaded. Checking reminders...");
    checkReminders();
});
