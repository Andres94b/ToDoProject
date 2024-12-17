<?php
include_once '../dbconfig.php';
include_once '../Task.class.php';

$username = $_SESSION["USERNAME"];

try{
    $connection = new PDO("mysql:host=$host;dbname=$dbname;",$user,$pass);
    $aTask = new Task();
    $aTask->setUsername($username);
    $tasks=unserialize($aTask->fetchCompletedTasksById($connection));
    
    if($tasks!=""){
        foreach ($tasks as $row ){
            echo "<div class='history-item'>
                            <span>{$row->getName()} - Completed at: {$row->getCompleted()}</span>
                          </div>";
        }
    }
    else{
        echo $tasks;
        echo "No completed tasks";
    }
}
catch(PDOException $e){
    echo $e->getMessage();
}


?>