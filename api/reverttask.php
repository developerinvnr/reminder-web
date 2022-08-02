<?php
include "config.php";
include "add_task_notification.php";

if($_REQUEST['UserId']!='' && $_REQUEST['Rem_Id']!='')
{      
  $user_id    =  $_REQUEST['UserId'];
  $rem_id     =  $_REQUEST['Rem_Id'];
  
  $update_reminderP=mysql_query("UPDATE reminder_participants SET farward_userId=0 WHERE rem_id='".$rem_id."' AND userid=".$user_id,$conn);
  
  if($update_reminderP)
  {
    echo json_encode(array('msg' => 'Task reverted successfuly to other ', 'status' => 300));
  }
  else
  {
    echo json_encode(array('msg' => 'Error', 'status' => 100));
  }         
		   		  
}
?>