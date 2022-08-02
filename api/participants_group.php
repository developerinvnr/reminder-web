<?php
 
  include "config.php";
  $group = $_REQUEST["group_name"];
  $uid = $_REQUEST['uid'];
  $par = $_REQUEST["persons"];

  $sql1 = "INSERT INTO group_table (gname, created_by) VALUES ('$group','$uid')";
  $result1 = mysql_query($sql1,$conn);
  $last_id = mysql_insert_id($conn);

  
  if ($result1)
  {
    foreach ($_REQUEST['par'] as $ulist) 
    {
        $sql2 = "INSERT INTO group_contact (gid, userid) VALUES ('$last_id','$ulist')";
        $result2 = mysql_query($sql2,$conn);
    }
    header('Location: contact_list.php?contact=success');
  }
  else
  {
    header('Location: contact_list.php?contact=fail');
  }
?>