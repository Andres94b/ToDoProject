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
            echo "<div class='history-item' data-id='{$row->getId()}'>
                            <h2>{$row->getName()}</h2>
                            <p>{$row->getDescription()}</p>
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