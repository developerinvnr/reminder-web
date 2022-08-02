<?php 
	include "config.php";
	$fname = $_POST["fname"];
	$lname = $_POST["lname"];
	$email = $_POST["email"];
	$mobile = $_POST["mobile"];
	$pwd = rand(11111,99999);
	$otp = rand(11111,99999);

	$check = "SELECT * FROM user WHERE uemail='$email' AND otp_varified=1";
	$r = mysql_query($check, $conn);
	if (mysql_num_rows($r)>0) 
	{
		header('Location: index.php?already_user=success');
	}
	else
	{
		$sql = "INSERT INTO user (ufname, ulname, uemail,ucontact, upwd, otp, otp_varified, utype, usts) VALUES ('$fname','$lname','$email','$mobile', '".$pwd."', '$otp', '0', 'U', 'A') ";
		$result = mysql_query($sql,$conn);
		if ($result)
		{
			 //$from = "info@maierp.in";
			 //$subject = "Registration successful";
			 //$message = " Dear ".$fname." ".$lname.",

			 //You have successfully registered to Reminder. Please login with your creadentials-

			 //"."Username".$email."
			 //Password".$pwd;
			 //$mail = mail($email, $subject, $message, "From: $from");

			$username = "developerinvnr@gmail.com";
			$hash = "736397e8c20036f67d304d4d8ee316720a93c9d9d83046cbb453303194086efa";
			$test = "0";
			$sender = "REMIND";
			// $message = "Your Reminder App Registration Verification OTP Code is valid for 10 Minutes and Verification OTP Code is $otp";
			$message = "Your Reminder App Registration Verification OTP Code is $otp";
			$message = urlencode($message);
			$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$mobile."&test=".$test;
			$ch = curl_init('http://api.textlocal.in/send/?');
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec($ch); 
			curl_close($ch);

			header('Location: varify_otp.php?register=success');
		}
		else
		{
			header('Location: varify_otp.php?register=fail');
		}
	}


	
?>