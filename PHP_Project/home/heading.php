<?php
session_start();
echo '<header class="navbar">';
echo '<div class="logo">';
echo '<img src="../assets/Logo.png" alt="Logo">';
echo '<h1>NOT-IT</h1>';
echo '</div>';
echo '<nav class="nav-links">';

if (isset($_SESSION["USERNAME"])){
    $name = $_SESSION["NAME"];
    //$sid = session_id();
    echo '<a href="../home/home_page.php">Home</a>';
    echo "<a href='../account/account_config.php'>$name</a>";
    echo '&nbsp&nbsp <a href="../account/logout.php">Log out</a>';
    
}
else{
    echo '<a href="../index.php">Home</a>';
    echo '<a href="../account/login.php">Log In</a>';
}
echo '</nav>';
echo '</header>';

?>
<!-- <header class="navbar"> -->
<!-- <div class="logo"> -->
<!-- <img src="assets/Logo.png" alt="Logo"> -->
<!-- <h1>NOT-IT</h1> -->
<!-- </div> -->
<!-- <nav class="nav-links"> -->
<!-- <a href="index.php">Home</a> | -->
<!-- <a href="">Log In</a> -->
<!-- </nav> -->
<!-- <!--         <ul class="nav-links"> -->
<!-- <!--             <li><a href="index.php">Home</a></li> -->
<!-- <!--             <li><a href="">Log In</a></li> -->
<!-- <!--         </ul> -->
<!-- </header> -->
<!-- <!-- Navigation Bar -->
<!-- <!--     <div class="navbar"> -->
<!-- <!--         <div class="logo"> -->
<!-- <!--             <img src="assets/Logo.png" alt="Logo"> -->
<!-- <!--             <h1>NOT-IT</h1> -->
<!-- <!--         </div> -->
<!-- <!--         <ul class="nav-links"> -->
<!-- <!--             <li><a href="index.php">Home</a></li> -->
<!-- <!--         </ul> -->
<!-- <!--     </div> -->