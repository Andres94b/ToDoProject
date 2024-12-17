<?php
class Task{
    private $id;
    private $name;
    private $description;
    private $duedate;
    private $status;
    private $created;
    private $completed;
    private $username;
    
    /**
     * @return mixed
     */
    public function getDuedate()
    {
        return $this->duedate;
    }

    /**
     * @param mixed $duedate
     */
    public function setDuedate($duedate)
    {
        $this->duedate = $duedate;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return string
     */
    public function getCompleted()
    {
        return $this->completed;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @param string $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @param string $completed
     */
    public function setCompleted($completed)
    {
        $this->completed = $completed;
    }

    /**
     * @param string $userId
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function __construct($id=null, $name=null,$description=null, $duedate=null, $status=null, $created=null, $completed=null, $username=null){
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->duedate = $duedate;
        $this->status = $status;
        $this->created = $created;
        $this->completed = $completed;
        $this->username = $username;
        
    }
    
    public function fetchPendingTasksById($connection){
        // Fetch pending tasks from the database
        $username = $this->username;
        $sqlStmt = "SELECT * FROM tasks WHERE status = 'pending' AND username=:username";
        $prepare = $connection->prepare($sqlStmt);
        $prepare->bindValue(":username",$username,PDO::PARAM_STR);
        $prepare->execute();
        
        $result = $prepare->fetchAll();
        
        
        $counter = 0;
        if(sizeof($result)>0){
            foreach ($result as $rec){
                $task = new Task();
                $task->id=$rec["id"];
                $task->name = $rec["task_name"];
                $task->description = $rec["task_description"];
                $task->duedate = $rec["due_date"];
                $task->status= $rec["status"];
                $task->created = $rec["created_at"];
                $task->completed = $rec["completed_at"];
                $task->username = $rec["username"];
                $listOfTasks[$counter++] = $task;
            }
        }
        else{
            $listOfTasks="";
        }
        
        return serialize($listOfTasks);
    }
    
    
    public function fetchCompletedTasksById($connection){
        
        $username = $this->username;
        $sqlStmt = "SELECT * FROM tasks WHERE status = 'completed' AND username=:username";
        $prepare = $connection->prepare($sqlStmt);
        $prepare->bindValue(":username",$username,PDO::PARAM_STR);
        $prepare->execute();
        
        $result = $prepare->fetchAll();
        
        $counter = 0;
        if(sizeof($result)>0){
            foreach ($result as $rec){
                $task = new Task();
                $task->id=$rec["id"];
                $task->name = $rec["task_name"];
                $task->description = $rec["task_description"];
                $task->duedate = $rec["due_date"];
                $task->status= $rec["status"];
                $task->created = $rec["created_at"];
                $task->completed = $rec["completed_at"];
                $task->username = $rec["username"];
                $listOfTasks[$counter++] = $task;
            }
        }
        else{
            $listOfTasks="";
        }
        
        return serialize($listOfTasks);
    }
    
    
}