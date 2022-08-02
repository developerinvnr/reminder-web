<?php
include "db.php";
if($_REQUEST['UserId']!= '')
{
 
 if($_REQUEST['Task_Status']!= '')
 {
        
  if($_REQUEST['Task']=='MyTask')
  {
  
    if($_REQUEST['Task_Status'] == 'Pending')
    {
     $query_task = $conn->prepare("SELECT r.*,u.ufname FROM reminder r join user u ON u.userid = r.created_by JOIN reminder_participants rp ON rp.rem_id = r.rem_id JOIN user rpu ON rpu.userid = rp.userid WHERE r.Status='".$_REQUEST['Task_Status']."' AND (r.created_by='".$_REQUEST['UserId']."' OR rp.userid='".$_REQUEST['UserId']."') AND rp.farward_userid=0 AND r.type='Personal' AND r.activity!='De' AND r.activity!='D' AND r.to_date>='".date("Y-m-d")."' GROUP BY r.rem_id order by r.from_date desc");
    }
    elseif($_REQUEST['Task_Status'] == 'Done')
    {
     $query_task = $conn->prepare("SELECT r.*,u.ufname FROM reminder r join user u ON u.userid = r.created_by JOIN reminder_participants rp ON rp.rem_id = r.rem_id JOIN user rpu ON rpu.userid = rp.userid WHERE r.Status='".$_REQUEST['Task_Status']."' AND (r.created_by='".$_REQUEST['UserId']."' OR rp.userid='".$_REQUEST['UserId']."') AND rp.farward_userid=0 AND r.type='Personal' AND r.activity!='De' AND r.activity!='D' AND r.to_date>='".date("Y-m-d")."' GROUP BY r.rem_id order by r.from_date desc");
    }
    elseif($_REQUEST['Task_Status'] == 'Delegate')
    {
     $query_task = $conn->prepare("SELECT r.*,u.ufname,u2.ufname as forward_name FROM reminder r join user u ON u.userid = r.created_by LEFT JOIN reminder_participants rp ON rp.rem_id = r.rem_id LEFT JOIN user rpu ON rpu.userid = rp.userid LEFT JOIN user u2 ON rp.farward_userid = u2.userid WHERE (r.Status='Pending' OR r.Status='Done') AND rp.userid='".$_REQUEST['UserId']."' AND rp.farward_userid>0 AND r.type='Personal' AND r.activity!='De' AND r.activity!='D' AND r.to_date>='".date("Y-m-d")."' GROUP BY r.rem_id order by r.from_date desc");
    }
	elseif($_REQUEST['Task_Status'] == 'DeadlineCrossed')
    {
        
     $query_task = $conn->prepare("SELECT r.*,u.ufname FROM reminder r join user u ON u.userid = r.created_by JOIN reminder_participants rp ON rp.rem_id = r.rem_id JOIN user rpu ON rpu.userid = rp.userid WHERE r.Status='Pending' AND r.created_by='".$_REQUEST['UserId']."' AND r.type='Personal' AND r.activity!='De' AND r.activity!='D' AND r.to_date<'".date("Y-m-d")."' GROUP BY r.rem_id order by r.from_date desc");
    }

  }
  elseif($_REQUEST['Task']=='GroupTask')
  {
  
    if($_REQUEST['Task_Status'] == 'Pending')
    {
     $query_task = $conn->prepare("SELECT r.*,u.ufname FROM reminder r join user u ON u.userid = r.created_by JOIN reminder_participants rp ON rp.rem_id = r.rem_id JOIN user rpu ON rpu.userid = rp.userid WHERE r.Status='".$_REQUEST['Task_Status']."' AND (r.created_by='".$_REQUEST['UserId']."' OR rp.userid='".$_REQUEST['UserId']."' OR rp.farward_userid='".$_REQUEST['UserId']."') AND r.type!='Personal' AND r.activity!='De' AND r.activity!='D' AND r.to_date>='".date("Y-m-d")."' GROUP BY r.rem_id order by r.from_date desc"); //AND rp.farward_userid=0
     
    }
    elseif($_REQUEST['Task_Status'] == 'Done')
    {
     $query_task = $conn->prepare("SELECT r.*,u.ufname FROM reminder r join user u ON u.userid = r.created_by JOIN reminder_participants rp ON rp.rem_id = r.rem_id JOIN user rpu ON rpu.userid = rp.userid WHERE r.Status='".$_REQUEST['Task_Status']."' AND (r.created_by='".$_REQUEST['UserId']."' OR rp.userid='".$_REQUEST['UserId']."' OR rp.farward_userid='".$_REQUEST['UserId']."') AND r.type!='Personal' AND r.activity!='De' AND r.activity!='D' AND r.to_date>='".date("Y-m-d")."' GROUP BY r.rem_id order by r.from_date desc"); //AND rp.farward_userid=0
    }
    elseif($_REQUEST['Task_Status'] == 'Delegate')
    {
     $query_task = $conn->prepare("SELECT r.*,u.ufname,u2.ufname as forward_name FROM reminder r join user u ON u.userid = r.created_by LEFT JOIN reminder_participants rp ON rp.rem_id = r.rem_id LEFT JOIN user rpu ON rpu.userid = rp.userid LEFT JOIN user u2 ON rp.farward_userid = u2.userid WHERE (r.Status='Pending' OR r.Status='Done') AND rp.userid='".$_REQUEST['UserId']."' AND rp.farward_userid>0 AND r.type!='Personal' AND r.activity!='De' AND r.activity!='D' AND r.to_date>='".date("Y-m-d")."' GROUP BY r.rem_id order by r.from_date desc"); 
    }
	elseif($_REQUEST['Task_Status'] == 'DeadlineCrossed')
    {
     $query_task = $conn->prepare("SELECT r.*,u.ufname FROM reminder r join user u ON u.userid = r.created_by JOIN reminder_participants rp ON rp.rem_id = r.rem_id JOIN user rpu ON rpu.userid = rp.userid WHERE r.Status='Pending' AND (r.created_by='".$_REQUEST['UserId']."' OR rp.userid='".$_REQUEST['UserId']."' OR rp.farward_userid='".$_REQUEST['UserId']."') AND r.type!='Personal' AND r.activity!='De' AND r.activity!='D' AND r.to_date<'".date("Y-m-d")."' GROUP BY r.rem_id order by r.from_date desc");
     
    }
	  
  } //elseif($_REQUEST['Task']=='GroupTask')
  
  elseif($_REQUEST['Task']=='AllTask')
  {
     $NDay=date("Y-m-d",strtotime('-30 day', strtotime(date("Y-m-d"))));
     
     $query_task = $conn->prepare("SELECT r.*,u.ufname,
     
     CASE 
 WHEN r.type='Personal' AND (r.created_by='".$_REQUEST['UserId']."' OR rp.userid='".$_REQUEST['UserId']."') THEN 'MyTask' WHEN r.type!='Personal' AND (r.created_by='".$_REQUEST['UserId']."' OR rp.userid='".$_REQUEST['UserId']."' OR rp.farward_userid='".$_REQUEST['UserId']."') THEN 'GroupTask' END as Task,
CASE 
 WHEN r.Status='Done' THEN 'Done' 
 WHEN r.to_date<'".date("Y-m-d")."' AND r.Status='Pending' THEN 'DeadlineCrossed'
 WHEN r.to_date>='".date("Y-m-d")."' AND r.Status='Pending' AND rp.userid='".$_REQUEST['UserId']."' AND rp.farward_userid>0 THEN 'Delegate'
 WHEN r.Status='Pending' THEN 'Pending' END as TStatus
     
     FROM reminder r join user u ON u.userid = r.created_by JOIN reminder_participants rp ON rp.rem_id = r.rem_id JOIN user rpu ON rpu.userid = rp.userid WHERE (r.created_by='".$_REQUEST['UserId']."' OR rp.userid='".$_REQUEST['UserId']."' OR rp.farward_userid='".$_REQUEST['UserId']."') AND r.activity!='De' AND r.activity!='D' AND (r.from_date>='".$NDay."' AND '".$NDay."'<=r.to_date) GROUP BY r.rem_id order by r.from_date desc"); //AND rp.farward_userid=0
	  
  } //elseif($_REQUEST['Task']=='AllTask')
		
		
  $query_task->execute();
  $task_list = $query_task->fetchAll();
  $final = [];
		
  foreach($task_list as $key => $data)
  {
  
   $final[$key] = $data;
   
   $query_task2=$conn->prepare("SELECT rp.userid,u1.ufname,rp.`farward_userid`,u2.ufname as forward_name FROM reminder_participants rp LEFT JOIN user u1 ON rp.userid = u1.userid LEFT JOIN user u2 ON rp.farward_userid = u2.userid WHERE rem_id =".$data['rem_id']."");
   $query_task2->execute();
   $participant_list=$query_task2->fetchAll();
   $final[$key]['participant_list'] = $participant_list;
			
   $query_task=$conn->prepare("SELECT r.rem_id,rpu.userid,rpu.ufname,rp.comment FROM reminder r JOIN reminder_participants rp ON rp.rem_id = r.rem_id JOIN user rpu ON 
    
   (case when (farward_userId>0) THEN rpu.userid = rp.farward_userId ELSE rpu.userid = rp.userid END)

   WHERE r.rem_id=".$data['rem_id']." AND rp.comment!='' order by r.from_date desc");									
   
   $query_task->execute();
   $reply_list=$query_task->fetchAll();
   $final[$key]['reply_list']	= $reply_list;

   $query_task3=$conn->prepare("SELECT rp.userid,u.ufname,rt.rate Rating FROM reminder_participants rp JOIN user u ON u.userid = rp.userid JOIN rating rt ON rt.rem_id=rp.rem_id AND rt.userid=rp.userid WHERE rp.rem_id =".$data['rem_id']."");
   $query_task3->execute();
   $rating_list=$query_task3->fetchAll();
   $final[$key]['rating_list'] = $rating_list;
   
   
   include "config.php";
   $query_task4=mysql_query("select Ndate from reminder_participants_chatuser where rem_id=".$data['rem_id']." AND UserId=".$_REQUEST['UserId']);
   $rrowTd=mysql_num_rows($query_task4); 
   if($rrowTd>0){ $rrTd=mysql_fetch_assoc($query_task4); $ConQ="chat_date>'".$rrTd['Ndate']."'"; }else{ $ConQ="1=1"; }
  
  include "db.php";
  
   $sCTd=$conn->prepare("select count(*) as Total from reminder_participants_chat where rem_id=".$data['rem_id']." AND ".$ConQ." order by chat_date ASC"); $sCTd->execute(); $rCTd=$sCTd->fetchAll();
   $final[$key]['chat_count'] = $rCTd;
   
   /*$query_task4=$conn->prepare("SELECT count(*) as Total FROM reminder_participants_chat WHERE rem_id=".$data['rem_id']); 
   $query_task4->execute(); $task4=$query_task4->fetchAll();
   $final[$key]['chat_count'] = $task4;*/
   
   
   
   
   $FDate=date("d-M-y h:i A",strtotime($data['from_date']));
   $TDate=date("d-M-y h:i A",strtotime($data['to_date']));
   
   $final[$key]['Formate_FDate'] = $FDate;
   $final[$key]['Formate_TDate'] = $TDate;
   
  } //foreach($task_list as $key => $data)
		
  if(count($final)>0){ echo json_encode(array('task_list'=>$final,'status'=>200)); }
  else{ echo json_encode(array("task_list" => 'Data not find','status'=>400)); }
		
  } //if($_REQUEST['Task_Status']!= '')
}
?>









<?php /*
include "db.php";
if ($_REQUEST['UserId'] != '')
{
    if ($_REQUEST['Task_Status'] != '')
    {
        if ($_REQUEST['Task_Status'] == 'Done')
        {
            $query_task = $conn->prepare("SELECT r.*,u.ufname FROM reminder r
				join user u ON u.userid = r.created_by
				JOIN reminder_participants rp ON rp.rem_id = r.rem_id
				JOIN user rpu ON rpu.userid = rp.userid
				WHERE r.Status='" . $_REQUEST['Task_Status'] . "' AND r.created_by=" . $_REQUEST['UserId'] . " AND r.type!='Personal' AND r.activity!='De' AND r.activity!='D' GROUP BY r.rem_id order by r.from_date desc");
        }
        elseif ($_REQUEST['Task_Status'] == 'Pending')
        {
            $query_task = $conn->prepare("SELECT r.*,u.ufname FROM reminder r
				join user u ON u.userid = r.created_by
				JOIN reminder_participants rp ON rp.rem_id = r.rem_id
				JOIN user rpu ON rpu.userid = rp.userid WHERE r.Status='" . $_REQUEST['Task_Status'] . "' AND r.created_by='" . $_REQUEST['UserId'] . "' AND r.type!='Personal' AND r.activity!='De' AND r.activity!='D' GROUP BY r.rem_id order by r.from_date desc");
        }
        elseif ($_REQUEST['Task_Status'] == 'DeadlineCrossed')
        {
            $query_task = $conn->prepare("SELECT r.*,u.ufname FROM reminder r
				join user u ON u.userid = r.created_by
				JOIN reminder_participants rp ON rp.rem_id = r.rem_id
				JOIN user rpu ON rpu.userid = rp.userid WHERE r.Status='Pending' AND r.created_by='" . $_REQUEST['UserId'] . "' AND r.type!='Personal' AND r.activity!='De' AND r.activity!='D' AND r.to_date < '" . date("Y-m-d") . "' GROUP BY r.rem_id order by r.from_date desc");
		}
		elseif($_REQUEST['Task_Status']=='MyTask'){
			$query_task=$conn->prepare("SELECT r.*,u.ufname FROM reminder_participants rp 
			INNER JOIN reminder r ON r.rem_id=rp.rem_id 
            INNER JOIN user u on u.userid=r.created_by
            WHERE  rp.userid='".$_REQUEST['UserId']."'
			AND r.activity!='De' AND r.activity!='D' order by r.from_date desc");
		}
        $query_task->execute();
        $task_list = $query_task->fetchAll();
		
		$final = [];
		foreach($task_list as $key => $data){
			$final[$key] = $data;	
			$query_task2=$conn->prepare("SELECT rp.userid,u.ufname FROM reminder_participants rp
			JOIN user u ON u.userid = rp.userid
			WHERE rem_id =".$data['rem_id']."");
			$query_task2->execute();
			$participant_list=$query_task2->fetchAll();
			$final[$key]['participant_list'] = $participant_list;
			
			$query_task=$conn->prepare("SELECT r.rem_id,rpu.userid,rpu.ufname,rp.comment FROM reminder r
										JOIN reminder_participants rp ON rp.rem_id = r.rem_id
										JOIN user rpu ON rpu.userid = rp.userid
										WHERE r.rem_id=".$data['rem_id']." order by r.from_date desc");
										
			$query_task->execute();
			$reply_list=$query_task->fetchAll();
			$final[$key]['reply_list']	= $reply_list;

			$query_task3=$conn->prepare("SELECT rp.userid,u.ufname,rt.rate Rating FROM reminder_participants rp
			JOIN user u ON u.userid = rp.userid
			JOIN rating rt ON rt.rem_id=rp.rem_id AND rt.userid=rp.userid
			WHERE rp.rem_id =".$data['rem_id']."");
			$query_task3->execute();
			$rating_list=$query_task3->fetchAll();
			$final[$key]['rating_list'] = $rating_list;

			
		}
		
        if (count($final) > 0)
        {
			echo json_encode(array('task_list'=>$final,'status'=>200));
        }
        else
        {
            echo json_encode(array(
                "task_list" => 'Blank','status'=>400
            ));

        }
    }
}
*/
?>
