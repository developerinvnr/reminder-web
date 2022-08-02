<?php 
    include "db.php";
    
    /*----------------------Delete Reminder and its related table-------------*/

if($_REQUEST['UserId']!='' && $_REQUEST['Rem_Id']!=''){
     $user_id    =   $_REQUEST['UserId'];
     $rem_id     =   $_REQUEST['Rem_Id'];
      $check_create =$conn->prepare("SELECT * FROM reminder WHERE rem_id ='".$rem_id."' AND created_by ='".$user_id."'");
        $check_create->execute();
         $check_create_list=$check_create->fetchAll();
         
         if(count($check_create_list)>0){
         
             $delete_reminder = $conn->prepare("DELETE FROM reminder WHERE rem_id = '" . $rem_id . "' ");
             $delete_reminder->execute();
             
             $reminder_participants = $conn->prepare("DELETE FROM reminder_participants WHERE rem_id = '" . $rem_id . "' ");
             $reminder_participants->execute();
             
             $reminder_task = $conn->prepare("DELETE FROM reminder_task WHERE rem_id = '" . $rem_id . "' ");
             $reminder_task->execute();
              if ($delete_reminder)
                        {
                            echo json_encode(array(
                                'msg' => 'Reminder Deleted Successfully.',
                                'status' => 200
                            ));
                        }
                        else
                        {
                            echo json_encode(array(
                                'msg' => 'Failed to Delete Reminder.',
                                'status' => 400
                            ));
                        }
         }else{
             echo json_encode(array(
                                'msg' => 'Cant delete Reminder that is not created by you..!!',
                                'status' => 400
                            ));
         }
   /*------------------End Delete Reminder and its related table-------------*/
}
?>