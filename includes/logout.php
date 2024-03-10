<?php 
    include "connection.php";
    session_start();
    
    $_SESSION['userId'] = null;
    $_SESSION['user_name'] = null;  
    $_SESSION['user_firtsName'] = null;
    $_SESSION['user_lastName'] = null; 
    $_SESSION['user_role'] = null;

    header("Location: ../index.php");
?>

