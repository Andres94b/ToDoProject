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
</head>
<body>

    <!-- Navigation Bar -->
    <div class="navbar">
        <div class="logo">
            <img src="logo.png" alt="Logo">
            <h1>Website Name</h1>
        </div>
        <ul class="nav-links">
            <li><a href="#">Home</a></li>
            <li><a href="#">Calendar</a></li>
            <li><a href="#">Login</a></li>
        </ul>
    </div>

    <div class="container">

        <!-- Task Section -->
        <div class="task-section">
            <h1>Task</h1>

            <!-- Buttons for Adding and Listing Tasks -->
            <ul class="task-buttons">
                <li><button onclick="document.getElementById('addTaskForm').style.display='block'">Add Task</button></li>
                <li><a href="index.php">List Tasks</a></li>
            </ul>

            <!-- Add Task Form (Initially Hidden) -->
            <div id="addTaskForm" style="display: none;">
                <form action="add_task.php" method="post">
                    <input type="hidden" name="add" value="1">
                    <input type="text" name="taskName" placeholder="Task Name" required>
                    <input type="text" name="taskDescription" placeholder="Description">
                    <select name="taskStatus">
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                    </select>
                    <button type="submit">Add Task</button>
                </form>
            </div>

            <!-- Display Tasks -->
            <div class="task-grid">
                <?php
                // Fetch pending tasks from the database
                $query = "SELECT * FROM tasks WHERE status='pending'";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='task' data-id='{$row['id']}'>
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
        </div>

        <!-- Completed Tasks Sidebar -->
        <div class="history-section">
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

    <script src="scripts.js"></script>
</body>
</html>
