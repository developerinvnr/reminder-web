<?php
 include 'db.php';
 if($_REQUEST['add_note']!=''){
	$title=$_REQUEST['Title'];
	$description=$_REQUEST['Description'];
	$create_by=$_REQUEST['UserId'];
	$date=date("Y-m-d h:i:s",strtotime($_REQUEST['Date']));
	$query_task=$conn->prepare("INSERT INTO my_note (title, des, created_by, created_at) VALUES ('$title','$description','$create_by','$date')");	
	$query_task->execute();
	if($query_task){
		echo json_encode(array('msg'=>'Note Created Successfully.','status'=>200));
	}else{
		 echo json_encode(array('msg'=>'Note Creation Faild','status'=>400));
	} 
 }
 
 if($_REQUEST['note_list']!=''){
	$userid=$_REQUEST['UserId'];
	$query_task=$conn->prepare("SELECT * FROM my_note WHERE created_by='".$userid."'");
	$query_task->execute();
	$note_list = $query_task->fetchAll();
	if ($note_list!=''){
		echo json_encode(array("note_list"=>$note_list,'status'=>200));
	}
	else{
		echo json_encode(array("note_list"=>'Reocrd not found.','status'=>400));
	}
 }
 
 
 if($_REQUEST['delete_note']!='')
 {
	 $Note_Id=$_REQUEST['Note_Id'];
	 $query_task=$conn->prepare("DELETE FROM my_note WHERE id='".$Note_Id."'");
	 $query_task->execute();
	 if($query_task){
		 echo json_encode(array('msg'=>'Note Deleted Successfully.','status'=>200));
	}else{
		 echo json_encode(array('msg'=>'Faild to Delete Note','status'=>400));
	 }
 }
?>