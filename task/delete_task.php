<?php
include 'olddbconfig.php';
global $conn;

if (isset($_GET['id'])) {
    $task_id = (int) $_GET['id'];
    
    // Prepare the delete query
    $query = "DELETE FROM tasks WHERE id = $task_id";
    
    // Execute the query and check for success
    if (mysqli_query($conn, $query)) {
        // Redirect to index.php if deletion is successful
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting task: " . mysqli_error($conn);
    }
} else {
    echo "No task ID specified for deletion.";
}
?>
