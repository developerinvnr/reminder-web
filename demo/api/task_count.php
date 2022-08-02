<?php
    include "db.php";

    if($_REQUEST['UserId']!=''){
        if ($_REQUEST['Task_Status'] == 'Done')
        {
            $query_task = $conn->prepare("SELECT COUNT(DISTINCT(r.rem_id)) total_task FROM reminder r
            join user u ON u.userid = r.created_by
            JOIN reminder_participants rp ON rp.rem_id = r.rem_id
            JOIN user rpu ON rpu.userid = rp.userid
            WHERE r.Status='" . $_REQUEST['Task_Status'] . "' AND r.created_by=" . $_REQUEST['UserId'] . " AND r.type!='Personal' AND r.activity!='De' AND r.activity!='D' ");
        }
        elseif ($_REQUEST['Task_Status'] == 'Pending')
        {
            $query_task = $conn->prepare("SELECT COUNT(DISTINCT(r.rem_id)) total_task FROM reminder r
            join user u ON u.userid = r.created_by
            JOIN reminder_participants rp ON rp.rem_id = r.rem_id
            JOIN user rpu ON rpu.userid = rp.userid
            WHERE r.Status='" . $_REQUEST['Task_Status'] . "' AND r.created_by=" . $_REQUEST['UserId'] . " AND r.type!='Personal' AND r.activity!='De' AND r.activity!='D'");
        }
        elseif ($_REQUEST['Task_Status']=='DeadlineCrossed'){
            $query_task = $conn->prepare("SELECT COUNT(DISTINCT(r.rem_id)) total_task FROM reminder r
            join user u ON u.userid = r.created_by
            JOIN reminder_participants rp ON rp.rem_id = r.rem_id
            JOIN user rpu ON rpu.userid = rp.userid WHERE r.Status='Pending' AND r.created_by='" . $_REQUEST['UserId'] . "' AND r.type!='Personal' AND r.activity!='De' AND r.activity!='D' AND r.to_date < '" . date("Y-m-d") . "' ");
        }
        elseif ($_REQUEST['Task_Status']=='MyTask'){
            $query_task=$conn->prepare("SELECT COUNT(DISTINCT(r.rem_id)) total_task FROM reminder_participants rp 
			INNER JOIN reminder r ON r.rem_id=rp.rem_id 
            INNER JOIN user u on u.userid=r.created_by
            WHERE  rp.userid='".$_REQUEST['UserId']."'
			AND r.activity!='De' AND r.activity!='D' ");
        }

        $query_task->execute();
        $task_count = $query_task->fetchAll();

        if (count($task_count) > 0)
        {
            echo json_encode(array(
                'Total Task' => $task_count,
                'status' => 200
            ));
        }
        else
        {
            echo json_encode(array(
                "Total Task" => 'Error',
                'status' => 400
            ));

        }
    }
?>