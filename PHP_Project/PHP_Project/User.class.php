<?php
class User{
    private $name;
    private $username;
    private $email;
    private $password;
    
    public function __construct($name=null,$username=null, $email=null, $password=null){
        $this -> username = $username;
        $this -> name = $name;
        $this -> email = $email;
        $this -> password = $password;
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    
    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }
    
    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * @param mixed $name
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }
    
    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
    
    
    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
    
    
    public static function getHeader(){
        $str = "<table border=1>";
        $str = "$str <tr><th>Username</th><th>Name</th><th>Email</th></tr>";
        return $str;
    }
    
    public static function getFooter(){
        return "</table>";
    }
    
    public function __toString(){
        $str = "<tr><td>$this->usernamename</td><td>$this->name</td><td>$this->email</td>";
        return $str;
    }
    
    public function __call($method, $args)
    {
        if ($method == "update"){
            $username = $this->username;
            $opType = $args[0];
            $connection =$args[1];
            
            if ($opType == "p")
            {
                $password = $this->password;
                $sqlStmt = "update users set password='$password' where username = $username";
            }
            else{
                $email = $this->email;
                $sqlStmt = "update users set email='$email' where username = $username";
            }
            $result = $connection->exec($sqlStmt);
            return $result;
        }
    }
    
    // We create the CRUD methods here
    
    public function create($connection){
        $username = $this->username;
        $name = $this->name;
        $email = $this->email;
        $pass = $this->password;
        
        $sqlStmt = "insert into users values ('$username','$name','$email','$pass')";
        $result = $connection->exec($sqlStmt);
        return $result;
        
    }
    
    public function delete($connection){
        $username = $this->username;
        $sqlStmt = "delete from users where username=$username";
        $result = $connection->exec($sqlStmt);
        return $result;
    }
    
    // We create the query methods
    public static function getAllTeachers($connection){
        $sqlStmt = "select * from users";
        $listRec = $connection->query($sqlStmt);// returns an associative array
        $counter = 0;
        //if(sizeof($listRec)>0){
        foreach ($listRec as $rec){
            $user = new User();
            $user->setName($rec["name"]);
            $user->setUsername($rec["username"]);
            $user->setEmail($rec["email"]);
            $listOfUsers[$counter++] =$user;
        }
        //}
        
        return serialize($listOfUsers);
    }
    
    public static function displayUsers($result){
        $listUsers = unserialize($result);
        
        echo User::getHeader();
        
        foreach($listUsers as $oneUser){
            echo $oneUser;
        }
        
        echo User::getFooter();
    }
  
    public function getUserByIdNPass($connection){
        $username = $this->username;
        $userPass = $this->password;
        
        $sqlStmt = "select * from users where username=:username and password=:userPass";
        $prepare = $connection->prepare($sqlStmt);
        $prepare->bindValue(":username",$username,PDO::PARAM_INT);
        $prepare->bindValue(":userPass",$userPass,PDO::PARAM_STR);
        $prepare->execute();
        $result = $prepare->fetchAll();
        
        $user = "";
        if(sizeof($result)>0){
            $user = new User();
            $user->name = $result[0]["name"];
            $user->username = $result[0]["username"];
            $user->email = $result[0]["email"];
            $user->password = $result[0]["password"];
        }
        return serialize($user);
    }
    
    public static function displayOneUser($user){
        
        echo User::getHeader();
        echo $user;
        echo User::getFooter();
    }
}
?>