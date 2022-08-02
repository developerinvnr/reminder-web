<?php
    include "db.php";
/*------------Start Fetch Varified User List------------------*/
    if($_REQUEST['user_list']!=''){
        $ulist = $conn->prepare("SELECT userid, ufname, ulname FROM user WHERE user_varified='Yes'");
        $ulist->execute();
        $user_list = $ulist->fetchAll();
        if ($user_list != '')
        {
            echo json_encode(array(
                "user_list" => $user_list,
                'status' => 200
            ));
        }
        else
        {
            echo json_encode(array(
                "user_list" => 'Reocrd not found.',
                'status' => 400
            ));
        }
    }
/*------------End Fetch Varified user list------------------*/

/*------------Start Updating Reminder and its related table------------------*/
    if($_REQUEST['UserId']!=''){
        //Varibale Define
        $user_id    =   $_REQUEST['UserId'];
        $rem_id     =   $_REQUEST['Rem_Id'];
        $title = $_REQUEST['Title'];
        $description = $_REQUEST['Description'];
        $from_date = $_REQUEST['From_Date'];
        $to_date = $_REQUEST['To_Date'];
        $start_date = $_REQUEST['Start_Date'];
        $modify_date = date("Y-m-d h:i:s", strtotime($_REQUEST['Start_Date']));
        $periods = $_REQUEST["Periods"];
        $priority = $_REQUEST['Priority'];
        $participants = $_REQUEST['Participants'];

        $check_create =$conn->prepare("SELECT * FROM reminder WHERE rem_id ='".$rem_id."' AND created_by ='".$user_id."'");
        $check_create->execute();
        $check_create_list=$check_create->fetchAll();

        $check_assign =$conn->prepare("SELECT * FROM reminder_participants WHERE rem_id='".$rem_id."' AND userid='".$user_id."'");
        $check_assign->execute();
        $check_assign_list=$check_assign->fetchAll();

       if(count($check_create_list)>0 && count($check_assign_list)>0){
            //Check Reminder Task is Created by Logged in User and Also Assigned in the same task
            $update_reminder= $conn->prepare("UPDATE reminder SET title= '" . $title . "', description= '" . $description . "', from_date='" . $from_date . "',to_date= '" . $to_date . "', start_date='" . $start_date . "', period='" . $periods . "',priority='" . $priority . "', modified_at='" . $modify_date . "' WHERE rem_id = '" . $rem_id . "' ");
            $update_reminder->execute();
            $array_data = explode(',', $participants);
            $data = '';
                foreach ($array_data as $key => $p_id)
                {
                    if ($key == 0)
                    {
                        $data .= "($rem_id,$p_id,0)";
                    }
                    else
                    {
                        $data .= ",($rem_id,$p_id,0)";
                    }
                }
               // $delete_participant = $conn->prepare("DELETE FROM reminder_participants WHERE rem_id='" . $rem_id . "'");
                //$delete_participant->execute();
               // $inser_participant = $conn->prepare("INSERT INTO reminder_participants(rem_id,userid,status) VALUES $data");
               // $inser_participant->execute();
                if(isset($_REQUEST['Reply'])&& !empty($_REQUEST['Reply'])){
                    $reply_query = $conn->prepare("UPDATE reminder_participants SET status='1',comment='" .$_REQUEST['Reply']. "' WHERE rem_id='" . $rem_id . "' AND userid='" . $user_id . "' ");
                    $reply_query->execute();
                    //-----------************----------------------
                    $check_status=$conn->prepare("SELECT COUNT(*) zero_status_count FROM reminder_participants WHERE rem_id='".$rem_id."' AND status = 0 ");
                    $check_status->execute();
                    $check_status1=$check_status->fetchAll();
                    if($check_status1[0]['zero_status_count'] == 0){
                        $update_reminder_status = $conn->prepare("UPDATE reminder SET Status='Done' WHERE rem_id='" . $rem_id . "'");
                        $update_reminder_status->execute();
                    }
                }
                echo json_encode(array('msg'=>'Successfull','status'=>200));
       }elseif(count($check_create_list)>0){
           //Check Reminder Task is Created by Logged in User
           $update_reminder= $conn->prepare("UPDATE reminder SET title= '" . $title . "', description= '" . $description . "', from_date='" . $from_date . "',to_date= '" . $to_date . "', start_date='" . $start_date . "', period='" . $periods . "',priority='" . $priority . "', modified_at='" . $modify_date . "' WHERE rem_id = '" . $rem_id . "' ");
           $update_reminder->execute();
           $array_data = explode(',', $participants);
           $data = '';
               foreach ($array_data as $key => $p_id)
               {
                   if ($key == 0)
                   {
                       $data .= "($rem_id,$p_id,0)";
                   }
                   else
                   {
                       $data .= ",($rem_id,$p_id,0)";
                   }
               }
              // $delete_participant = $conn->prepare("DELETE FROM reminder_participants WHERE rem_id='" . $rem_id . "'");
               //$delete_participant->execute();
               $inser_participant = $conn->prepare("INSERT INTO reminder_participants(rem_id,userid,status) VALUES $data");
               $inser_participant->execute();

               echo json_encode(array('msg'=>'Successfull','status'=>200));
       }else{
           //Logged In User is Assigned in the Task
           
           if(isset($_REQUEST['Reply'])&& !empty($_REQUEST['Reply'])){
            $reply_query = $conn->prepare("UPDATE reminder_participants SET status='1',comment='" . $_REQUEST['Reply']. "' WHERE rem_id='" . $rem_id . "' AND (userid='".$user_id."' OR farward_userid='".$user_id."') ");
            $reply_query->execute();
                    //-----------************----------------------
                    $check_status=$conn->prepare("SELECT COUNT(*) zero_status_count FROM reminder_participants WHERE rem_id='".$rem_id."' AND status = 0 ");
                    $check_status->execute();
                    $check_status1=$check_status->fetchAll();
                    if($check_status1[0]['zero_status_count'] == 0){
                        $update_reminder_status = $conn->prepare("UPDATE reminder SET Status='Done' WHERE rem_id='" . $rem_id . "'");
                        $update_reminder_status->execute();
                        if ($update_reminder_status)
                        {
                            echo json_encode(array(
                                'msg' => 'Reminder Status Updated Successfully.',
                                'status' => 200
                            ));
                        }
                        else
                        {
                            echo json_encode(array(
                                'msg' => 'Reminder Status failed Updated.',
                                'status' => 400
                            ));
                        }
                    }
                 }
                echo json_encode(array('msg'=>'Reply Successfully','status'=>200));
       }
    }
/*------------End Updating Reminder and its related table------------------*/


?>