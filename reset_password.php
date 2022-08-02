<?php
    session_start();
    if (!isset($_SESSION['id']))
    {
        header('Location: index.php');
    }    
    include "config.php";
    $pass = md5($_REQUEST['pass']);
    
    $sql = "UPDATE user SET upwd = '$pass', user_varified ='Yes' WHERE userid = ".$_SESSION['id'];
	$result = mysql_query($sql,$conn);
	if ($result)
	{
		header('Location: home.php?update=success');
	}
	else
	{
		header('Location: home.php?update=fail');
	}


?>