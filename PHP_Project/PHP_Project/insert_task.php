<?php
include 'olddbconfig.php';


// $operation = $_GET["op"];

if (isset($_POST['add'])) {
    insert_note();
    echo "inserted.";// Fetch the task data based on the task ID
}


function insert_note() {
    //$task_name = $_POST['task_name'];
    //$task_description = $_POST['task_description'];
    global $connection;
    
    $task_name = $_POST["taskName"];
    $task_description = $_POST["taskDescription"];
    $task_status = $_POST["taskStatus"];
    
    $query = "INSERT INTO tasks (task_name, task_description, status) VALUES ('$task_name', '$task_description', '$task_status')";
    
    try {
        mysqli_query($connection, $query);
    } catch (Exception $e) {echo "Error<br/>";
    }
    //header('Location: index.php');
}


?>