<?php
include 'db.php';
if ($_REQUEST['UserId'] != '')
{
    $condition = '';
    if (!empty($_REQUEST['From_Date']))
    {
        $condition .= ' AND date(from_date) >= "' . $_REQUEST['From_Date'] . '"';
    }
    if (!empty($_REQUEST['To_Date']))
    {
        $condition .= ' AND date(to_date) <= "' . $_REQUEST['To_Date'] . '"';
    }
    if (!empty($_REQUEST['Priority']))
    {
        $condition .= ' AND priority = "' . $_REQUEST['Priority'] . '"';
    }
    if(!empty($_REQUEST['Search'])){
        $condition .= 'AND (title like "%'.$_REQUEST['Search'].'%" OR u.ufname like "%'.$_REQUEST['Search'].'%")';
    }
    if(!empty($_REQUEST['participant_id'])){
        $condition .= 'AND u.userid='.$_REQUEST['participant_id'];
    }

    $query_task = $conn->prepare("SELECT r.*,u.ufname creator FROM reminder_participants rp
    JOIN reminder r ON r.rem_id = rp.rem_id
    JOIN user u ON u.userid = r.created_by
    where (rp.userid = '" . $_REQUEST['UserId'] . "' OR r.created_by = '" . $_REQUEST['UserId'] . "' OR rp.farward_userid = '" . $_REQUEST['UserId'] . "') " . $condition . "
    GROUP by r.rem_id order by r.from_date desc");
    $query_task->execute();
   // print_r($query_task);die;
    $task_list = $query_task->fetchAll();
    $final = [];
    foreach ($task_list as $key => $data)
    {
        /* $con = '';
        if(!empty($_REQUEST['participent_search'])){
            $con = ' AND u.ufname like "%'.$_REQUEST['participent_search'].'%" ';
        } */
        $final[$key] = $data;
        $query_task2 = $conn->prepare("SELECT rp.userid,u.ufname FROM reminder_participants rp
			JOIN user u ON u.userid = rp.userid
			WHERE rem_id =" . $data['rem_id'] ."");
        $query_task2->execute();
        $participant_list = $query_task2->fetchAll();
        $final[$key]['participant_list'] = $participant_list;
        
        
         $query_task=$conn->prepare("SELECT r.rem_id,rpu.userid,rpu.ufname,rp.comment,rp.reply_img FROM reminder r JOIN reminder_participants rp ON rp.rem_id = r.rem_id JOIN user rpu ON 
         
         (case when (farward_userId>0) THEN rpu.userid = rp.farward_userId ELSE rpu.userid = rp.userid END) 
         
         WHERE r.rem_id=".$data['rem_id']." AND rp.comment!='' order by r.from_date desc");									
        $query_task->execute();
        $reply_list=$query_task->fetchAll();
        $final[$key]['reply_list']	= $reply_list;
        
        $query_task3 = $conn->prepare("SELECT IFNULL( ROUND(AVG(rate),0),0) rate FROM rating WHERE rem_id =" . $data['rem_id'] . " ");
        $query_task3->execute();
        $rating_list = $query_task3->fetchAll();
        $final[$key]['rating'] = $rating_list;
    }
    if (count($final) > 0)
    {
        echo json_encode(array(
            "task_list" => $final,
            "status" => 200
        ));
    }
    else
    {
        echo json_encode(array(
            "task_list" => '',
            "status" => 400
        ));
    }

}
?>