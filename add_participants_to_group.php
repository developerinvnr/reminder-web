<?php
  session_start();
  if (!isset($_SESSION['id']))
  {
    header('Location: index.php');
  }
  include "config.php";
  $group = $_POST["group"];
  $group_id_value = $_POST['group_id_value'];
  $par = $_POST["par"];


  $sql1 = " UPDATE group_table SET gname='$group' WHERE gid='$group_id_value' ";
  $result1 = mysql_query($sql1,$conn);
  if ($result1)
  {
    foreach ($_POST['par'] as $ulist) 
    {
        $sql2 = "INSERT INTO group_contact (gid, userid) VALUES ('$group_id_value','$ulist')";
        $result2 = mysql_query($sql2,$conn);
    }
    header('Location: contact_list.php?update_contact=success');
  }
  else
  {
    header('Location: contact_list.php?update_contact=fail');
  }
?>