<?php
include "config.php";
include "add_task_notification.php";

if(isset($_REQUEST['otp']) and isset($_REQUEST['email']))
{

    $email = $_REQUEST['email'];
    $otp = $_REQUEST["otp"];
    $r = mysql_query("SELECT * FROM user WHERE otp='$otp' AND (uemail='$email' OR ucontact='$email') ");

    if(mysql_num_rows($r)>0)
    {
        
      $row = mysql_fetch_assoc($r);
      $mobile = $row['ucontact'];
      $uname = $row['ufname'];
      $uemail = $row['uemail'];
      $user_token = $row['user_token'];
    
      $sql = "UPDATE user SET otp_varified=1 WHERE (ucontact='$email' OR uemail='$email') ";  
      $result = mysql_query($sql);
      
      if($mobile!='')     
      {
       /************ Firbase *******************/
       $user_token=[];
       $user_token[] = $user_token;
       $data1['subject'] = "REMVNR";
       $data1['msg_body'] = "Dear $uname, Your OTP is Verified, Please reset your password ";
	   android($data1,$user_token);
	  /************ Firbase *******************/
      }     
      
      if($uemail!='')     
      {
        $from = "reminder@vnrseeds.co.in";
	    $uemail = $uemail;
        $subject = "REMVNR - OTP Verified";
        $message = "Dear $uname, Your OTP is Verified, Please reset your password";
        $mail = mail($uemail, $subject, $message, "From: ".$from);
      }
      
      
       /************************************/
       	// Account details
	    $apiKey = urlencode('n41ZZY/VUcc-VpNsm9ZokZI2TGecZvk2WYLFvK73Ox
');
	
      	// Message details
	    $numbers = array($mobile);
	    $sender = urlencode('REMVNR');
	    $message = "Dear $uname, Your OTP is Verified, Please reset your password -vnr";
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
        $username = "developerinvnr@gmail.com";
        $hash = "736397e8c20036f67d304d4d8ee316720a93c9d9d83046cbb453303194086efa";
        $test = "0";
        $sender = "REMVNR";
           
        $message = "Dear $uname, Your OTP is Verified, Please reset your password -vnr";
        $message = urlencode($message);
        $data = "username=" . $username . "&hash=" . $hash . "&message=" . $message . "&sender=" . $sender . "&numbers=" . $mobile . "&test=" . $test;
        $ch = curl_init('http://api.textlocal.in/send/?');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
       */ 
        /*
        $Dlink="https://play.google.com/store/apps/details?id=in.co.vnrseeds.www.reminder";
$message2 = "Reminder apps download link : ".$Dlink." vnr";
$message2 = urlencode($message2);
$data1 = "username=".$username."&hash=".$hash."&message=".$message2."&sender=".$sender."&numbers=".$mobile."&test=".$test;
$ch1 = curl_init('http://api.textlocal.in/send/?');
curl_setopt($ch1, CURLOPT_POST, true);
curl_setopt($ch1, CURLOPT_POSTFIELDS, $data1);
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch1); 
curl_close($ch1);*/
        
      
      
      echo json_encode(array("code" => "300", "msg" => "Please reset your password!"
        ));
    }
    else
    {
      echo json_encode(array("code" => "100","msg" => "Somthing went wrong!"));
    }
}

else if(isset($_REQUEST['pwd']) and isset($_REQUEST['email']))
{

    $email = $_REQUEST['email'];
    $pwd = md5($_REQUEST['pwd']);
    $sql = "UPDATE user SET upwd='$pwd' WHERE (ucontact='$email' OR uemail='$email') ";
    $result = mysql_query($sql);

    if($result)
    {
       $r = mysql_query("SELECT * FROM user WHERE otp='$otp' AND (uemail='$email' OR ucontact='$email') ");
       $row = mysql_fetch_assoc($r);
       $mobile = $row['ucontact'];
       $uname = $row['ufname'];
       $uemail = $row['uemail'];
       $user_token = $row['user_token']; 
        
       
       if($mobile!='')     
       {
        /************ Firbase *******************/
        $user_token=[];
        $user_token[] = $user_token;
        $data1['subject'] = "REMVNR";
        $data1['msg_body'] = "Dear $uname, you have successfully reset your password. Pls Re-login again";
	    android($data1,$user_token);
	   /************ Firbase *******************/
       }     
      
      if($uemail!='')     
      {
        $from = "reminder@vnrseeds.co.in";
	    $uemail = $uemail;
        $subject = "REMVNR - Reset Password";
        $message = "Dear $uname, you have successfully reset your password. Pls Re-login again";
        $mail = mail($uemail, $subject, $message, "From: ".$from);
      }
      
       /************************************/
       	// Account details
	    $apiKey = urlencode('n41ZZY/VUcc-VpNsm9ZokZI2TGecZvk2WYLFvK73Ox
');
	
      	// Message details
	    $numbers = array($mobile);
	    $sender = urlencode('REMVNR');
	    $message = "Dear $uname, you have successfully reset your password. Pls Re-login again -vnr";
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
        $username = "developerinvnr@gmail.com";
        $hash = "736397e8c20036f67d304d4d8ee316720a93c9d9d83046cbb453303194086efa";
        $test = "0";
        $sender = "REMVNR";
           
        $message = "Dear $uname, you have successfully reset your password. Pls Re-login again -vnr";
        $message = urlencode($message);
        $data = "username=" . $username . "&hash=" . $hash . "&message=" . $message . "&sender=" . $sender . "&numbers=" . $mobile . "&test=" . $test;
        $ch = curl_init('http://api.textlocal.in/send/?');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
      */    
        /*
        $Dlink="https://play.google.com/store/apps/details?id=in.co.vnrseeds.www.reminder";
$message2 = "Reminder apps download link : ".$Dlink." vnr";
$message2 = urlencode($message2);
$data1 = "username=".$username."&hash=".$hash."&message=".$message2."&sender=".$sender."&numbers=".$mobile."&test=".$test;
$ch1 = curl_init('http://api.textlocal.in/send/?');
curl_setopt($ch1, CURLOPT_POST, true);
curl_setopt($ch1, CURLOPT_POSTFIELDS, $data1);
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch1); 
curl_close($ch1);*/
        
        
       echo json_encode(array("code" => "300","msg" => "Password reset successfully!"));
       
    }
    else
    {
        
        echo json_encode(array("code" => "100","msg" => "Somthing went wrong"));
        
    }

}

else if(isset($_REQUEST['email']))
{

 $email = $_REQUEST['email'];
 
 $sql = "SELECT * FROM user WHERE (ucontact='$email' OR uemail='$email')";
 $result = mysql_query($sql);

 if(mysql_num_rows($result) > 0)
 {
   $row = mysql_fetch_assoc($result);
   $mobile = $row['ucontact'];
   $uname = $row['ufname'];
   $uemail = $row['uemail'];
   $user_token = $row['user_token'];
   
   $otp = rand(11111, 99999);
   $sql = "UPDATE user SET otp=$otp WHERE (ucontact='$email' OR uemail='$email') ";
   $result = mysql_query($sql, $conn);
   if($result)
   {
           
      if($mobile>0 || $email>0)     
      {
       /************ Firbase *******************/
       $user_token=[];
       $user_token[] = $user_token;
       $data1['subject'] = 'REMVNR';
       $data1['msg_body'] = "Dear $uname, Your OTP for reset password is $otp";
	   android($data1,$user_token);
	  /************ Firbase *******************/
      }     
      
      if($uemail!='' || $email!='')     
      {
        $from = "reminder@vnrseeds.co.in";
	    $uemail = $uemail;
        $subject = "REMVNR - Reset Password";
        $message = "Dear $uname, Your OTP for reset password is $otp";
        $mail = mail($uemail, $subject, $message, "From: ".$from);
      }
      
        /************************************/
       	// Account details
	    $apiKey = urlencode('n41ZZY/VUcc-VpNsm9ZokZI2TGecZvk2WYLFvK73Ox
');
	
      	// Message details
	    $numbers = array($mobile);
	    $sender = urlencode('REMVNR');
	    $message = "Dear $uname, Your OTP for reset password is $otp -vnr";
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
        $username = "developerinvnr@gmail.com";
        $hash = "736397e8c20036f67d304d4d8ee316720a93c9d9d83046cbb453303194086efa";
        $test = "0";
        $sender = "REMVNR";
           
        $message = "Dear $uname, Your OTP for reset password is $otp -vnr";
        $message = urlencode($message);
        $data = "username=" . $username . "&hash=" . $hash . "&message=" . $message . "&sender=" . $sender . "&numbers=" . $mobile . "&test=" . $test;
        $ch = curl_init('http://api.textlocal.in/send/?');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        */
        
        /*
        $Dlink="https://play.google.com/store/apps/details?id=in.co.vnrseeds.www.reminder";
$message2 = "Reminder apps download link : ".$Dlink." vnr";
$message2 = urlencode($message2);
$data1 = "username=".$username."&hash=".$hash."&message=".$message2."&sender=".$sender."&numbers=".$mobile."&test=".$test;
$ch1 = curl_init('http://api.textlocal.in/send/?');
curl_setopt($ch1, CURLOPT_POST, true);
curl_setopt($ch1, CURLOPT_POSTFIELDS, $data1);
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch1); 
curl_close($ch1);*/

             
      
      
        echo json_encode(array("code" => "300", "otp" => $otp, "msg" => "Otp sent to your mobile no.!"));
   
       
    }

  }

}


?>