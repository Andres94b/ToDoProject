<?php
session_start();
include 'olddbconfig.php';
global $conn;
    $task_name =  $_POST["taskName"];
    $task_description = $_POST["taskDescription"] ?? '';
    $task_status = $_POST["taskStatus"];
    $username = $_SESSION["USERNAME"];
    
    $query = "INSERT INTO tasks (task_name, task_description, status, username) VALUES ('$task_name', '$task_description', '$task_status','$username')";
    
    if (mysqli_query($conn, $query)) {
        echo "Task inserted successfully.";
    } else {
        echo "Error inserting task: " . mysqli_error($conn);
    }

?>


