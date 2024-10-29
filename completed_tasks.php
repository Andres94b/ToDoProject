<?php
include 'dbconfig.php';


$query = "SELECT * FROM tasks WHERE status='completed'";
$result = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($result)) {
    echo "<div class='history-item completed'>
            <span>{$row['task_name']} - Completed at: {$row['completed_at']}</span>
          </div>";
}
?>
