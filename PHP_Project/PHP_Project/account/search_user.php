<?php
session_start();
if(!empty($_POST["username"] && !empty($_POST["password"]))){
    if(!isset($_SESSION["USERNAME"])){
        // find the user in the database
        include 'find_user.php';
        //echo $_SESSION["USERNAME"];
        if($_SESSION["EXIST"]=="Y"){
            
            
            header("Location:../index.php");
        }
        else{
            //echo md5($_GET["password"]);
            
            //header("Location:FileError.php?error='Teacher not found'");
            header("Location:login.php?notfound=true");//
            
        }
    }
    else{
        //header('Location:FileError.php?error="Session already open"');
        //header("Location:../home/home_page.php");
    }
}
else{
    //header("Location:login.php");
}
?>