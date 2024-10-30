<?php
include 'dbconfig.php';
global $conn;
if (isset($_POST['add'])) {
    include 'add_task.php';
} elseif (isset($_GET['edit'])) {
    include 'edit_task.php';
} elseif (isset($_GET['delete'])) {
    include 'delete_task.php';
} elseif (isset($_GET['complete'])) {
    include 'completed_tasks.php';
} else {
    echo "Invalid operation.";
}
header('location:index.php');
?>


