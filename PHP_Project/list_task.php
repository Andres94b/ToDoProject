<?php
include 'dbconfig.php';
global $conn;

$query = "SELECT * FROM tasks WHERE status='pending'";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    echo "<div class='history-item'>
            <span>{$row['task_name']}</span><br/>
            <span>{$row['task_description']}</span><br/>
            <span>Task ID: {$row['id']}</span>
            
            <div class='task-actions'>
                <a href='operationData.php?edit={$row['id']}'>Edit</a> |
                <a href='operationData.php?complete={$row['id']}'>Complete</a> |
                <a href='operationData.php?delete={$row['id']}'>Delete</a>
            </div>
          </div>";
}
?>
