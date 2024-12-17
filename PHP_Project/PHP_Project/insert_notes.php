// <?php
include 'olddbconfig.php';

if (isset($_POST['add'])) {
    insert_note();
    echo "inserted.";
}


function insert_note() {
    global $connection;
    
    $note_text = $_POST["note_text"];
    $task_id = $_POST["task_id"];
    $username = $_SESSION["username"];
    
    $query = "INSERT INTO calendar_notes (note_text, task_id) VALUES ('$note_text', '$task_id')";
    
    try {
        mysqli_query($connection, $query);
    } catch (Exception $e) {echo "Error<br/>";
    }
}

?>