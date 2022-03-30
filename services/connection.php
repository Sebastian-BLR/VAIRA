<?php
    require 'config.php';

    try {
        $connection = new PDO("mysql:host=$serverName;dbname=$dbName",$userName,$password);
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $msg = "'Connected successfully'";
        consoleLog($msg);
        
    } catch (PDOException $e) {
        $msg = "\"Connection failed: " . $e->getMessage() . "\"";
        $connection = false;
        consoleLog($msg);
    }

    function consoleLog($msg) {
		echo '<script type="text/javascript">' .
          'console.log(' . $msg . ');</script>';
	}
?>