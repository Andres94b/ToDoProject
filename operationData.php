<?php
include 'olddbconfig.php';
global $conn;
if (isset($_POST['add'])) {
    include 'task/add_task.php';
} elseif (isset($_GET['edit'])) {
    include 'task/edit_task.php';
} elseif (isset($_GET['delete'])) {
    include 'task/delete_task.php';
} elseif (isset($_GET['complete'])) {
    include 'task/completed_tasks.php';
} else {
    echo "Invalid operation.";
}
header('location:index.php');
?>


