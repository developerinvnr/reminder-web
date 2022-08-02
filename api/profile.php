<?php
include "db.php";
  if($_REQUEST['UserId']!=''){
	 $user_profile = $conn->prepare("SELECT * FROM user WHERE userid=$_REQUEST[UserId]");
        $user_profile->execute();
        $user_data = $user_profile->fetchAll();
		if ($user_data != '')
        {
            echo json_encode(array(
                "user_data" => $user_data,
                'status' => 200
            ));
        }
        else
        {
            echo json_encode(array(
                "user_data" => 'Reocrd not found.',
                'status' => 400
            ));
        }
	 
 }
 
 if($_REQUEST['Update_Profile']=='yes'){
	$userid	=	$_REQUEST['userid'];
	$fname	=	$_REQUEST['fname'];
	$lname	=	$_REQUEST['lname'];
	$email	=	$_REQUEST['email'];
	$phone	=	$_REQUEST['phone'];
	$gender	=	$_REQUEST['gender'];
	$dob	=	$_REQUEST['dob'];
	$marital	=	$_REQUEST['marital'];
	$anniversary	=	$_REQUEST['anniversary'];
	$address	=	$_REQUEST['address'];
	
	$query_task = $conn->prepare("SELECT * FROM `user` WHERE ucontact = '$phone' AND userid <> $userid");
	//print_r($query_task);die;
	$query_task->execute();
	$a= $query_task->rowCount();
	
	if( $a > 0){
		echo json_encode(array('msg'=>'Mobile number is already used by another user.','status'=>500));
		die;
	}
	$update_profile = $conn->prepare("UPDATE user SET ufname='$fname',ulname='$lname',uemail='$email',ucontact='$phone',ugender='$gender',udob='$dob',marital_status='$marital',Anniversary='$anniversary',address='$address' WHERE userid=$userid");
	//print_r($update_profile);die;
	$update_profile->execute();
	if($update_profile){
		echo json_encode(array(
                                'msg' => 'User Profile Updated Successfully.',
                                'status' => 200
                            ));
	}
	else
                        {
                            echo json_encode(array(
                                'msg' => 'User Profile Failed Updated.',
                                'status' => 400
                            ));
                        }
 }

?>