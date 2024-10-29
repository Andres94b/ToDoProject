<?php
include 'dbconfig.php';


// $operation = $_GET["op"];
if (isset($_GET['edit'])) {
    $task_id = $_GET['id'];
    edit_task($task_id);     // Fetch the task data based on the task ID
}

if (isset($_GET['add'])) {
    insert_task();     // Fetch the task data based on the task ID
}

// switch ($operation) {
//     case "add_task":
//         insert_task();
//         echo "inserting...!";
//     break;
//     case "update_task":
//         echo "updating...!";
//         break;
//     case "delete_task":
//         echo "updating...!";
//         break;
//     default:
//         echo "wrong option.";
//     break;
// }

// insert_task();

function insert_task() {
    //$task_name = $_POST['task_name'];
    //$task_description = $_POST['task_description'];
    global $connection;
    
    $task_name = $_POST["taskName"];
    $task_description = $_POST["taskDescription"];
    $task_status = $_POST["taskStatus"];
    
    $query = "INSERT INTO tasks (task_name, task_description) VALUES ('$task_name', '$task_description')";
    mysqli_query($connection, $query);
    
    //header('Location: index.php');
}

function edit_task($task_id) {
    global $connection;
    $task_name = $_POST["task_name"];
    $task_description = $_POST["task_description"];
    $task_status = $_POST["status"];
    $query = "UPDATE tasks SET task_name = '$task_name', task_description = '$task_description', status = '$task_status' WHERE id = $task_id";
    mysqli_query($connection, $query);
}

?>
