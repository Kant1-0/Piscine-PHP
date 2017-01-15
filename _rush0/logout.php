<?php
 
    session_start();
 
    unset($_SESSION['LoggedIn']);
    unset($_SESSION['Username']);
    unset($_SESSION['SuperUser']);
 
?>
 
<meta http-equiv="refresh" content="0;index.php">