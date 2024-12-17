<?php
include_once '../dbconfig.php';
include_once '../User.class.php';

$name = $_POST["name"];
$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];

try{
    $connection = new PDO("mysql:host=$host;dbname=$dbname;",$user,$pass);
    $aUser = new User();
    $aUser->setName($name);
    $aUser->setEmail($email);
    $aUser->setUsername($username);
    $aUser->setPassword(md5($password));
    $isAdded = $aUser->create($connection);
    
    if($isAdded){
        $_SESSION["CREATED"] = "Y";
        echo "The User with id ".$aUser->getUsername()." has been added!";
    }else{
        $_SESSION["CREATED"] = "N";
        
    }
}
catch(PDOException $e){
    echo $e->getMessage();
}
?>