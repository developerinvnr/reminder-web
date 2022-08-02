<?php
  session_start();
  if (!isset($_SESSION['id']))
  {
    header('Location: index.php');
  }
  include "config.php";
  $group = $_POST["group"];
  $uid = $_SESSION['id'];
  $par = $_POST["par"];

  $sql1 = "INSERT INTO group_table (gname, created_by) VALUES ('$group','$uid')";
  $result1 = mysql_query($sql1,$conn);
  $last_id = mysql_insert_id($conn);

  if ($result1)
  {
    foreach ($_POST['par'] as $ulist) 
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