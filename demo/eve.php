<?php
date_default_timezone_set("Asia/kolkata"); 
include "config.php";
$sql = "SELECT * FROM notification WHERE date(not_time)=CURDATE() AND DATE_FORMAT(not_time,'%H:%i:%s') BETWEEN CURRENT_TIME AND ADDTIME(CURRENT_TIME,'1:00:00') ";
$result1 = mysql_query($sql,$conn);
while ($row = mysql_fetch_assoc($result1)) 
{
	$sql2 = "SELECT * FROM reminder r INNER JOIN reminder_participants rp ON r.rem_id=rp.rem_id INNER JOIN user u ON rp.userid = u.userid WHERE r.rem_id=".$row['rem_id'];
	$result2 = mysql_query($sql2,$conn);
	while ($row2 = mysql_fetch_assoc($result2)) 
	{
		// echo "<b>TITLE: </b>".$row2['title']."<br>";
		// echo "<b>USERNAME: </b>".$row2['ufname']." ".$row2['ulname']."<br>";
		// echo "<b>MOBILE: </b>".$row2['ucontact']."<br>";
		// echo "<b>CREATED BY: </b>".$row2['created_by']."<br>";
		// echo "<b>DATE: </b>".date('d-m-Y', strtotime($row2['from_date']))."<br>";
		// echo "<b>TIME: </b>".date('H:i a', strtotime($row2['from_date']))."<br>";
		// echo "<br><br>";
		$usernam = $row2['ufname'];
		// echo "<br>";
		$date = date('d-m-Y', strtotime($row2['from_date']));
		// echo "<br>";
		$time = date('H:i', strtotime($row2['from_date']));

		$users = $row2['ufname'];
		$mobile = $row2['ucontact'];
		$username = "developerinvnr@gmail.com";
		$hash = "736397e8c20036f67d304d4d8ee316720a93c9d9d83046cbb453303194086efa";
		$test = "0";
		$sender = "REMIND";

		$message = "REM : ".$usernam.", an event on date ".$date." at ".$time.".";

		$message = urlencode($message);
		$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$mobile."&test=".$test;
		$ch = curl_init('http://api.textlocal.in/send/?');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch); 
		curl_close($ch);
	}
	
}


?>
    
