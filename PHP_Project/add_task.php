<?php
session_start();
include 'olddbconfig.php';
global $conn;
    $task_name =  $_POST["taskName"];
    $task_description = $_POST["taskDescription"] ?? '';
    $task_status = 'pending';//$_POST["taskStatus"];
    $due_date = $_POST["dueDate"];
    $due_date = str_replace('T', ' ', $due_date);
    $username = $_SESSION["USERNAME"];
    $query = "INSERT INTO tasks (task_name, task_description, status, due_date, username)
          VALUES ('$task_name', '$task_description', '$task_status', '$due_date', '$username')";
    
    if (mysqli_query($conn, $query)) {
        echo "Task inserted successfully.";
    } else {
        echo "Error inserting task: " . mysqli_error($conn);
    }

?>


