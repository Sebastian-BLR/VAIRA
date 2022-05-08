<?php session_start();
    if(isset($_SESSION['user']) && $_SESSION['userType'] == 3)
        require 'views/index.view.php';
    else 
        header('location: ../login.php');
?>