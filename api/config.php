<?php
//error_reporting(E_ALL ^ E_DEPRECATED);
	// LOCAL
		// $db_name		= "reminder";
		// $mysql_username = "root";
		// $mysql_password = "";
		// $server_name	= "localhost";
	// LOCAL

	// SERVER
	  $db_name		= "surta";
	  $mysql_username = "surta_user";
	  $mysql_password = "surta_pass";
	  $server_name	= "localhost";
	// SERVER



	$conn = mysql_connect("$server_name", "$mysql_username", "$mysql_password");
	$con = mysql_select_db("$db_name", $conn);
	if ($conn) 
	{
		//echo "Database Connected...!";
	}
	else
	{
		 echo "Error...!";
	}

?>