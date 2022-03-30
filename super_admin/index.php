<?php session_start();
    if(isset($_SESSION['user']) && $_SESSION['userType'] == 1)
        require 'views/index.view.php';
    else 
        header('location: ../login.php');
?>