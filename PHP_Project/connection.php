<?php
require_once 'dbconfig.php';
//global $connection;
if(!mysqli_connect_errno())
{
    //die("Database connection failed: " . mysqli_connect_error());
    header("Location:index.php");
}
else{
    //header('Succesfully connected');
    //echo(mysqli_connect_errno());
    header("Location:ErrorDatabaseConnection.php");
    
}