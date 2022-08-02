<?php
//error_reporting(E_ALL ^ E_DEPRECATED);
	// LOCAL
		// $db_name		= "reminder";
		// $mysql_username = "root";
		// $mysql_password = "";
		// $server_name	= "localhost";
	// LOCAL

	// SERVER
	  $db_name		= "vnrseed2_reminder_demo";
	  $mysql_username = "vnrseed2_remind";
	  $mysql_password = "vnrremind@123";
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