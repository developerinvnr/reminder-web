<?php 
include "config.php";

 if($_POST['useremail'] == '' || $_POST['password'] == '')
 {
   echo json_encode(array( "status" => "100","msg" => "Parameter missing!") );
 }
 else
 {
   $useremail=$_POST['useremail'];
   $password=md5($_POST['password']);
   $user_token =$_POST['user_token'];
   $result = mysql_query("SELECT * FROM user WHERE (uemail='".$useremail."' OR ucontact='".$useremail."') AND upwd='".$password."'");
   $num=mysql_num_rows($result);
    
      if ($num > 0){

        $sql = mysql_query("UPDATE user SET user_token='".$user_token."', user_varified='Yes' WHERE (uemail='".$useremail."' OR ucontact='".$useremail."')");
        $update_token = mysql_query($sql, $conn);
        $sql2 = mysql_query("SELECT * FROM user WHERE (uemail='".$useremail."' OR ucontact='".$useremail."') AND upwd='".$password."'");
        $res = mysql_fetch_assoc($sql2);

       
        if($res['userid']!=$res['crby'])
		{
		    
		   $result2 = mysql_query("INSERT INTO contact_request (request_by, request_to, request_sent, request_approve, created_at) VALUES 
          ('".$res['userid']."', '".$res['crby']."', '1', '1', '".date("Y-m-d H:i:s")."')",$conn);
		}
       
       
         echo json_encode(array( "code" => "300", "userid" => $res['userid'], "username" => $res['ufname'],  "contact" => $res['ucontact'], "email" => $res['uemail'], "status" => $res['usts'], "utype" =>$res['utype'], "user_varified" =>$res['user_varified'], 'user_token'=>$res['user_token'], "msg" => "Login successfully! Now you can change the password!") ); 

      }else{
           echo json_encode(array( "code" => "100", "msg" => "Invalid username or password!") );
      }
 }


?>
