<?php 
 	session_start();
	include "config.php";
	$rem_id = $_GET["rem_id"];
	$page = $_GET["page"];

	$sql = "UPDATE reminder SET activity = 'D' WHERE rem_id = '$rem_id' ";
	$result = mysql_query($sql,$conn);
	if ($result)
	{
		if ($page=="home") 
		{
			header('Location: home.php?rem_delete=success');
		}
		else if($page=="calendar")
		{
			header('Location: calendar.php?rem_delete=success');
		}
		else
		{
			header('Location: reports.php?rem_delete=success');
		}
	}
	else
	{
		if ($page=="home") 
		{
			header('Location: home.php?rem_delete=fail');
		}
		else if($page=="calendar")
		{
			header('Location: calendar.php?rem_delete=fail');
		}
		else
		{
			header('Location: reports.php?rem_delete=fail');
		}
	}

?>

