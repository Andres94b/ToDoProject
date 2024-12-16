<html>
<head>
</head>
<body>
<?php
session_start();
$id= session_id();
echo $_SESSION["USERNAME"];
if (!isset($_SESSION["USERNAME"])){
    header('Location:account/login.php');
}
else{
    header('Location:home/home_page.php');
}

?>
</body>
</html>
