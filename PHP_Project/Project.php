<?php
include 'db.php';

add_task();
list_task();
completed_task();
save_task_time();
task_summary();
delete_note();
edit_note();


function add_task() {
    
    $task_name = $_POST['task_name'];
    $task_description = $_POST['task_description'];
    
    $query = "INSERT INTO tasks (task_name, task_description) VALUES ('$task_name', '$task_description')";
    mysqli_query($conn, $query);
    
    header('Location: index.php');
    
}

function list_task(){
    
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
}

function completed_task() {
    $query = "SELECT * FROM tasks WHERE status='completed'";
    $result = mysqli_query($conn, $query);
    
    while($row = mysqli_fetch_assoc($result)) {
        echo "<div class='task completed'>
            <span>{$row['task_name']} - Completed at: {$row['completed_at']}</span>
          </div>";
    }
    ;
}
function save_task_time(){
    $task_id = $_POST['task_id'];
    $total_time = $_POST['total_time'];
    
    $query = "INSERT INTO task_time (task_id, total_time) VALUES ('$task_id', '$total_time')";
    mysqli_query($conn, $query);
}

function task_summary(){
    
    $query = "SELECT SUM(total_time) AS total_time_spent FROM task_time";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $total_time_spent = $row['total_time_spent'];
    
    echo "Total time spent on tasks: " . gmdate("H:i:s", $total_time_spent);
    
}

function delete_note(){
    
    $note_id = $_POST['note_id'];
    
    $query = "DELETE FROM calendar_notes WHERE id='$note_id'";
    mysqli_query($conn, $query);
}

function edit_note(){
    $note_id = $_POST['note_id'];
    $note_text = $_POST['note_text'];
    
    $query = "UPDATE calendar_notes SET note_text='$note_text' WHERE id='$note_id'";
    mysqli_query($conn, $query);
}

function filter_completed_tasks(){
    $start = $_GET['start'];
    $end = $_GET['end'];
    
    $query = "SELECT * FROM tasks WHERE status='completed' AND completed_at BETWEEN '$start' AND '$end'";
    $result = mysqli_query($conn, $query);
    
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='task completed'>
            <span>{$row['task_name']} - Completed at: {$row['completed_at']}</span>
          </div>";
    }
}

?>
