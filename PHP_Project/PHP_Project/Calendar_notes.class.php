<?php
class Calendar_Notes{
    private $id;
    private $note_date;
    private $note_text;
    private $task_id;
    private $username;
    
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNote_date()
    {
        return $this->note_date;
    }

    /**
     * @return mixed
     */
    public function getNote_text()
    {
        return $this->note_text;
    }

    /**
     * @return mixed
     */
    public function getTask_id()
    {
        return $this->task_id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $note_date
     */
    public function setNote_date($note_date)
    {
        $this->note_date = $note_date;
    }

    /**
     * @param mixed $note_text
     */
    public function setNote_text($note_text)
    {
        $this->note_text = $note_text;
    }

    /**
     * @param mixed $task_id
     */
    public function setTask_id($task_id)
    {
        $this->task_id = $task_id;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function __construct($id = null, $note_date = null, $note_text = null, $task_id = null, $username = null) {
        $this->id = $id;
        $this->note_date = $note_date;
        $this->note_text = $note_text;
        $this->task_id = $task_id;
        $this->username = $username;
    }
    
    public function create($connection){
        
        $id = $this->id;
        $note_date = $this->note_date;
        $note_text = $this->note_text;
        $task_id = $this->task_id;
        $username = $this->username;
                
        $sqlStmt = "insert into calendar_notes values ('$id','$note_date','$note_text','$task_id', '$username')";
        $result = $connection->exec($sqlStmt);
        return $result;
    }
}