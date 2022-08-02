<?php

    include "config.php";
    $old_pass = md5($_REQUEST['old_pass']);
    $new_pass = md5($_REQUEST['new_pass']);
    $uid = $_REQUEST['uid'];

  $r = mysql_query("SELECT * FROM user WHERE upwd='".$old_pass."'");
  if(mysql_num_rows($r)>0) 
  {
     $row=mysql_fetch_assoc($r);
     $result = mysql_query("UPDATE user SET upwd = '$new_pass', user_varified = 'Yes' WHERE upwd = '$old_pass' AND userid = ".$uid);
	
	if($result)
	{
	  echo json_encode(array( "code" => "300","msg" => "The user password changed successfully") );
	}
	else
	{
      echo json_encode(array( "code" => "100","msg" => "Your password is wrong!") );
	}

 }
?>