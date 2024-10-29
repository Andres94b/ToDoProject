<?php
include 'dbconfig.php';
global $conn;

$query = "SELECT * FROM tasks WHERE status='pending'";
$result = mysqli_query($conn, $query);

while($row = mysqli_fetch_assoc($result)) {
    echo "<div class='task'>
            <span>{$row['task_name']}</span>
            <div>
                <a href='edit_task.php?id={$row['id']}'>Edit</a>
                <a href='complete_task.php?id={$row['id']}'>Complete</a>
                <a href='delete_task.php?id={$row['id']}'>Delete</a>
            </div>
          </div>";
}
?>
