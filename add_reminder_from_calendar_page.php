<?php include('common_function.php'); ?>
<?php
  session_start();
  include "config.php";
  if (!isset($_SESSION['id']))
  {
    header('Location: index.php');
  }
  $r_type = $_POST["r_type"];
  $title = $_POST["title"];
  $desc = $_POST["desc"];
  $location = $_POST["location"];
  $r_require = $_POST["r_require"];
  $r_priority = $_POST["r_priority"];
  $from_date = date('Y-m-d H:i', strtotime($_POST["from_date"]));
  $to_date = date('Y-m-d H:i', strtotime($_POST["to_date"]));
  $uid = $_SESSION['id'];
  $par = $_POST["par"];
  $action_id = $_POST["action_id"];
  $start_date = date('Y-m-d H:i', strtotime($_POST["start_date"]));
  $period = $_POST["period"];

  $sql1 = "INSERT INTO reminder (type, title, description, location, rem_req, priority, from_date, to_date, created_by, Status, start_date, period, activity, created_at) VALUES ('$r_type','$title','$desc','$location', '$r_require','$r_priority', '$from_date','$to_date','$uid', 'Pending', '$start_date','$period', 'A', '".date('Y-m-d H:i:a')."' )";
  $result1 = mysql_query($sql1,$conn);
  echo $last_id = mysql_insert_id($conn);

  // dfsbgdfbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb
  
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

        /*Email*/
        // $to = "reminder@vnrseeds.co.in";
        // $txt = "Hello ".get_name($ulist).", an event on date ".date('Y-m-d', strtotime($_POST["from_date"]))." at time ".date('h:i A', strtotime($_POST["from_date"]))." is created. <br> Team Reminder";
        // $subject = "Task Reminder";
        // $headers = "From: ".get_mail($ulist)." ";
        // mail($to,$subject,$txt,$headers);
        /*Email*/

        /*OTP*/
        $username = "developerinvnr@gmail.com";
        $hash = "736397e8c20036f67d304d4d8ee316720a93c9d9d83046cbb453303194086efa";
        $test = "0";
        $sender = "REMIND";
        $message = "REM : ".get_name($ulist).", an event on date ".date('Y-m-d', strtotime($_POST["from_date"]))." at ".date('h:i A', strtotime($_POST["from_date"])).".";
        $message = urlencode($message);
        $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".get_number($ulist)."&test=".$test;
        $ch = curl_init('http://api.textlocal.in/send/?');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch); 
        curl_close($ch);
        /*OTP*/

    }
  }

  foreach ($_POST['action_id'] as $action) 
  {
      $sql3 = "INSERT INTO reminder_task (rem_id, task) VALUES ('$last_id','$action')";
      $result3 = mysql_query($sql3,$conn);
  }

  if ($result1)
  {
    header('Location: calendar.php?reminder=success');
  }
  else
  {
    header('Location: calendar.php?reminder=fail');
  }
?>





