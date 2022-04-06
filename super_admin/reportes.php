<?php session_start();
    if (!isset($_SESSION['user']) || $_SESSION['userType'] != 1)
        header("Location: ../login.php");
    require 'views/reportes.view.php';
?>