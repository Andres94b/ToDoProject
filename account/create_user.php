<?php
if($_POST["rePassword"] == $_POST["password"]){
    if(!isset($_SESSION["USERNAME"])){
        // find the user in the database
        include 'add_user.php';
        
        if($_SESSION["CREATED"]=="Y"){
            header("Location:login.php");
        }
        else {
            header("Location:signup.php");
        }
    }
    else{
        //header('Location:FileError.php?error="Session already open"');
        header("Location:home_page.php");
    }
}
else{
    header("Location:signup.php?unmatchedPasswords=true");
}
?>