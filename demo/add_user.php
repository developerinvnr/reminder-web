<?php
  session_start();
  if (!isset($_SESSION['id']))
  {
    header('Location: index.php');
  }
  include "config.php";
  $fname = $_POST["fname"];
  $lname = $_POST["lname"];
  $email = $_POST["email"];
  $mobile = $_POST["mobile"];
  $pwd = rand(11111,99999);


  $check_user = "SELECT * FROM user WHERE uemail='$email' ";
  $result = mysql_query($check_user,$conn);
  if (mysql_num_rows($result)>0) 
  {
  	header('Location: users.php?add_user=fail');
  }
  else
  {
  		$sql = "INSERT INTO user (ufname, ulname, uemail,ucontact, upwd, utype, usts) VALUES ('$fname','$lname','$email','$mobile', '".md5($pwd)."', 'U', 'A') ";
	    $result = mysql_query($sql,$conn);
	    if ($result)
	    {
	      $from = "info@maierp.in";
	      $subject = "Registration successful";
	      $message = " Dear ".$fname." ".$lname.",

	      ".$_SESSION['ufname']." ".$_SESSION['ulname']." has created your account in Reminder App. Please login with your creadentials-

	      "."Username : ".$email."
	      Password : ".$pwd."

	      Download the app from here : https://play.google.com/store/apps/details?id=com.reminder_app.reminder&hl=en

	      ";
	      $mail = mail($email, $subject, $message, "From: $from");
	      header('Location: users.php?add_user=success');
	    }
	    else
	    {
	      header('Location: users.php?add_user=fail');
	    }
  }

  
?>