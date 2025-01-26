<?php
include 'olddbconfig.php';
global $conn;

if (isset($_GET['id'])) {
    $task_id = (int) $_GET['id'];
    
    // Update task to set status as completed and record the completion timestamp
    $query = "UPDATE tasks SET status = 'completed', completed_at = NOW() WHERE id = $task_id";
    
    if (mysqli_query($conn, $query)) {
        // Redirect back to index.php after completing the task
        header("Location: index.php");
        exit();
    } else {
        echo "Error marking task as completed: " . mysqli_error($conn);
    }
} else {
    echo "No task ID specified.";
}
?>
