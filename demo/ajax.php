<?php
require_once 'config.php';

if($_POST['act'] == 'rate'){
	$therate = $_POST['rate'];
	$thepost = $_POST['post_id'];
    $userid = $_POST['userid'];

	$query = mysql_query("SELECT * FROM rating where userid='".$userid."' AND rem_id='".$thepost."'  "); 
	while($data = mysql_fetch_assoc($query)){
		$rate_db[] = $data;
	}

	if(@count($rate_db) == 0 ){
		mysql_query("INSERT INTO rating (userid, rate, rem_id)VALUES('$userid', '$therate', '$thepost')");
	}else{
		mysql_query("UPDATE rating SET rate= '$therate' WHERE rem_id = '$thepost' AND userid='$userid' ");
	}

}elseif($_POST['act'] == 'expandDeadlineSave'){

    
    $to_date = date('Y-m-d H:i', strtotime($_POST["tdate"]));
    $remid = $_POST['remid'];


    echo "UPDATE reminder SET to_date= '$to_date' WHERE rem_id = '$remid' ";
    
    $up=mysql_query("UPDATE reminder SET to_date= '$to_date' WHERE rem_id = '$remid' ");

    if($up){

        $query = mysql_query("INSERT INTO notification (rem_id, not_time, action) VALUES ('$remid', '".date('Y-m-d H:i')."' ,'0')");
        
        echo 'saved';
    }
    


}elseif($_POST['act'] == 'reOpenTask'){

    
    $to_date = date('Y-m-d H:i', strtotime($_POST["tdate"]));
    $remid = $_POST['remid'];
    $uid = $_POST['uid'];


    echo $sql="UPDATE reminder_participants SET status=0 WHERE rem_id = '$remid' and  userid = '$uid'";
    
    $up=mysql_query($sql);

    if($up){

        if(mysql_query("UPDATE reminder SET Status='Pending',activity='A' WHERE rem_id = '$remid'")){
			echo 'saved';
        }
        
        
    }
    


}
?>