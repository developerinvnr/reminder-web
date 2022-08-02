<?php
include "db.php";
  if($_REQUEST['UserId']!=''){  
    $condition ='';
    if (!empty($_REQUEST['From_Date']) && !empty($_REQUEST['To_Date']))
    {
        $condition .= ' AND (date BETWEEN "'.$_REQUEST['From_Date'].'" AND "'.$_REQUEST['To_Date'].'") ';
    }

     $query_task = $conn->prepare("SELECT * FROM my_notification WHERE userid=$_REQUEST[UserId]" . $condition . "");
        $query_task->execute();
        $notification_list = $query_task->fetchAll();
		if ($notification_list!= '')
        {
            echo json_encode(array(
                "notification_list" => $notification_list,
                'status' => 200
            ));
        }
        else
        {
            echo json_encode(array(
                "notification_list" => 'Reocrd not found.',
                'status' => 400
            ));
        }
	 
 }
 
 if($_REQUEST['add_notification']=='yes'){
	$userid	=	$_REQUEST['userid'];
	$title =	$_REQUEST['title'];
	$date =		$_REQUEST['date'];
	$msg	=	$_REQUEST['msg'];
	
	$query_task=$conn->prepare("INSERT INTO my_notification (userid, title, date, msg) VALUES ('$userid','$title','$date','$msg')");	
//	print_r($query_task);die;
	$query_task->execute();
	if($query_task){
		echo json_encode(array(
                                'msg' => 'New Notification Added Successfully.',
                                'status' => 200
                            ));
	}
	else
                        {
                            echo json_encode(array(
                                'msg' => 'Failed to add new notification.',
                                'status' => 400
                            ));
                        }
 }

?>