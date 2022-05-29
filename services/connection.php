<?php 
    $servername = "localhost";
    $username = "root";
    //$password = "root";
    $password = "";
    $dbname = "db_vaira";

    try {
        $pdo = new PDO('mysql:host='.$servername.';dbname='.$dbname, $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        // set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        $pdo = null;
    }     
?>
