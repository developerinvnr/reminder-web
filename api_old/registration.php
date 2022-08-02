<?php
    session_start();
  include "config.php";

  $fname = $_POST["fname"];
  $lname = $_POST["lname"];
  $email = $_POST["email"];
  $mobile = $_POST["mobile"];
  $user_token = $_POST["user_token"];

  $pwd = rand(11111,99999);


  $check_user = "SELECT * FROM user WHERE uemail='$email'";
  
  $result = mysql_query($check_user,$conn);
  if (mysql_num_rows($result)>0) 
  {
  	    echo json_encode(array( "code" => "100","msg" => "The user email is already exist!") );
  }
  else
  {     $q=mysql_query("select MAX(userid) as MaxId from user",$conn);
        $r=mysql_fetch_assoc($q); $maxid=$r['MaxId']+1;
  
  		$sql = "INSERT INTO user (userid,ufname, ulname, uemail,ucontact, upwd, utype, usts,crby,user_token) VALUES (".$maxid.",'$fname','$lname','$email','$mobile', '".md5($pwd)."', 'U', 'A', ".$maxid.",'$user_token') ";
	    $result = mysql_query($sql,$conn);
	    if ($result)
	    {

          $username = "developerinvnr@gmail.com";
          $hash = "736397e8c20036f67d304d4d8ee316720a93c9d9d83046cbb453303194086efa";
          $test = "0";
          $sender = "REMVNR";
          
		  $message = "Dear $fname, Your Reminder Account is Successfully Created. Please login with your credentials- Username: $email Password: $pwd - vnr";

		  $message = urlencode($message);
		  $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$mobile."&test=".$test;

		  $ch = curl_init('http://api.textlocal.in/send/?');
		  curl_setopt($ch, CURLOPT_POST, true);
		  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		  $result = curl_exec($ch); 
   
		  curl_close($ch); 

	      $from = "info@reminder";
	      $subject = "Registration successful";
	      $message = " Dear ".$fname." ".$lname.",Your Reminder Account is Successfully Created. Please login with your creadentials- Username : ".$email." Password : ".$pwd."";
	      $mail = mail($email, $subject, $message, "From: $from"); 
	      echo json_encode(array( "code" => "300","msg" => "The user registered successfully, please check registered email for login credential") );
	      die();

	    }
	    else
	    {
          echo json_encode(array( "code" => "100", "msg" => "There is some problem in your request! please try again later!!") );
          die();
	    }
  }
?>