<?php
include_once '../dbconfig.php';
include_once '../User.class.php';

$username = $_POST["username"];
$password = $_POST["password"];

try{
    $connection = new PDO("mysql:host=$host;dbname=$dbname;",$user,$pass);
    $aUser = new User();
    $aUser->setUsername($username);
    $aUser->setPassword(md5($password));
    $aUser=unserialize($aUser->getUserByIdNPass($connection));
    if(!empty($aUser)){
        // The teacher exists ==> create the session variables
        $_SESSION["EXIST"]="Y";
        $_SESSION["NAME"]=$aUser->getName();
        $_SESSION["USERNAME"]=$aUser->getUsername();
        $_SESSION["EMAIL"]=$aUser->getEmail();
    }
    else{
        $_SESSION["EXIST"]="N";
    }
}
catch(PDOException $e){
    echo $e->getMessage();
}
?>