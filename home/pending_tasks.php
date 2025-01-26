<?php
include_once '../dbconfig.php';
include_once '../Task.class.php';

$username = $_SESSION["USERNAME"];

try{
    $connection = new PDO("mysql:host=$host;dbname=$dbname;",$user,$pass);
    $aTask = new Task();
    $aTask->setUsername($username);
    
    $tasks=unserialize($aTask->fetchPendingTasksById($connection));
    
    if($tasks!=""){
        foreach ($tasks as $row ){
            // Fetching the total time
            $totalTime = $aTask->fetchTotalTimeByTaskId($connection, $row->getId());
            
            echo "<div class='history-item active' data-date='{$row->getDuedate()}'>
                            <h2>{$row->getName()}</h2>
                            <p>{$row->getDescription()}</p>
                            <p>Total Time: {$totalTime} seconds</p>

                            <div class='timer' id='timer-{$row->getId()}'>0 seconds</div>
                            <a href='#' onclick='startTimer({$row->getId()})'>Start</a> |
                            <a href='#' onclick='stopTimer({$row->getId()})'>Stop</a>
                            <!-- Button to view all records for the specific task_id -->
                            <div style='margin-top: 10px;'>
                                <a href='../timer/show_records.php?task_id={$row->getId()}' class='button'>View All time Records</a>
                            </div>

                            <div class='task-actions'>
                                <a href='../edit_task.php?id={$row->getId()}'>Edit</a> |
                                <a href='../delete_task.php?id={$row->getId()}'>Delete</a> |
                                <a href='../completed_tasks.php?id={$row->getId()}'>Complete</a>
                            </div>
                          </div>";
        }
    }
    else{
        echo $tasks;
        echo "No pending tasks";
    }
}
catch(PDOException $e){
    echo $e->getMessage();
}
?>