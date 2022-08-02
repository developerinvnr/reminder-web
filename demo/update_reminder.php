<?php include('common_function.php'); ?>
<?php
  session_start();
  include "config.php";
  if (!isset($_SESSION['id']))
  {
    header('Location: index.php');
  }

  $page_name = $_POST["page_name"];
  $desc = $_POST["description"];
  $priority = $_POST["priority"];
  $period = $_POST["period"];
  $from_date = date('Y-m-d h:i:s', strtotime($_POST["f_date"]));
  $to_date = date('Y-m-d h:i:s', strtotime($_POST["t_date"]));
  $start_date = date('Y-m-d h:i:s', strtotime($_POST["start_date5"]));
  $uid = $_SESSION['id'];
  $rem_id = $_POST["rem_id"];

  // $hidden_from_date = $_POST["hidden_from_date"];
  // $hidden_end_date = $_POST["hidden_end_date"];
  // $hidden_start_date = $_POST["hidden_start_date"];

  // echo "STARTDATA".$start_date."<br>";

    $delete_old_rem_id_from_notification = "DELETE FROM notification WHERE rem_id='$rem_id' ";
    $delete_query = mysql_query($delete_old_rem_id_from_notification, $conn);

    $delete_old_participants = "DELETE FROM reminder_participants WHERE rem_id='$rem_id' ";
    $delete_query1 = mysql_query($delete_old_participants, $conn);


    if ($delete_query && $delete_query1) 
    {
      $sql1 = "UPDATE reminder SET priority='$priority', description='$desc', from_date='$from_date', to_date='$to_date', start_date='$start_date', modified_by='$uid', period='$period', modified_at='".date('Y-m-d h:i:s')."' WHERE rem_id='$rem_id' ";

      foreach ($_POST["parti"] as $ulist) 
      {
        $sql2 = "INSERT INTO reminder_participants (rem_id, userid) VALUES ('$rem_id','$ulist')";
        $result2 = mysql_query($sql2,$conn);
        /*OTP*/
        $username = "developerinvnr@gmail.com";
        $hash = "736397e8c20036f67d304d4d8ee316720a93c9d9d83046cbb453303194086efa";
        $test = "0";
        $sender = "REMIND";
        $message = "REM : ".get_name($ulist).", an event on date ".date('Y-m-d', strtotime($_POST["f_date"]))." at ".date('h:i A', strtotime($_POST["f_date"])).".";
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
    // die();

    }
  

  $result1 = mysql_query($sql1,$conn);
  // echo $last_id = mysql_insert_id($conn);

  if ($result1)
  {
  // dfsbgdfbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb

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
            $query = "INSERT INTO notification (rem_id, not_time, action) VALUES ('$rem_id', '$new_time' ,'0')";
            $res = mysql_query($query,$conn);

          }
      }
      else if ($period==24) 
      {
          for($i=0; $i<$diff; $i++ )
          {
            $new_time = date("Y-m-d H:i:s", strtotime('+24 hours', strtotime($start_date) ));
            $query = "INSERT INTO notification (rem_id, not_time, action) VALUES ('$rem_id', '$new_time' ,'0')";
            $res = mysql_query($query,$conn);
          }
      }

    if ($page_name=="reports") 
    {
      header('Location: reports.php?update=success');
    }
    elseif ($page_name=="home") 
    {
      header('Location: home.php?pass_update=success');
    }
    else
    {
      header('Location: calendar.php?update=success');
    }
  }
  else
  {
    if ($page_name=="reports") 
    {
      header('Location: reports.php?update=fail');
    }
    elseif ($page_name=="home") 
    {
      header('Location: home.php?pass_update=fail');
    }
    else
    {
      header('Location: calendar.php?update=fail');
    }
  }
?>