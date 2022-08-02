<?php 
	include "config.php";
	$uid = $_POST["uid"];
	$fname = $_POST["fname"];
	$lname = $_POST["lname"];
	$email = $_POST["email"];
	$contact = $_POST["contact"];
	$gender = $_POST["gender"];
	$ann_date = $_POST["ann_date"];
	$varified = $_POST["varified"];
	$address = $_POST["address"];

	$pwd = rand(11111,99999);

	$sql = "UPDATE user SET ufname='$fname', ulname='$lname', uemail='$email',ucontact='$contact', ugender='$gender', Anniversary='$ann_date', varified='$varified', address='$address' WHERE userid='$uid' ";
	$result = mysql_query($sql,$conn);
	if ($result)
	{
		header('Location: users.php?user_update=success');
	}
	else
	{
		header('Location: users.php?user_update=fail');
	}
?>