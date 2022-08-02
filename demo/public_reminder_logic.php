<?php include('common_function.php'); ?>
<?php
  session_start();
  if (!isset($_SESSION['id']))
  {
    header('Location: index.php');
  }
  include "config.php";
  $r_type = $_POST["r_type"];
  $title = $_POST["title"];
  $desc = $_POST["desc"];
  $location = $_POST["location"];
  $r_require = $_POST["r_require"];
  $r_priority = $_POST["r_priority"];
  $from_date = date('Y-m-d h:i:s', strtotime($_POST["from_date"]));
  $to_date = date('Y-m-d h:i:s', strtotime($_POST["to_date"]));
  $uid = $_SESSION['id'];
  $par = $_POST["par"];
  $action_id = $_POST["action_id"];
  $start_date = date('Y-m-d h:i:s', strtotime($_POST["start_date"]));
  $period = $_POST["period"];

  $sql1 = "INSERT INTO reminder (type, title, description, location, rem_req, priority, from_date, to_date, created_by, Status, start_date, period, activity) VALUES ('$r_type','$title','$desc','$location', '$r_require','$r_priority', '$from_date','$to_date','$uid', 'Pending', '$start_date','$period', 'A' )";
  $result1 = mysql_query($sql1,$conn);
  $last_id = mysql_insert_id($conn);


  // dfsbgdfbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb
 
$datetime1 = new DateTime($start_date);
  $datetime2 = new DateTime($from_date);
  $interval = $datetime1->diff($datetime2);
  $diff = $interval->format('%a');
  $diff_d = $interval->format('%a');
  $diff_h = $interval->format('%h');
  $diff_m = $interval->format('%m');
 
  if($diff_d>=1)
  {
  
    $diff = $diff*24;
    $diff = $diff/$period;
    $new_time = $start_date;
    if ($period==12) 
    { 
      for($i=0; $i<$diff; $i++ )
       { 
		$new_time = date("Y-m-d H:i:s", strtotime('+12 hours', strtotime($new_time) ));

    $sameIns=mysql_num_rows(mysql_query("SELECT * from notification where rem_id='$last_id' and not_time='$new_time' and action='0'"));
    if($sameIns==0){
      $query = "INSERT INTO notification (rem_id, not_time, action) VALUES ('$last_id', '$new_time' ,'0')";
      $res = mysql_query($query,$conn);
    }
		
        }
     }
     //else if ($period==24)
    else
     {
	   for($i=0; $i<$diff; $i++ )
	   {
		$new_time = date("Y-m-d H:i:s", strtotime('+24 hours', strtotime($start_date) ));
		$sameIns=mysql_num_rows(mysql_query("SELECT * from notification where rem_id='$last_id' and not_time='$new_time' and action='0'"));
    if($sameIns==0){
      $query = "INSERT INTO notification (rem_id, not_time, action) VALUES ('$last_id', '$new_time' ,'0')";
      $res = mysql_query($query,$conn);
    }
	   }
     }
     
	 
  }
  elseif($diff_h>=1)
  {
  
    if($diff_h>=1 AND $diff_h<6)
    {
      $newt = date("Y-m-d H:i:s", strtotime('-2 hour', strtotime($_POST["from_date"])));
  	  $new2t = date("Y-m-d H:i:s", strtotime('-4 hour', strtotime($_POST["from_date"])));


      $sameIns=mysql_num_rows(mysql_query("SELECT * from notification where rem_id='$last_id' and not_time='$newt' and action='0'"));
      if($sameIns==0){
        $query = mysql_query("INSERT INTO notification (rem_id, not_time, action) VALUES ('$last_id', '$newt' ,'0')",$conn);
      }

      $sameInst=mysql_num_rows(mysql_query("SELECT * from notification where rem_id='$last_id' and not_time='$new2t' and action='0'"));
      if($sameInst==0){
        $query = mysql_query("INSERT INTO notification (rem_id, not_time, action) VALUES ('$last_id', '$new2t' ,'0')",$conn);
      }


      
    }
    elseif($diff_h>=6 AND $diff_h<12)
    {
      $newt = date("Y-m-d H:i:s", strtotime('-4 hour', strtotime($_POST["from_date"])));
  	  $new2t = date("Y-m-d H:i:s", strtotime('-8 hour', strtotime($_POST["from_date"])));

      $sameIns=mysql_num_rows(mysql_query("SELECT * from notification where rem_id='$last_id' and not_time='$newt' and action='0'"));
      if($sameIns==0){
        $query = mysql_query("INSERT INTO notification (rem_id, not_time, action) VALUES ('$last_id', '$newt' ,'0')",$conn);
      }


      $sameInst=mysql_num_rows(mysql_query("SELECT * from notification where rem_id='$last_id' and not_time='$new2t' and action='0'"));
      if($sameInst==0){
        $query = mysql_query("INSERT INTO notification (rem_id, not_time, action) VALUES ('$last_id', '$new2t' ,'0')",$conn);
      }


      
    }
    elseif($diff_h>=12 AND $diff_h<18)
    {
      $newt = date("Y-m-d H:i:s", strtotime('-6 hour', strtotime($_POST["from_date"])));
      $new2t = date("Y-m-d H:i:s", strtotime('-12 hour', strtotime($_POST["from_date"])));



      $sameIns=mysql_num_rows(mysql_query("SELECT * from notification where rem_id='$last_id' and not_time='$newt' and action='0'"));
      if($sameIns==0){
        $query = mysql_query("INSERT INTO notification (rem_id, not_time, action) VALUES ('$last_id', '$newt' ,'0')",$conn);
      }

      $sameInst=mysql_num_rows(mysql_query("SELECT * from notification where rem_id='$last_id' and not_time='$new2t' and action='0'"));
      if($sameInst==0){
        $query = mysql_query("INSERT INTO notification (rem_id, not_time, action) VALUES ('$last_id', '$new2t' ,'0')",$conn);
      }


      
    }
    elseif($diff_h>=18 AND $diff_h<=24)
    {
      $newt = date("Y-m-d H:i:s", strtotime('-6 hour', strtotime($_POST["from_date"])));
  	  $new2t = date("Y-m-d H:i:s", strtotime('-12 hour', strtotime($_POST["from_date"])));
  	  $new3t = date("Y-m-d H:i:s", strtotime('-18 hour', strtotime($_POST["from_date"])));




      $sameIns=mysql_num_rows(mysql_query("SELECT * from notification where rem_id='$last_id' and not_time='$newt' and action='0'"));
      if($sameIns==0){
        $query = mysql_query("INSERT INTO notification (rem_id, not_time, action) VALUES ('$last_id', '$newt' ,'0')",$conn);
      }

      $sameInst=mysql_num_rows(mysql_query("SELECT * from notification where rem_id='$last_id' and not_time='$new2t' and action='0'"));
      if($sameInst==0){
        $query = mysql_query("INSERT INTO notification (rem_id, not_time, action) VALUES ('$last_id', '$new2t' ,'0')",$conn);
      }

      $sameInsth=mysql_num_rows(mysql_query("SELECT * from notification where rem_id='$last_id' and not_time='$new3t' and action='0'"));
      if($sameInsth==0){
        $query = mysql_query("INSERT INTO notification (rem_id, not_time, action) VALUES ('$last_id', '$new3t' ,'0')",$conn);
      }



    }
  
  }
  elseif($diff_m>=1)
  {
      $newt = date("Y-m-d H:i:s", strtotime('-5 minutes', strtotime($_POST["from_date"])));

      $sameIns=mysql_num_rows(mysql_query("SELECT * from notification where rem_id='$last_id' and not_time='$newt' and action='0'"));
      if($sameIns==0){
        $query = mysql_query("INSERT INTO notification (rem_id, not_time, action) VALUES ('$last_id', '$newt' ,'0')",$conn);
      }
       
  }
  else
  {
      header('Location: public_reminder.php?reminder=success');
  }


