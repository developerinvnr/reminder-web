<?php
	include "db.php";
	//-------------------Participant Lis---------------------//
	if($_REQUEST['act']=='participant_list'){	
		$rem_id=$_REQUEST['Rem_Id'];
		$participant=$conn->prepare("SELECT r.rem_id,rpu.userid,rpu.ufname FROM reminder r
									JOIN reminder_participants rp ON rp.rem_id = r.rem_id
									JOIN user rpu ON rpu.userid = rp.userid
									
									WHERE r.rem_id='".$rem_id."'");
		$participant->execute();
		$participant_list=$participant->fetchAll();
		if($participant_list!=''){
			echo json_encode(array('participant_list'=>$participant_list));
		}else{
			echo json_encode(array('participant_list'=>'error'));
		} 
	}

	//-------------------------------Insert / Update Rating of the participant---------------------
	if($_REQUEST['act']=='rate'){
		$rem_id=$_REQUEST['Rem_Id'];
		$user_id=$_REQUEST['User_Id'];
		$rate=$_REQUEST['Rate'];
		$query_task=$conn->prepare("SELECT * FROM rating WHERE userid='".$user_id."' AND rem_id='".$rem_id."'");
		$query_task->execute();
		
		$rate_list=$query_task->fetchAll();
		if($rate_list){
			$sql=$conn->prepare("UPDATE rating SET rate='".$rate."' WHERE rem_id='".$rem_id."' AND userid='".$user_id."' ");
		}else{	
		$sql=$conn->prepare("INSERT INTO rating (rem_id,userid,rate)VALUES('$rem_id', '$user_id', '$rate')");
		}
		
		$sql->execute();
		if($sql){
			 echo json_encode(array('msg'=>'Success.','status'=>200));
			}else{
				 echo json_encode(array('msg'=>'Faild','status'=>400));
			}
	}
	//-------------------Close the Task----------------------
	if($_REQUEST['act']=='close_task'){
		$rem_id=$_REQUEST['Rem_Id'];
		$remark=$_REQUEST['Remark'];
		$sql=$conn->prepare("UPDATE reminder SET activity='D', Status='Done',remark='".$remark."' WHERE rem_id='".$rem_id."'");
		$sql->execute();
		if($sql){
			echo json_encode(array('msg'=>'Success.','status'=>200));
			}else{
				 echo json_encode(array('msg'=>'Faild','status'=>400));
			}
		
	}
?>


