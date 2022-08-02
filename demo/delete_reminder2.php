<?php 
 	session_start();
	include "config.php";
	$rem_id = $_GET["rem_id"];

	$sql = "UPDATE reminder SET activity = 'D' WHERE rem_id = '$rem_id' ";
	$result = mysql_query($sql,$conn);
	if ($result)
	{
		header('Location: reports.php?rem_delete=success');
	}
	else
	{
		header('Location: reports.php?rem_delete=fail');
	}

?>

