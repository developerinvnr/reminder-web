<?php
include 'db.php';
		
if($_REQUEST['UserId']!='' && $_REQUEST['GroupId']!='' && $_REQUEST['Participant_Id']!='')
{                                                                   

 $query_task=$conn->prepare("delete from group_contact where gid=".$_REQUEST['GroupId']);	
 $query_task->execute();
 
 $last_gid = $_REQUEST['GroupId'];
 $participant = $_REQUEST['Participant_Id'];
 $array_data = explode(',',$participant);

 if($query_task)
 {
	$data = '';
	foreach($array_data as $key=> $p_id){
		if($key == 0){
				$data .= "($last_gid,$p_id)";
		}else{
			$data .= ",($last_gid,$p_id)";
		}
	}
	$query_task1 = $conn->prepare("INSERT INTO group_contact(gid,userid) VALUES $data");
	$query_task1->execute();
	if($query_task1){
	 echo json_encode(array('msg'=>'Group Updated Successfully.','status'=>300));
	}else{
		 echo json_encode(array('msg'=>'Group updation Faild','status'=>100));
	}
 }
}
?>
