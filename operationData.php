<?php
include 'dbconfig.php';

// $operation = $_GET["op"];


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

insert_task();



function insert_task() {
    //$task_name = $_POST['task_name'];
    //$task_description = $_POST['task_description'];
    global $conn;
    
    $task_name = $_POST["taskName"];
    $task_description = $_POST["taskDescription"];
    $task_status = $_POST["taskStatus"];
    
    
    $query = "INSERT INTO tasks (task_name, task_description) VALUES ('$task_name', '$task_description')";
    mysqli_query($conn, $query);
    
    //header('Location: index.php');
}


?>