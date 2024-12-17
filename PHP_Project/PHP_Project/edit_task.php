<?php
include 'olddbconfig.php';
global $conn;

if (isset($_GET['id'])) {
    // Fetch the task details for editing
    $task_id = (int) $_GET['id'];
    $query = "SELECT * FROM tasks WHERE id = $task_id";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $task = mysqli_fetch_assoc($result);
    } else {
        echo "Task not found.";
        exit();
    }
}

if (isset($_POST["task_name"]) && isset($_GET['id'])) {
    // Update the task in the database
    $task_id = (int) $_GET['id'];
    $task_name = mysqli_real_escape_string($conn, $_POST["task_name"]);
    $task_description = mysqli_real_escape_string($conn, $_POST["task_description"] ?? '');
    $task_status = mysqli_real_escape_string($conn, $_POST["status"] ?? 'pending');
    
    $query = "UPDATE tasks SET task_name = '$task_name', task_description = '$task_description', status = '$task_status' WHERE id = $task_id";
    
    if (mysqli_query($conn, $query)) {
        echo "Task updated successfully.";
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating task: " . mysqli_error($conn);
    }
}
?>

<!-- Edit Task Form -->
<form action="edit_task.php?id=<?php echo $task_id; ?>" method="post">
    <input type="text" name="task_name" placeholder="Task Name" value="<?php echo htmlspecialchars($task['task_name']); ?>" required>
    <input type="text" name="task_description" placeholder="Task Description" value="<?php echo htmlspecialchars($task['task_description']); ?>">
    <select name="status">
        <option value="pending" <?php if ($task['status'] === 'pending') echo 'selected'; ?>>Pending</option>
        <option value="completed" <?php if ($task['status'] === 'completed') echo 'selected'; ?>>Completed</option>
    </select>
    <button type="submit">Save Changes</button>
</form>
