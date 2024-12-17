<?php
include 'olddbconfig.php';

// Check if the "add" operation is requested
if (isset($_POST['add'])) {
    insert_task();
    echo "Task inserted successfully.";
}

function insert_task() {
    global $connection; // Ensure the database connection is used
    
    // Retrieve form data
    $task_name = $_POST["taskName"];
    $task_description = $_POST["taskDescription"] ?? '';
    $task_status = $_POST["taskStatus"];
    $due_date = $_POST["dueDate"];
    
    // Insert query with due_date
    $query = "INSERT INTO tasks (task_name, task_description, status, due_date)
              VALUES ('$task_name', '$task_description', '$task_status', '$due_date')";
    
    try {
        // Execute the query
        if (mysqli_query($connection, $query)) {
            echo "Task added successfully.";
        } else {
            echo "Error inserting task: " . mysqli_error($connection);
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
