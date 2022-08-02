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
  
  
  $fname = $_REQUEST["fname"];
  if($_REQUEST["lname"]!=''){$lname = $_REQUEST["lname"];}else{$lname='';}
  if($_REQUEST["email"]!==''){$email = $_REQUEST["email"];}else{$email='';}
  //$lname = $_POST["lname"];
  //$email = $_POST["email"];
  $mobile = $_REQUEST["mobile"];
  $crby = $_REQUEST["CrBy"];
  $pwd = rand(11111,99999);
  
  $strMob1=substr($mobile, 0, 1);
  $strMob1a=substr($mobile, 1, 10);
  
  $strMob3=substr($mobile, 0, 3);
  $strMob3a=substr($mobile, 3, 12);
  
  if($strMob1=='0'){ $mobile=$strMob1a; }
  elseif($strMob3=='+91'){ $mobile=$strMob3a; }
  
  //die();

  if($crby==''){ $crby=0; }

  $check_user = "SELECT * FROM user WHERE (uemail='$mobile' OR ucontact='$mobile') ";
  $result = mysql_query($check_user,$conn);
  
  if(mysql_num_rows($result)>0) 
  {
	$rId=mysql_fetch_assoc($result);
  	$insert = "INSERT INTO contact_request(request_by, request_to, request_sent, request_approve) VALUES ('".$crby."', '".$rId['userid']."', 1, 0)";
    $res = mysql_query($insert, $conn);
    if($res) 
    {
	 
	 $username = "developerinvnr@gmail.com";
	 $hash = "736397e8c20036f67d304d4d8ee316720a93c9d9d83046cbb453303194086efa";
	 $test = "0";
	 $sender = "REMVNR";
	 $message = get_name($crby)." sent you contact request From Reminder App. For any action please go to Reminder App. -vnr";
	 $message = urlencode($message);
	 $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".get_number($rId['userid'])."&test=".$test;
	 $ch = curl_init('http://api.textlocal.in/send/?');
	 curl_setopt($ch, CURLOPT_POST, true);
	 curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	 $result = curl_exec($ch); 
	 curl_close($ch);
	
  	 echo json_encode(array( "code" => "300", "msg" => "Request sent successfully!") );
    }
    
  }
  else
  {
  		$sql = "INSERT INTO user (ufname, ulname, uemail, ucontact, upwd, utype, usts, crby) VALUES ('$fname','$lname','$email','$mobile', '".md5($pwd)."', 'U', 'A', '".$crby."') ";
	    $result = mysql_query($sql,$conn);
	    if($result)
	    {
	        
	        $sId=mysql_query("select userid from user where ucontact='".$mobile."'",$conn);
	        $rId=mysql_fetch_assoc($sId);
	        
	        $sql = "INSERT INTO contact_request (request_by, request_to, request_sent, request_approve, created_at) VALUES 
          ('".$crby."', '".$rId['userid']."', '1', '1', '".date("Y-m-d H:i:s")."') ";
	        $result2 = mysql_query($sql,$conn);
	        
	        
	        $sU = mysql_query("SELECT ufname,ulname FROM user WHERE userid='".$crby."'",$conn); $rU=mysql_fetch_assoc($sU);
           
        
        $username = "developerinvnr@gmail.com";
        $hash = "736397e8c20036f67d304d4d8ee316720a93c9d9d83046cbb453303194086efa";
        $test = "0";
        $sender = "REMVNR";
    
        $message ="Dear $fname, your Reminder Account is Successfully Created by '".$rU['ufname']."'. Please login with the bellow credentials- Username: $mobile Password: $pwd - vnr";
      
        $message = urlencode($message);
        $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$mobile."&test=".$test;
        $ch = curl_init('http://api.textlocal.in/send/?');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result1 = curl_exec($ch); 
        curl_close($ch);
        
        
          $from = "info@reminder";
	      $subject = "Registration successful";
	      $message = " Dear ".$fname." ".$lname;

          if($_SESSION['ufname']!='')
          {
             $message = "".$_SESSION['ufname']." ".$_SESSION['ulname']." has created your account in Reminder App. Please login with your creadentials"; 
          }
          else
          {
              
            $message = "".$rU['ufname']." ".$rU['ulname']." has created your account in Reminder App. Please login with your creadentials";  
          }

	      $message .= " Username : ".$email." Password : ".$pwd."
	      
	      Download the app from here : https://play.google.com/store/apps/details?id=in.co.vnrseeds.www.reminder

	      ";
	      $mail = mail($email, $subject, $message, "From: $from");

        echo json_encode(array( "code" => "300","msg" => "The user registered successfully") );
        
        

	    }
	    else
	    {
          echo json_encode(array( "code" => "100", "msg" => "There is some problem in your request! please try again later!!") );
          die();
	    }
  }
?>













