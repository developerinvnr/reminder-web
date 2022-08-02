<?php
  session_start();
  if (!isset($_SESSION['id']))
  {
    header('Location: index.php');
  }
  include "config.php";
  $userid = $_REQUEST["userid"]; 
  $gid = $_REQUEST["gid"];
  $sql1 = "DELETE FROM group_contact WHERE gid='$gid' AND userid='$userid' ";
  $result1 = mysql_query($sql1,$conn);
  if ($result1)
  {
    header('Location: contact_list.php?user_delete=success');
  }
  else
  {
    header('Location: contact_list.php?user_delete=fail');
  }
?>