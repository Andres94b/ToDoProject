<?php
include 'dbconfig.php';
global $conn;

if (isset($_POST["taskName"])) {
    $task_name = mysqli_real_escape_string($conn, $_POST["taskName"]);
    $task_description = mysqli_real_escape_string($conn, $_POST["taskDescription"] ?? '');
    $task_status = mysqli_real_escape_string($conn, $_POST["taskStatus"] ?? 'pending');
    
    $query = "INSERT INTO tasks (task_name, task_description, status) VALUES ('$task_name', '$task_description', '$task_status')";
    
    if (mysqli_query($conn, $query)) {
        echo "Task inserted successfully.";
    } else {
        echo "Error inserting task: " . mysqli_error($conn);
    }
}
?>

<form action="operationData.php" method="post">
    <input type="hidden" name="add" value="1">
    <input type="text" name="taskName" placeholder="Task Name" required>
    <input type="text" name="taskDescription" placeholder="Task Description">
    <select name="taskStatus">
        <option value="pending">Pending</option>
        <option value="completed">Completed</option>
    </select>
    <button type="submit">Add Task</button>
</form>