<?php /*
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
  
  $fname = $_REQUEST["fname"];
  if($_REQUEST["lname"]!=''){$lname = $_REQUEST["lname"];}else{$lname='';}
  if($_REQUEST["email"]!==''){$email = $_REQUEST["email"];}else{$email='';}
  //$lname = $_POST["lname"];
  //$email = $_POST["email"];
  $mobile = $_REQUEST["mobile"];
  $crby = $_REQUEST["CrBy"];
  $pwd = rand(11111,99999);
  
  $strMob1=substr($mobile, 0, 1);
  $strMob1a=substr($mobile, 1, 10);
  
  $strMob3=substr($mobile, 0, 3);
  $strMob3a=substr($mobile, 3, 12);
  
  if($strMob1=='0'){ $mobile=$strMob1a; }
  elseif($strMob3=='+91'){ $mobile=$strMob3a; }

  if($crby==''){ $crby=0; }

  $check_user = "SELECT * FROM user WHERE (uemail='$mobile' OR ucontact='$mobile') ";
  $result = mysql_query($check_user,$conn);
  if (mysql_num_rows($result)>0) 
  {
  	    
  	    
    $rId=mysql_fetch_assoc($result);
  	$insert = "INSERT INTO contact_request(request_by, request_to, request_sent, request_approve) VALUES ('".$crby."', '".$rId['userid']."', 1, 0)";
    $res = mysql_query($insert, $conn);
    if($res) 
    {
	 
	 $username = "developerinvnr@gmail.com";
	 $hash = "736397e8c20036f67d304d4d8ee316720a93c9d9d83046cbb453303194086efa";
	 $test = "0";
	 $sender = "REMVNR";
	 $message = " ".get_name($crby)." sent you contact request From Reminder App. For any action please go to Reminder App. -vnr";
	 $message = urlencode($message);
	 $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".get_number($rId['userid'])."&test=".$test;
	 $ch = curl_init('http://api.textlocal.in/send/?');
	 curl_setopt($ch, CURLOPT_POST, true);
	 curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	 $result = curl_exec($ch); 
	 curl_close($ch);
	
  	 echo json_encode(array( "code" => "300", "msg" => "Request sent successfully!") );
    }
  	    
  	    
  }
  else
  {
  		$sql = "INSERT INTO user (ufname, ulname, uemail, ucontact, upwd, utype, usts, crby) VALUES ('$fname','$lname','$email','$mobile', '".md5($pwd)."', 'U', 'A', '".$crby."') ";
	    $result = mysql_query($sql,$conn);
	    if ($result)
	    {
	        
	        $sId=mysql_query("select userid from user where uemail='".$email."' and ucontact='".$mobile."'",$conn);
	        $rId=mysql_fetch_assoc($sId);
	        
	        $sql = "INSERT INTO contact_request (request_by, request_to, request_sent, request_approve, created_at) VALUES 
          ('".$crby."', '".$rId['userid']."', '1', '1', '".date("Y-m-d H:i:s")."') ";
	        $result2 = mysql_query($sql,$conn);
	        
	        
	        $sU = mysql_query("SELECT ufname,ulname FROM user WHERE userid='".$crby."'",$conn); $rU=mysql_fetch_assoc($sU);
           
        
        $username = "developerinvnr@gmail.com";
        $hash = "736397e8c20036f67d304d4d8ee316720a93c9d9d83046cbb453303194086efa";
        $test = "0";
        $sender = "REMVNR";
    
        $message ="Dear $fname, your Reminder Account is Successfully Created by '".$rU['ufname']."'. Please login with the bellow credentials- Username: $mobile Password: $pwd - vnr";
      
        $message = urlencode($message);
        $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$mobile."&test=".$test;
        $ch = curl_init('http://api.textlocal.in/send/?');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result1 = curl_exec($ch); 
        curl_close($ch);
        
        
          $from = "info@reminder";
	      $subject = "Registration successful";
	      $message = " Dear ".$fname." ".$lname;

          if($_SESSION['ufname']!='')
          {
             $message = "".$_SESSION['ufname']." ".$_SESSION['ulname']." has created your account in Reminder App. Please login with your creadentials"; 
          }
          else
          {
              
            $message = "".$rU['ufname']." ".$rU['ulname']." has created your account in Reminder App. Please login with your creadentials";  
          }

	      $message .= " Username : ".$email." Password : ".$pwd."
	      
	      Download the app from here : https://play.google.com/store/apps/details?id=in.co.vnrseeds.www.reminder

	      ";
	      $mail = mail($email, $subject, $message, "From: $from");

        echo json_encode(array( "code" => "300","msg" => "The user registered successfully") );
        

	    }
	    else
	    {
          echo json_encode(array( "code" => "100", "msg" => "There is some problem in your request! please try again later!!") );
          die();
	    }
  }
  */
?>