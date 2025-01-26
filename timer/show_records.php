<?php
include_once '../dbconfig.php'; // Database connection
session_start(); // Start session if necessary

// Check if a task_id is provided in the URL
if (!isset($_GET['task_id']) || !is_numeric($_GET['task_id'])) {
    echo "Please provide a valid task_id.";
    exit;
}

$taskId = intval($_GET['task_id']); // Convert to integer for security

try {
    // Connect to the database
    $connection = new PDO("mysql:host=$host;dbname=$dbname;", $user, $pass);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Query to get all records from the `task_time` table for the specified task_id
    $sqlStmt = "SELECT * FROM task_time WHERE task_id = :task_id";
    $prepare = $connection->prepare($sqlStmt);
    $prepare->bindValue(":task_id", $taskId, PDO::PARAM_INT);
    $prepare->execute();
    
    // Fetch all records
    $records = $prepare->fetchAll(PDO::FETCH_ASSOC);
    
    // Check if there are records
    ?>
    <html>
    <head>
        <title>Records for Task ID: <?php echo $taskId; ?></title>
        <style>
            /* CSS Styles */
            body {
                font-family: Arial, sans-serif;
                margin: 20px;
                background-color: #f9f9f9;
            }

            h1 {
                color: #333;
            }

            .record-table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            .record-table th, .record-table td {
                padding: 10px;
                text-align: left;
                border: 1px solid #ddd;
            }

            .record-table th {
                background-color: #007BFF;
                color: white;
            }

            .record-table tr:nth-child(even) {
                background-color: #f2f2f2;
            }

            .button {
                display: inline-block;
                padding: 10px 15px;
                background-color: #28a745; /* Green color */
                color: white;
                text-decoration: none;
                border-radius: 5px;
                margin-top: 20px;
            }

            .button:hover {
                background-color: #218838; /* Darker green on hover */
            }

            .back-button {
                background-color: #007BFF; /* Blue color */
                margin-top: 20px;
            }

            .back-button:hover {
                background-color: #0056b3; /* Darker blue on hover */
            }
        </style>
    </head>
    <body>
    <?php
    
    if (count($records) > 0) {
        // Initialize total time
        $totalTime = 0;
        
        echo "<h1>Time Records for Task ID: $taskId</h1>";
        echo "<table class='record-table'>
            <tr>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Total Time (seconds)</th>
            </tr>";
        
        // Display each record
        foreach ($records as $record) {
            echo "<tr>
                <td>{$record['start_time']}</td>
                <td>{$record['end_time']}</td>
                <td>{$record['total_time']}</td>
              </tr>";
            
            // Add to the total time
            $totalTime += $record['total_time'];
        }
        
        echo "</table>";
        // Display the total time
        echo "<h2>Total Time: {$totalTime} seconds</h2>";
    } else {
        echo "<p>No records found for Task ID: $taskId.</p>";
    }
    ?>
    
<div style="margin-top: 20px;">
    <a href="../home/home_page.php" class="button back-button">Back to Home</a>
</div>

</body>
</html>
    <?php
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close the connection
$connection = null;
?>