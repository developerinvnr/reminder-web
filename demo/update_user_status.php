<?php
  session_start();
  if (!isset($_SESSION['id']))
  {
    header('Location: index.php');
  }
  include "config.php";
  $uid = $_SESSION['id'];
  $rem_id = $_POST["rem_id"];
  $comment = $_POST["comment"];
  $page_name = $_POST["page_name"];
  $status = $_POST["status"];

  if ($status==0) 
  {
      $sql1 = "UPDATE reminder_participants SET comment='$comment', status=0 WHERE rem_id='$rem_id' AND userid='$uid' ";
  }
  else
  {
    $sql1 = "UPDATE reminder_participants SET comment='$comment', status=1 WHERE rem_id='$rem_id' AND userid='$uid' ";
  }
  $result1 = mysql_query($sql1,$conn);
  /*CHECK THAT ALL USERS IN REMINDER_PARTICIPANT TABLE HAVE CoMPLETED THE TASK OR NOT, IF YES THEN UPDATE IN REMINDER TABLE.*/
  $check_user = "SELECT * FROM reminder_participants WHERE rem_id=".$rem_id;
  $count_user =  mysql_num_rows(mysql_query($check_user));
  $check_status = "SELECT * FROM reminder_participants WHERE status=1 AND rem_id='".$rem_id."' ";
  $count_status =  mysql_num_rows(mysql_query($check_status));
  if($count_user==$count_status)
  {
      $update = "UPDATE reminder SET Status='Done' WHERE rem_id=".$rem_id;
      mysql_query($update);
  }
  /*CHECK THAT ALL USERS IN REMINDER_PARTICIPANT TABLE HAVE CoMPLETED THE TASK OR NOT, IF YES THEN UPDATE IN REMINDER TABLE.*/
  if ($result1)
  {
    if ($page_name=="home") 
    {
        header('Location: home.php?status=success');
    }
    else if($page_name=="calendar")
    {
        header('Location: calendar.php?status=success');
    }
    else
    {
        header('Location: reports.php?status=success');
    }
    
  }
  else
  {
    if ($page_name=="home") 
    {
        header('Location: home.php?status=fail');
    }
    else if($page_name=="calendar")
    {
        header('Location: calendar.php?status=fail');
    }
    else
    {
        header('Location: reports.php?status=fail');
    }
    
  }
?>