<?php
    include "db.php";
    include "add_task_notification.php";
    $sql = $conn->prepare("SELECT r.rem_id,r.title,r.description,rp.userid,u.user_token FROM reminder r 
    JOIN reminder_participants rp ON rp.rem_id =r.rem_id 
    JOIN user u ON u.userid =rp.userid 
    WHERE r.rem_req=1 AND r.activity='A' AND r.Status='Pending' AND u.user_token is not null and u.user_token <> '' 
    AND r.period = 8 AND r.to_date >= '" . date("Y-m-d") . "' AND r.start_date <= '" . date("Y-m-d") . "'");
    $sql->execute();
    $reminder_list = $sql->fetchAll();
   // echo json_encode($reminder_list);
  
   foreach($reminder_list as $key =>$data){
    $data1 = [];
    $user_token = [];
    $user_token[] = $data['user_token'];
    $data1['subject'] = $data['title'];
    $data1['msg_body'] =  $data['description'];
    android($data1,$user_token); 
   }
  // echo json_encode(array('status'=>200,'msg'=>'success'));
?>