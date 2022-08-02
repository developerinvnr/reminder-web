<?php
include "config.php";

if($_REQUEST['UserId']!='' && $_REQUEST['value']=='contact_request')
{
    
  $query = mysql_query("SELECT cr.req_id,u.userid,u.ufname,u.ulname,u.ucontact,u.uemail FROM contact_request cr inner join user u on cr.request_by=u.userid WHERE cr.request_approve=0  AND cr.request_to='".$_REQUEST['UserId']."' order by u.ufname asc",$conn);
  $uarray = array();
  while($res = mysql_fetch_assoc($query)){ $uarray[]=$res; }
  
  
  $queryR = mysql_query("SELECT count(*) as ReqCount FROM contact_request cr inner join user u on cr.request_by=u.userid WHERE cr.request_approve=0  AND cr.request_to='".$_REQUEST['UserId']."' order by u.ufname asc",$conn);
  $resR = mysql_fetch_assoc($queryR);
  $queryN = mysql_query("SELECT count(*) as NotiCount FROM my_notification WHERE userid=".$_REQUEST['UserId']." and date>='".date("Y-m-d 00:00:00")."' and date<='".date("Y-m-d 24:00:00")."'",$conn);
  $resN = mysql_fetch_assoc($queryN);
  $cReq=$resR['ReqCount']+$resN['NotiCount'];
  
  echo json_encode(array("count_value" => $cReq, "contact_request_list" => $uarray )); 
}


elseif($_REQUEST['UserId']!='' && $_REQUEST['req_id']!='' && $_REQUEST['value']=='contact_request_accept' && $_REQUEST['req_value']!='')
{
    
  $query = mysql_query("update contact_request set request_approve=".$_REQUEST['req_value']." WHERE req_id=".$_REQUEST['req_id'],$conn);
  
  $sql = mysql_query("select * from contact_request WHERE req_id=".$_REQUEST['req_id'],$conn);  $res = mysql_fetch_assoc($sql);
  $query2 = mysql_query("INSERT INTO contact_request(request_by, request_to, request_sent, request_approve) VALUES ('".$res['request_to']."', '".$res['request_by']."', 1, 1)",$conn);
  
  if($query)
  { 
    
    $ssq = mysql_query("SELECT ufname,ucontact,uemail,user_token FROM user WHERE userid=".$res['request_by'],$conn); $row = mysql_fetch_assoc($ssq);
    $mobile = $row['ucontact'];
    $uname = $row['ufname'];
    $uemail = $row['uemail'];
    $user_token = $row['user_token'];
    
    $su = mysql_query("SELECT ufname,ucontact,uemail,user_token FROM user WHERE userid=".$res['request_to'],$conn); $ru = mysql_fetch_assoc($su);
    
    $username = "developerinvnr@gmail.com";
    $hash = "736397e8c20036f67d304d4d8ee316720a93c9d9d83046cbb453303194086efa";
    $test = "0";
    $sender = "REMVNR";
           
    $message = "Dear $uname, Your contact request have accepted from ".$ru['ufname']." -vnr";
    $message = urlencode($message);
    $data = "username=" . $username . "&hash=" . $hash . "&message=" . $message . "&sender=" . $sender . "&numbers=" . $mobile . "&test=" . $test;
    $ch = curl_init('http://api.textlocal.in/send/?');
          curl_setopt($ch, CURLOPT_POST, true);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          $result = curl_exec($ch);
          curl_close($ch);
        
    echo json_encode(array("msg" => 'Successfully updated', 'status'=>'300')); 
    
      
  }
  else{ echo json_encode(array("msg" => 'Error', 'status'=>'100')); } 
}


elseif($_REQUEST['UserId']!='' && $_REQUEST['value']=='user_notification')
{
    
  $query = mysql_query("SELECT * FROM my_notification WHERE userid=".$_REQUEST['UserId']." and date>='".date("Y-m-d 00:00:00")."' and date<='".date("Y-m-d 24:00:00")."'",$conn);
  $uarray = array();
  while($res = mysql_fetch_assoc($query)){ $uarray[]=$res; }
  echo json_encode(array("notification_list" => $uarray));
}





?>