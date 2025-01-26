<?php
$servername = "127.0.0.1";//local host works as well
$username = "root";
$password = "";
$database = "task_manager";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    echo "Not connected <br/>";
}
?>