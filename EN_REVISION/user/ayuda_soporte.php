<?php session_start();
    if (!isset($_SESSION['user']) || $_SESSION['userType'] != 3)
        header("Location: ../login.php");
    require 'views/ayuda_soporte.view.php';
?>