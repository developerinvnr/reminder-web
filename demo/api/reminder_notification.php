<?php
      include "db.php";

      $sql = $conn->prepare("SELECT * FROM `reminder` WHERE rem_req=1 AND activity='A' AND Status='Pending' AND period!=0 AND to_date <= '" . date("Y-m-d") . "'");
      $sql->execute();
     // print_r($sql);die;
      $reminder_list = $sql->fetchAll();

      foreach($reminder_list as $key=>$data){
          if($data['period']==24){
            $query1 = $conn->prepare("SELECT r.rem_id, r.title, r.description,rp.userid,u.user_token FROM reminder_participants rp JOIN reminder r ON r.rem_id = rp.rem_id JOIN user u ON u.userid = rp.userid WHERE r.rem_id ='". $data['rem_id'] . "' ");
            $query1->execute();
            $list = $query1->fetchAll();
            echo json_encode(array('Once in a Day Notification'=>$list));
          }elseif($data['period']==12){
            $query2 =$conn->prepare("SELECT r.rem_id, r.title, r.description,rp.userid,u.user_token FROM reminder_participants rp JOIN reminder r ON r.rem_id = rp.rem_id JOIN user u ON u.userid = rp.userid WHERE r.rem_id ='". $data['rem_id'] . "' ");
            $query2->execute();
            $list1=$query2->fetchAll();
            echo json_encode(array('Twice in a Day Notification'=>$list1));
          }elseif($data['period']==8){
            $query3 =$conn->prepare("SELECT r.rem_id, r.title, r.description,rp.userid,u.user_token FROM reminder_participants rp JOIN reminder r ON r.rem_id = rp.rem_id JOIN user u ON u.userid = rp.userid WHERE r.rem_id ='". $data['rem_id'] . "' ");
            $query3->execute();
            $list2=$query3->fetchAll();
            echo json_encode(array('Thrice in a Day Notification'=>$list2));
          }
      }



?>