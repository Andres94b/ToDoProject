<?php
include '../dbconfig.php';
global $conn;
?>

<!DOCTYPE html>
<html lang="en">

<div id="addNoteModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="document.getElementById('addNoteModal').style.display='none'">&times;</span>

        <h2>Add Note</h2>
        <form id="noteForm" action="insert_notes.php" method="POST">
            <input type="hidden" name="note_date" id="note_date" value="">
            <input type="text" name="note_text" placeholder="Enter your note" required>
            <button type="submit" name="action" value="add">Add Note</button>
        </form>
    </div>
</div>

</html>