/*
 
  $datetime1 = new DateTime($start_date);
  $datetime2 = new DateTime($from_date);
  $interval = $datetime1->diff($datetime2);
  $diff = $interval->format('%a');
  if ($diff==0) 
  {
    $diff=1;
  }
  $diff = $diff*24;
  $diff = $diff/$period;
  $new_time = $start_date;

      if ($period==12) 
      { 
          for($i=0; $i<$diff; $i++ )
          {
            $new_time = date("Y-m-d H:i:s", strtotime('+12 hours', strtotime($new_time) ));
            $query = "INSERT INTO notification (rem_id, not_time, action) VALUES ('$last_id', '$new_time' ,'0')";
            $res = mysql_query($query,$conn);

          }
      }
      else if ($period==24) 
      {
          for($i=0; $i<$diff; $i++ )
          { 
            $new_time = date("Y-m-d H:i:s", strtotime('+24 hours', strtotime($start_date) ));
            $query = "INSERT INTO notification (rem_id, not_time, action) VALUES ('$last_id', '$new_time' ,'0')";
            $res = mysql_query($query,$conn);
          }
      }
      else
      {
        //echo "string";
      }
  */

  // dfsbgdfbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb


  if ($r_type=="Personal") 
  {
      $sql2 = "INSERT INTO reminder_participants (rem_id, userid) VALUES ('$last_id','$uid')";
      $result2 = mysql_query($sql2,$conn);
  }
  else
  { 
    foreach ($_POST['par'] as $ulist) 
    { 
        $sql2 = "INSERT INTO reminder_participants (rem_id, userid) VALUES ('$last_id','$ulist')";
        $result2 = mysql_query($sql2,$conn);


        // Email
        $to = get_mail($ulist);
        $txt = "Hello ".substr($title, 0, 6).", an event on date ".date('d-m-Y', strtotime($_POST["from_date"]))." at time ".date('h:i A', strtotime($_POST["from_date"]))." is created. Team Reminder";
        $subject = "Task Reminder";
        $headers = "From: reminder@vnrseeds.co.in";
        mail($to,$subject,$txt,$headers);
        // Email

        // OTP
        $username = "developerinvnr@gmail.com";
        $hash = "736397e8c20036f67d304d4d8ee316720a93c9d9d83046cbb453303194086efa";
        $test = "0";
        $sender = "REMIND";
        $message = "REM : ".substr($title, 0, 6).", an event on date ".date('d-m-Y', strtotime($_POST["from_date"]))." at ".date('h:i A', strtotime($_POST["from_date"])).".";
        $message = urlencode($message);
        $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".get_number($ulist)."&test=".$test;
        $ch = curl_init('http://api.textlocal.in/send/?');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch); 
        curl_close($ch);
        // OTP

        
    }
  }
  

  foreach ($_POST['action_id'] as $action) 
  {
      $sql3 = "INSERT INTO reminder_task (rem_id, task) VALUES ('$last_id','$action')";
      $result3 = mysql_query($sql3,$conn);
  }

  if ($r_require==1) 
  { 
    if ($result1)
    { 
      header('Location: public_reminder.php?reminder=success');
    }
    
  }
  else
  { 
    if ($result1)
    { 
      header('Location: public_reminder.php?reminder=success');
    }
    else
    { 
      header('Location: public_reminder.php?reminder=fail');
    }
  }
  
  
?>
