<?php

try {
	        // $conn = new PDO("mysql:host=localhost;dbname=vnr_reminder", 'root',  'root');
	    $conn = new PDO("mysql:host=localhost;dbname=surta", 'surta_user',  'surta_pass');
	    // $conn = new PDO("mysql:host=localhost;dbname=vnr_reminder", $db_username, $db_password);
	    // set the PDO error mode to exception
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    // echo "Connected successfully";
	    }
	    
	catch(PDOException $e)
	    {
	    echo "Connection failed: " . $e->getMessage();
	    }
?>