<?php

function connect(){
    // * Connect to LOCAL database
    require "dataConnection.php";
    
    try {
        // * Create connection
        $pdo = new PDO("mysql:host=$serverName; dbname=$dbName", $userName, $password);

        // * Set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;

    } catch (PDOException $e) {
        // * If connection fails, display error message
        $pdo = null;
        die("Connection failed: " . $e->getMessage());
        
    }
}


?>