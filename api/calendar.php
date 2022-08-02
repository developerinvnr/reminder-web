<?php
    include "db.php";		
    if($_REQUEST['UserId']!=''){
           $query_task=$conn->prepare("SELECT * FROM reminder r WHERE created_by=".$_REQUEST['UserId']." order by r.from_date desc");
            $query_task->execute();
            $task_list =$query_task->fetchAll();
            
            $final = [];
            
  foreach($task_list as $key => $data)
  {
  
   $final[$key] = $data;
   
   $query_task2=$conn->prepare("SELECT rp.userid,u1.ufname,rp.`farward_userid`,u2.ufname as forward_name FROM reminder_participants rp LEFT JOIN user u1 ON rp.userid = u1.userid LEFT JOIN user u2 ON rp.farward_userid = u2.userid WHERE rem_id =".$data['rem_id']."");
   $query_task2->execute();
   $participant_list=$query_task2->fetchAll();
   $final[$key]['participant_list'] = $participant_list;
			
   $query_task=$conn->prepare("SELECT r.rem_id,rpu.userid,rpu.ufname,rp.comment FROM reminder r JOIN reminder_participants rp ON rp.rem_id = r.rem_id JOIN user rpu ON rpu.userid = rp.userid WHERE r.rem_id=".$data['rem_id']." AND rp.comment!='' order by r.from_date desc");									
   
   $query_task->execute();
   $reply_list=$query_task->fetchAll();
   $final[$key]['reply_list']	= $reply_list;

   $query_task3=$conn->prepare("SELECT rp.userid,u.ufname,rt.rate Rating FROM reminder_participants rp JOIN user u ON u.userid = rp.userid JOIN rating rt ON rt.rem_id=rp.rem_id AND rt.userid=rp.userid WHERE rp.rem_id =".$data['rem_id']."");
   $query_task3->execute();
   $rating_list=$query_task3->fetchAll();
   $final[$key]['rating_list'] = $rating_list;
   
   $FDate=date("d-M-y h:i A",strtotime($data['from_date']));
   $TDate=date("d-M-y h:i A",strtotime($data['to_date']));
   
   $final[$key]['Formate_FDate'] = $FDate;
   $final[$key]['Formate_TDate'] = $TDate;
   
  } //foreach($task_list as $key => $data)
  
  
  if(count($final)>0){ echo json_encode(array('task_list'=>$final,'status'=>200)); }
  else{ echo json_encode(array("task_list" => 'Data not find','status'=>400)); }
            
            /*
            if ($task_list!='') 
            {
                 echo json_encode(array("task_list"=>$task_list) );
                    
            }
            else
            {
                 echo json_encode(array("task_list"=>'Error') );
          
            }
            */
    }
?>