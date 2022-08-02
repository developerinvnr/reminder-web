<?php
include "config.php";

if($_REQUEST['value']=='chat' && $_REQUEST['remid']>0)
{
 
  $query = mysql_query("SELECT c.*, CONCAT(ufname,' ',ulname) as name FROM reminder_participants_chat c inner join user u on c.TeamBy=u.userid WHERE rem_id=".$_REQUEST['remid']." order by chat_date ASC");
  $array = array(); $row_list = mysql_num_rows($query);   
  
  
  if($row_list>0)
  {
    
    while($chat_list = mysql_fetch_assoc($query)) 
    {
       $array[] = $chat_list;
    }
      
    echo json_encode(array("msg" => 'success', "chat_list" => $array, 'status' => 300));
  }
  else
  {
    echo json_encode(array("msg" => 'data not found', "chat_list" => $array, 'status' => 200));  
  }
  
 
}





//Apps_Chat_Flag
elseif($_REQUEST['value'] == 'UserNoti' && $_REQUEST['UserId']>0 && $_REQUEST['remid']>0 && $_REQUEST['date']!='')
{
 
  $s1=mysql_query("select * from reminder_participants_chatuser where rem_id=".$_REQUEST['remid']." AND UserId=".$_REQUEST['UserId']); 
  $ros1=mysql_num_rows($s1);
  
  if($ros1>0)
  {
    $sTd=mysql_query("update reminder_participants_chatuser set Ndate='".date("Y-m-d H:i:s")."' where rem_id=".$_REQUEST['remid']." AND UserId=".$_REQUEST['UserId']);   
  }
  else
  {  
    $sTd=mysql_query("insert into reminder_participants_chatuser(UserId, Ndate, rem_id) values(".$_REQUEST['UserId'].", '".date("Y-m-d H:i:s")."', ".$_REQUEST['remid'].")");  
  }
  
  if($sTd){ echo json_encode(array("Code"=>"300", "msg"=>"Success") ); }
  else{ echo json_encode(array("Code" => "100", "msg" => "Data Not Found!") ); }
 
}





elseif($_REQUEST['value']=='addchat' && $_REQUEST['remid']>0 && $_REQUEST['UserId']>0)
{
 
  $query = mysql_query("insert into reminder_participants_chat(rem_id,chat_rmk,chat_date,TeamBy) values(".$_REQUEST['remid'].", '".$_REQUEST['msg']."', '".date("Y-m-d H:i:s")."', ".$_REQUEST['UserId'].")");
  
  if($query)
  {
    echo json_encode(array("msg" => 'success', 'status' => 300));
  }
  else
  {
    echo json_encode(array("msg" => 'error', 'status' => 200));  
  }
  
 
}

?>


