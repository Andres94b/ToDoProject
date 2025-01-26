<?php
include_once '../dbconfig.php';


if (isset($_GET['action']) && $_GET['action'] === 'record') {
    $taskId = intval($_GET['id']);
    $startTime = $_GET['start_time'];
    $endTime = $_GET['end_time'];
    $totalTime = intval($_GET['total_time']);
    
    try {
        $connection = new PDO("mysql:host=$host;dbname=$dbname;", $user, $pass);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $connection->prepare("INSERT INTO task_time (task_id, start_time, end_time, total_time) VALUES (:task_id, :start_time, :end_time, :total_time)");
        $stmt->bindParam(':task_id', $taskId);
        $stmt->bindParam(':start_time', $startTime);
        $stmt->bindParam(':end_time', $endTime);
        $stmt->bindParam(':total_time', $totalTime);
        
        $stmt->execute();
        
        header("Location: ../home/home_page.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
