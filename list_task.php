<?php
include 'dbconfig.php';
global $connection;

$query = "SELECT * FROM tasks WHERE status='pending'";
$result = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($result)) {
    echo "<div class='task'>
            <span>{$row['task_name']}</span><br/>
            <span>{$row['task_description']}</span><br/>
            <span>{$row['id']}</span>

            <div>
                <a href='../edit_task.php?id={$row['id']}'>Edit</a>
                <a href='complete_task.php?id={$row['id']}'>Complete</a>
                <a href='delete_task.php?id={$row['id']}'>Delete</a>
            </div>
          </div>";
}
?>
