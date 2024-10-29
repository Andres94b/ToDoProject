<?php
include 'dbconfig.php';


$query = "SELECT * FROM tasks WHERE status='completed'";
$result = mysqli_query($conn, $query);

while($row = mysqli_fetch_assoc($result)) {
    echo "<div class='task completed'>
            <span>{$row['task_name']} - Completed at: {$row['completed_at']}</span>
          </div>";
}
?>
