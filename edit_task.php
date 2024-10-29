<?php
include 'dbconfig.php';

if (isset($_GET['id'])) {     
    $task_id = $_GET['id'];     // Fetch the task data based on the task ID
}
$query = "SELECT * FROM tasks WHERE id = $task_id";     
$result = mysqli_query($connection, $query);     
if ($result && mysqli_num_rows($result) > 0) {         
    $task = mysqli_fetch_assoc($result);
}
?>

<form action="../operationData.php" method="POST">
<label name="id"></label><br>

<label for="taskName">Task Name:</label><br>
<input type="text" id="taskName" name="taskName" value="<?php echo htmlspecialchars($task_name); ?>"><br><br>

<label for="taskDescription">Task Description:</label><br>
<input type="text" id="taskDescription" name="taskDescription" value="<?php echo htmlspecialchars($task_description); ?>"><br><br>

<label for="selTaskStatus">Task Status:</label><br>
<select id="selTaskStatus" name="taskStatus">
<option value="">Select an Option</option>
<option value="0">Pending</option>
<option value="1">Done</option>
</select>
<input type="submit" name="edit" value="edit">
</form>

<?php
// $task_id = $_GET['id'];

edit_task($task_id);

function edit_task($task_id) {
    global $connection;
    $task_name = $_POST["task_name"];
    $task_description = $_POST["task_description"];
    $task_status = $_POST["status"];
    $query = "UPDATE tasks SET task_name = '$task_name', task_description = '$task_description', status = '$task_status' WHERE id = $task_id";
    mysqli_query($connection, $query);
}
