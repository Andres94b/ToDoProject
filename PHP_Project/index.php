<?php
include 'dbconfig.php';
global $conn;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do Website</title>
    <link rel="stylesheet" href="styles.css">
    <link rel = "stylesheet" href="calendar.css">
</head>
<body>

    <!-- Navigation Bar -->
    <div class="navbar">
        <div class="logo">
            <img src="Logo.png" alt="Logo">
            <h1>NOT-IT</h1>
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
        </ul>
    </div>
    <br/>
	
    <div class="container">
    	
            
        <!-- Task Section -->
        <div class="task-section">
        <!-- Buttons for Adding and Listing Tasks -->
            <ul class="task-buttons">
                <li><button id = "button-add" onclick="document.getElementById('addTaskForm').style.display='block'">Add Task</button></li>
            </ul>
				
            
			<br/>
            <!-- Add Task Form (Initially Hidden) -->
            <div id="addTaskForm" style="display: none;">
                <form action="operationData.php" method="post">
                    <input type="hidden" name="add" value="1">
                    <input type="text" name="taskName" placeholder="Task Name" required>
                    <input type="text" name="taskDescription" placeholder="Description">
                    <select name="taskStatus">
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                    </select>
                    <button id="submit_button" name="add" type="submit">Add Task</button>
                </form>
            </div>
			<br/>
           
            <div>
            <?php 
            include 'calendar.php';
            ?>
            </div>
        </div>

        <!--  Sidebar -->
         
        
        <div class="history-section">
        <!-- Display Tasks -->
        	<h2>Your Tasks</h2>
            <div class="history-grid">
            
                <?php
                // Fetch pending tasks from the database
                $query = "SELECT * FROM tasks WHERE status='pending'";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='history-item' data-id='{$row['id']}'>
                            <h2>{$row['task_name']}</h2>
                            <p>{$row['task_description']}</p>
                            <div class='task-actions'>
                                <a href='edit_task.php?id={$row['id']}'>Edit</a> |
                                <a href='delete_task.php?id={$row['id']}'>Delete</a> |
                                <a href='completed_tasks.php?id={$row['id']}'>Complete</a>
                            </div>
                          </div>";
                }
                ?>
            </div>
            <hr>
            <br/>
            <h2>Your History</h2>
            <div class="history-grid">
                <?php
                // Fetch completed tasks from the database
                $query_completed = "SELECT * FROM tasks WHERE status='completed'";
                $result_completed = mysqli_query($conn, $query_completed);

                while ($row_completed = mysqli_fetch_assoc($result_completed)) {
                    echo "<div class='history-item'>
                            <span>{$row_completed['task_name']} - Completed at: {$row_completed['completed_at']}</span>
                          </div>";
                }
                ?>
            </div>
        </div>
    </div>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="scripts.js"></script>
</body>
</html>
