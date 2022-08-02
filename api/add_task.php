<?php
include "config.php";
include "add_task_notification.php";
if($_REQUEST['UserId']!= '' || $_REQUEST['Type']!= '' || $_REQUEST['FromDate']!= '')
{

 $Type=$_REQUEST['Type'];
 $Tital=$_REQUEST['Tital'];
 $Description=$_REQUEST['Description'];
 $FromDate=date("Y-m-d h:i:s",strtotime($_REQUEST['FromDate']));
 $ToDate=date("Y-m-d h:i:s",strtotime($_REQUEST['ToDate']));
 $Group=$_REQUEST['Group']; //number of group: id
 $User=$_REQUEST['User']; //Number of user:id
 if($_REQUEST['Reminder_Require']=='Y'){ $Reminder_Require=1; }else{ $Reminder_Require=0; }
 $StartDate=date("Y-m-d h:i:s",strtotime($_REQUEST['StartDate']));
 if($_REQUEST['Interval']=='Once a day'){$Int=24;}
 elseif($_REQUEST['Interval']=='Twice a day'){$Int=12;}
 elseif($_REQUEST['Interval']=='Thrice a day'){$Int=8;}
 else{$Int=0;}

 //$Interval=$_REQUEST['Interval']; //Number or value same v
 $Priority=$_REQUEST['Priority'];
 $Location=$_REQUEST['Location'];
 $Task=$_REQUEST['Task'];
 $UserId=$_REQUEST['UserId'];
 $PhoneContact =$_REQUEST['Phone_Contact'];
 $Mobile = $_REQUEST['Mobile'];
 $Person =$_REQUEST['Person_Name'];
 
 $Task_File='';
 if(isset($_FILES['task_img']))
 {
    
	
	//$RCImg = base64_decode($_REQUEST['RCImg']);
    $Task_File='task_'.$UserId.'_'.date("dmyHis").'.jpg';
    move_uploaded_file($_FILES['task_img']['tmp_name'],"up_img/".$Task_File);
 }
 
 $ins = "INSERT INTO reminder (type, title, description, location, rem_req, priority, from_date, to_date, created_by, task_img, Status, start_date, period, activity) VALUES ('".$Type."','".$Tital."','".$Description."','".$Location."', '".$Reminder_Require."','".$Priority."', '".$FromDate."','".$ToDate."','".$UserId."', '".$Task_File."', 'Pending', '".$StartDate."','".$Int."', 'A')";
//echo json_encode(array('msg'=>$ins));die;
 $result1 = mysql_query($ins,$conn);
 $last_id = mysql_insert_id($conn);

 if($ins)
 {
 
  if ($Type=="Personal") 
  {
      $sql2 = "INSERT INTO reminder_participants (rem_id, userid) VALUES ('$last_id','$UserId')";
      $result2 = mysql_query($sql2,$conn);
  }
  else
  { 
    if($PhoneContact=='Y'){
        $str ="SELECT ufname FROM user WHERE userid=$UserId";
        $created_by =mysql_query($str,$conn);
        $row=mysql_fetch_assoc($created_by);
        $created_by_name=$row['ufname'];

        $search_detail = explode(',',$Mobile);
        $person =explode(',',$Person);
        foreach ($search_detail as $key1=>$row) {
            # code...
            /* $search = "SELECT * FROM user WHERE ucontact=$row";
            $search_result =mysql_query($search,$conn); */

            $r = mysql_query("SELECT * FROM user WHERE ucontact=$row");
            if (mysql_num_rows($r)>0) {

            
               
                $u_id =$r['userid'];
                $ufname =$r['ufname'];
                $ulname =$r['ulname'];
                $uemail =$r['uemail'];
                $sql1 ="INSERT INTO reminder_participants(rem_id,userid)VALUES($last_id,$u_id)";
                $query1=mysql_query($sql1,$conn);
                if($query1){
                    $from = "info@maierp.in";
                    $subject = "New Task In Reminder";
                    $message = " Dear ".$ufname." ".$ulname.", A new task is assigned to you by ".$created_by_name." in Reminder.Download the app from here : https://play.google.com/store/apps/details?id=in.co.vnrseeds.www.reminder";
                    $mail = mail($uemail, $subject, $message, "From: $from");

                    $username = "developerinvnr@gmail.com";
                    
        /************************************/
       	// Account details
	    $apiKey = urlencode('n41ZZY/VUcc-VpNsm9ZokZI2TGecZvk2WYLFvK73Ox
');
	
      	// Message details
	    $numbers = array($row);
	    $sender = urlencode('REMVNR');
	    $message = "A new task is assigned to you by $created_by_name in Reminder. Download the app from here: https://play.google.com/store/apps/details?id=in.co.vnrseeds.www.reminder - vnr";
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
                    
                    $message = "A new task is assigned to you by $created_by_name in Reminder. Download the app from here: https://play.google.com/store/apps/details?id=in.co.vnrseeds.www.reminder - vnr";
                  
                  
                    $message = urlencode($message);
                    $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$row."&test=".$test;
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
	    $numbers = array($row);
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
                    $Dlink="https://play.google.com/store/apps/details?id=in.co.vnrseeds.www.reminder";
                    $message2 = "Reminder apps download link : ".$Dlink." vnr";
                    $message2 = urlencode($message2);
                    $data1 = "username=".$username."&hash=".$hash."&message=".$message2."&sender=".$sender."&numbers=".$row."&test=".$test;
                    $ch1 = curl_init('http://api.textlocal.in/send/?');
                    curl_setopt($ch1, CURLOPT_POST, true);
                    curl_setopt($ch1, CURLOPT_POSTFIELDS, $data1);
                    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
                    $result = curl_exec($ch1); 
                    curl_close($ch1); 
                    */
                }
            }else{
               
                      foreach ($person as $key2 => $p) {
                        if($key1==$key2){
                            $pwd = rand(11111,99999);
                            $surname ='Ji';
                            $sql = "INSERT INTO user (ufname,ucontact, upwd, utype, usts) VALUES ('$p','$row', '".md5($pwd)."', 'U', 'A') ";
                            $result = mysql_query($sql,$conn);
                            if ($result)
                            {
                                $username = "developerinvnr@gmail.com";
        /************************************/
       	// Account details
	    $apiKey = urlencode('n41ZZY/VUcc-VpNsm9ZokZI2TGecZvk2WYLFvK73Ox
');
	
      	// Message details
	    $numbers = array($row);
	    $sender = urlencode('REMVNR');
	    $message =  "Dear $p, your Reminder Account is Successfully Created by $created_by_name. Please login with the bellow credentials- Username: $row Password: $pwd - vnr";
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
                                $message =  "Dear $p, your Reminder Account is Successfully Created by $created_by_name. Please login with the bellow credentials- Username: $row Password: $pwd - vnr";
                                $message = urlencode($message);
                                $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$row."&test=".$test;
                                $ch = curl_init('http://api.textlocal.in/send/?');
                                curl_setopt($ch, CURLOPT_POST, true);
                                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                $result1 = curl_exec($ch); 
                                curl_close($ch);
                                */
                                
        $Dlink="https://play.google.com/store/apps/details?id=in.co.vnrseeds.www.reminder";
        /************************************/
       	// Account details
	    $apiKey = urlencode('n41ZZY/VUcc-VpNsm9ZokZI2TGecZvk2WYLFvK73Ox
');
	
      	// Message details
	    $numbers = array($row);
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
                                $link="https://play.google.com/store/apps/details?id=in.co.vnrseeds.www.reminder";
                                $message2 =  "Reminder apps download link : ".$link." vnr";
                                $message2 = urlencode($message2);
                                $data2 = "username=".$username."&hash=".$hash."&message=".$message2."&sender=".$sender."&numbers=".$row."&test=".$test;
                                $ch = curl_init('http://api.textlocal.in/send/?');
                                curl_setopt($ch, CURLOPT_POST, true);
                                curl_setopt($ch, CURLOPT_POSTFIELDS, $data2);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                $result1 = curl_exec($ch); 
                                curl_close($ch);
                                */
                                
                                
                                
                                
                                
                                if($result1){
                                    $username = "developerinvnr@gmail.com";
                                    
        /************************************/
       	// Account details
	    $apiKey = urlencode('n41ZZY/VUcc-VpNsm9ZokZI2TGecZvk2WYLFvK73Ox
');
	
      	// Message details
	    $numbers = array($row);
	    $sender = urlencode('REMVNR');
	    $message = "A new task is assigned to you by $created_by_name in Reminder. Download the app from here: https://play.google.com/store/apps/details?id=in.co.vnrseeds.www.reminder - vnr";
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
                                    $message = "A new task is assigned to you by $created_by_name in Reminder. Download the app from here: https://play.google.com/store/apps/details?id=in.co.vnrseeds.www.reminder - vnr";
                                    $message = urlencode($message);
                                    $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$row."&test=".$test;
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
	    $numbers = array($row);
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
                    $data1 = "username=".$username."&hash=".$hash."&message=".$message2."&sender=".$sender."&numbers=".$row."&test=".$test;
                    $ch1 = curl_init('http://api.textlocal.in/send/?');
                    curl_setopt($ch1, CURLOPT_POST, true);
                    curl_setopt($ch1, CURLOPT_POSTFIELDS, $data1);
                    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
                    $result = curl_exec($ch1); 
                    curl_close($ch1); 
                    */               
                                    
                                }

                                $search = "SELECT * FROM user WHERE ucontact=$row";
                                $search_result =mysql_query($search,$conn);
                                $r =mysql_fetch_assoc($search_result);
                                $u_id =$r['userid'];
                                $sql1 ="INSERT INTO reminder_participants(rem_id,userid)VALUES($last_id,$u_id)";
                                $query1=mysql_query($sql1,$conn);
                    
                            }
                        }
                      }
               




/*              $username = "developerinvnr@gmail.com";
                $hash = "736397e8c20036f67d304d4d8ee316720a93c9d9d83046cbb453303194086efa";
                $test = "0";
                $sender = "REMIND";
                $message = "A New Task is assigned to you by $created_by_name in Reminder. Download the app from here : https://play.google.com/store/apps/details?id=in.co.vnrseeds.www.reminder";
              
              
                $message = urlencode($message);
                $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$row."&test=".$test;
                $ch = curl_init('http://api.textlocal.in/send/?');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $result = curl_exec($ch); 
                curl_close($ch); */
            }
           
        }
    }
    
    $array_data = explode(',', $User);
    $data = '';
    foreach ($array_data as $key => $p_id)
    {
        if ($key == 0)
        {
            $data .= "($last_id,$p_id)";
        }
        else
        {
            $data .= ",($last_id,$p_id)";
        }
    }
    $sql2 = "INSERT INTO reminder_participants(rem_id,userid)VALUES $data";

    $result2 = mysql_query($sql2,$conn);
    $get_token = "SELECT user_token FROM user WHERE userid IN(".$User.")";
    $get_token_result = mysql_query($get_token, $conn);

    $user_token=[];
    while($row = mysql_fetch_array($get_token_result, MYSQL_ASSOC)){
       $user_token[] = $row['user_token'];
    }
    $data1['subject'] = $Tital;
    $data1['msg_body'] =  $Description.'   start Date '.$FromDate.'   End Date'.$ToDate.'';            
    android($data1,$user_token); 

  }
  

  foreach ($Task as $action) 
  {
      $sql3 = "INSERT INTO reminder_task (rem_id, task) VALUES ('$last_id','$action')";
      $result3 = mysql_query($sql3,$conn);
  }
  
  if($result1!='')
  {
   echo json_encode(array( "code" => "300","msg" => "Task add successfully") );
  }
  else
  {
   echo json_encode(array( "code" => "100", "msg" => "There is some problem in your request! please try again later!!1") );
  }
 
 }
 
 
} 
else
{
 echo json_encode(array( "code" => "100", "msg" => "There is some problem in your request! please try again later..!2") );
}
    
?>