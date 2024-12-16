<?php
include '../dbconfig.php';
global $conn;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do Website</title>
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel = "stylesheet" href="../styles/calendar.css">
</head>
<body>
	<?php include_once 'heading.php';?>
	
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
                <form action="../operationData.php" method="post">
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
                include 'pending_tasks.php';
                ?>
            </div>
            <hr>
            <br/>
            <h2>Your History</h2>
            <div class="history-grid">
                <?php
                    include 'completed_tasks.php';
                ?>
            </div>
        </div>
    </div>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/scripts.js"></script>
</body>
</html>
