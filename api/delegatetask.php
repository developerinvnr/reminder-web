<?php
include "config.php";
include "add_task_notification.php";

if($_REQUEST['UserId']!='' && $_REQUEST['Rem_Id']!='' && $_REQUEST['Delegate_Id']!='')
{      
  $user_id    =   $_REQUEST['UserId'];
  $rem_id     =   $_REQUEST['Rem_Id'];
  $delegtr_id =   $_REQUEST['Delegate_Id'];
  
  $update_reminderP=mysql_query("UPDATE reminder_participants SET farward_userId='". $delegtr_id."' WHERE rem_id='".$rem_id."' AND userid=".$user_id,$conn);
  
  if($update_reminderP)
  {
    echo json_encode(array('msg' => 'Task delegeted successfuly to other ', 'status' => 300));
	
	$ulist = mysql_fetch_assoc(mysql_query("SELECT ufname,ulname FROM user WHERE userid=".$user_id,$conn));
    $uname=$ulist['ufname'].' '.$ulist['ulname'];
	
	$ulist2 = mysql_fetch_assoc(mysql_query("SELECT ufname,ulname,uemail,user_token FROM user WHERE userid=".$delegtr_id,$conn));
    $Duname=$ulist2['ufname'].' '.$ulist2['ulname'];
	
	
	
	/*******************************/
	
	$from = "reminder@vnrseeds.co.in";
	//$uemail = $ulist2['uemail'];
	$uemail = "ajaykumar.dewangan@vnrseeds.in";
    $subject = "New Task in Reminder";
    $message = " Dear ".$Duname.", A new task is assigned to you by ".$uname." in Reminder.";
    $mail = mail($uemail, $subject, $message, "From: ".$from);

    /* ---- Notification --- */
    $data1['subject'] = "New Task in Reminder";
    $data1['msg_body'] =  " Dear ".$Duname.", A new task is assigned to you by ".$uname." in Reminder.";            
    android($data1,$ulist2['user_token']); 
	/* ---- Notification --- */
	
    /*******************************/
  }
  else
  {
    echo json_encode(array('msg' => 'Error', 'status' => 100));
  }         
		   		  
}
?>