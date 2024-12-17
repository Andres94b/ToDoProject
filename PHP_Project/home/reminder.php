<script src="../js/scripts.js"></script>
<?php
include '../dbconfig.php';

// Create connection
$reminder_conn = new mysqli($host, $user, $pass, $dbname);
$username = $_SESSION["USERNAME"];
// Check connection
if ($reminder_conn->connect_error) {
    die("Connection failed: " . $reminder_conn->connect_error);
}

// Debug: Connection success
echo "<script>console.log('Reminder DB connection successful');</script>";

// Fetch tasks with dueDate for the logged-in user
$sql = "SELECT task_name, due_date
        FROM tasks
        WHERE username = '$username' AND status = 'pending'";
echo "Executing Query: <b>$sql</b><br>";
$result = $reminder_conn->query($sql);

// Debug: Query success or failure
if (!$result) {
    die("Error in query: " . $reminder_conn->error);
}
echo "Number of rows: <b>" . $result->num_rows . "</b><br>";
if ($result->num_rows > 0) {
    echo "<script>";
    while ($row = $result->fetch_assoc()) {
        $task_name = addslashes($row['task_name']); // Escape quotes
        $due_date = $row['due_date']; // Format: 'YYYY-MM-DD HH:MM:SS'
        
        // Debug: Task and due_date output
        echo "console.log('Task: $task_name, Due Date: $due_date');\n";
        
        // Convert to JavaScript-compatible format
        $due_date_js = str_replace(' ', 'T', $due_date);
        
        // Debug: Check formatted due_date
        echo "console.log('Formatted Due Date: $due_date_js');\n";
        
        // Pass to JavaScript function
        echo "setReminder('$task_name', new Date('$due_date_js'));\n";
    }
    echo "</script>";
} else {
    echo "<script>console.log('No pending tasks found for reminders.');</script>";
}

// Close the connection
$reminder_conn->close();
?>
