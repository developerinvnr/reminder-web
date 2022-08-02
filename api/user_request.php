<?php
include "config.php";
include "add_task_notification.php";

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
	/************************************/
       	// Account details
	    $apiKey = urlencode('n41ZZY/VUcc-VpNsm9ZokZI2TGecZvk2WYLFvK73Ox
');
	
      	// Message details
	    $numbers = array(get_number($_REQUEST['request_to']));
	    $sender = urlencode('REMVNR');
	    $message = get_name($_REQUEST['request_by'])." sent you contact request From Reminder App. For any action please go to Reminder App. -vnr";
	    $numbers = implode(',', $numbers);
 
	    // Prepare data for POST request
	    $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
 
	    // Send the POST request with cURL
	    $ch = curl_init('https://api.textlocal.in/send/');
	    curl_setopt($ch, CURLOPT_POST, true);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    $response = curl_exec($ch);
	    curl_close($ch);
       /************************************/
	
	/*
	$hash = "736397e8c20036f67d304d4d8ee316720a93c9d9d83046cbb453303194086efa";
	$test = "0";
	$sender = "REMVNR";
	$message = get_name($_REQUEST['request_by'])." sent you contact request From Reminder App. For any action please go to Reminder App. -vnr";
	$message = urlencode($message);
	$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".get_number($_REQUEST['request_to'])."&test=".$test;
	$ch = curl_init('http://api.textlocal.in/send/?');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch); 
	curl_close($ch);
	*/
	
	$Dlink="https://play.google.com/store/apps/details?id=in.co.vnrseeds.www.reminder";
	/************************************/
       	// Account details
	    $apiKey = urlencode('n41ZZY/VUcc-VpNsm9ZokZI2TGecZvk2WYLFvK73Ox
');
	
      	// Message details
	    $numbers = array(get_number($_REQUEST['request_to']));
	    $sender = urlencode('REMVNR');
	    $message = "Reminder apps download link : ".$Dlink." vnr";
	    $numbers = implode(',', $numbers);
 
	    // Prepare data for POST request
	    $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
 
	    // Send the POST request with cURL
	    $ch = curl_init('https://api.textlocal.in/send/');
	    curl_setopt($ch, CURLOPT_POST, true);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    $response = curl_exec($ch);
	    curl_close($ch);
       /************************************/
/*	
$message2 = "Reminder apps download link : ".$Dlink." vnr";
$message2 = urlencode($message2);
$data1 = "username=".$username."&hash=".$hash."&message=".$message2."&sender=".$sender."&numbers=".get_number($_REQUEST['request_to'])."&test=".$test;
$ch1 = curl_init('http://api.textlocal.in/send/?');
curl_setopt($ch1, CURLOPT_POST, true);
curl_setopt($ch1, CURLOPT_POSTFIELDS, $data1);
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch1); 
curl_close($ch1);
*/


/* ---- Notification --- */
include "add_task_notification.php";
$Dlink="https://play.google.com/store/apps/details?id=in.co.vnrseeds.www.reminder";
$ulist2 = mysql_fetch_assoc(mysql_query("SELECT user_token FROM user WHERE userid=".$_REQUEST['request_to'],$conn));
$data1['subject'] = "Reminder apps download link";
$data1['msg_body'] =  "Reminder apps download link : ".$Dlink." vnr";       
android($data1,$ulist2['user_token']); 
/* ---- Notification --- */

	

	echo json_encode(array( "code" => "300", "msg" => "Request sent successfully!") );

 } 
 
}
?>