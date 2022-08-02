<?php 
 	session_start();
	include "config.php";
	$email = $_POST["email"];
	$pwd = md5($_POST["pwd"]);

	$sql = "SELECT * FROM user WHERE uemail='$email' and upwd='$pwd' ";
	$result = mysql_query($sql,$conn);
	if (mysql_num_rows($result) > 0)
	{
		$row = mysql_fetch_assoc($result);
		$_SESSION['id'] = $row['userid'];
		$_SESSION['utype'] = $row['utype'];
		$_SESSION['ufname'] = $row['ufname'];
		$_SESSION['ulname'] = $row['ulname'];
		$_SESSION['uemail'] = $row['uemail'];
		setcookie("c_id", $_SESSION['id'], time() + (86400 * 30), "/");
		setcookie("c_utype", $_SESSION['utype'], time() + (86400 * 30), "/");
		setcookie("c_ufname", $_SESSION['ufname'], time() + (86400 * 30), "/");
		setcookie("c_ulname", $_SESSION['ulname'], time() + (86400 * 30), "/");
		setcookie("c_uemail", $_SESSION['uemail'], time() + (86400 * 30), "/");
		
		if($_SESSION['id']!=$row['crby'])
		{
		    
		   $result2 = mysql_query("INSERT INTO contact_request (request_by, request_to, request_sent, request_approve, created_at) VALUES 
          ('".$_SESSION['id']."', '".$row['crby']."', '1', '1', '".date("Y-m-d H:i:s")."')",$conn); 
		    
		   //$sql = "update contact_request set request_sent=1, request_approve=1 where request_by=".$_SESSION['id']." and request_to=".$row['crby'];
	        //$result2 = mysql_query($sql,$conn); 
		}
		
		
		
		header('Location: home.php');
	}
	else
	{
		header('Location: index.php?login=fail');
	}

?>

