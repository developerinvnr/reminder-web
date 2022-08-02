<?php
    session_start();
    if (!isset($_SESSION['id']))
    {
        header('Location: index.php');
    }    
    include "config.php";
    $old_pass = md5($_POST['old_pass']);
    $new_pass = md5($_POST['new_pass']);
    $sql = "UPDATE user SET upwd = '$new_pass' WHERE upwd = '$old_pass' AND userid = ".$_SESSION['id'];
	$result = mysql_query($sql,$conn);
	if (mysql_affected_rows()>0)
	{
		header('Location: profile.php?change_password=success');
	}
	else
	{
		header('Location: profile.php?change_password=fail');
	}


?>