<?php
include "config.php";

function get_name($userid)
{
 $sql = "SELECT * FROM user WHERE userid='".$userid."' ";
 $result = mysql_query($sql,$conn);
 $rr = mysql_fetch_assoc($result);
 return $rr['ufname'];
}

function get_number($userid)
{
 $sql = "SELECT * FROM user WHERE userid='".$userid."' ";
 $result = mysql_query($sql);
 $rr = mysql_fetch_assoc($result);
 return $rr['ucontact'];
} 

if($_REQUEST['request_by']!="" && $_REQUEST['request_to']!="") 
{
 $insert = "INSERT INTO contact_request(request_by, request_to, request_sent, request_approve) VALUES ('".$_REQUEST['request_by']."', '".$_REQUEST['request_to']."', 1, 0)";
 $res = mysql_query($insert, $conn);
 if($res) 
 {
	 
	$username = "developerinvnr@gmail.com";
	$hash = "736397e8c20036f67d304d4d8ee316720a93c9d9d83046cbb453303194086efa";
	$test = "0";
	$sender = "REMVNR";
	$message = " ".get_name($_REQUEST['request_by'])." sent you contact request From Reminder App. For any action please go to Reminder App. -vnr";
	$message = urlencode($message);
	$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".get_number($_REQUEST['request_to'])."&test=".$test;
	$ch = curl_init('http://api.textlocal.in/send/?');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch); 
	curl_close($ch);

	echo json_encode(array( "code" => "300", "msg" => "Request sent successfully!") );

 }
 
}
?>