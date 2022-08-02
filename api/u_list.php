<?php
include "db.php";
if ($_REQUEST['userid'])
{
    $query = $conn->prepare("SELECT utype FROM user WHERE userid='" . $_REQUEST['userid'] . "' AND usts='A'");
    $query->execute();
    $query = $query->fetchAll();
    if ($query[0]['utype'] == 'A')
    {
        $query = $conn->prepare("SELECT * FROM user WHERE usts='A'");
		$query->execute();
        $user_list = $query->fetchAll();
        if ($user_list != '')
        {
            echo json_encode(array(
                "user_list" => $user_list
            ));
        }
        else
        {
            echo json_encode(array(
                "user_list" => ''
            ));
        }
    }
    else
    {
        
        $sql =$conn->prepare('SELECT userid FROM user WHERE crby='.$_REQUEST['userid'].'');
        $sql->execute();
        $userid_list =$sql->fetchAll();
        $ulist =[];
        foreach($userid_list as $key =>$data){
            $ulist[$key]=$data[userid];
        }
       $u =implode(',',$ulist);
        
      
        
        $query_user = $conn->prepare("SELECT * FROM contact_request
        WHERE request_by OR request_to IN($u)
		UNION  SELECT * FROM contact_request WHERE request_by IN 
		(SELECT request_to FROM contact_request)
        UNION SELECT * FROM contact_request WHERE request_to IN(SELECT request_by FROM contact_request)");
        $query_user->execute();
        $result_user_list = $query_user->fetchAll();
        $x = [];
        $y = [];
        foreach ($result_user_list as $key => $data)
        {
            $x[$key] = $data['request_by'];
            $y[$key] = $data['request_to'];

        }

        $final = array_unique(array_merge($x, $y));
        $final = implode(',', $final);
      
        foreach($final as $key =>$data){

            $sql =$conn->prepare("SELECT * FROM contact_request where request_by =49 and request_to = $key");
            $sql->execute();
            $query =$sql->fetchAll();
            $rowcount =mysqli_num_rows($query);
            if($rowcount >0){
                if($query['request_approve']==1){
                    $a='yes';
                }else{
                    $a ='no';
                }
            }else{
                $a ='no';
            }
        }
        

        $sql = $conn->prepare("SELECT * FROM user WHERE userid IN ($final) AND usts='A' AND userid<>1");
        $sql->execute();
        $userlist = $sql->fetchAll();
		        if ($userlist != '')
        {
            echo json_encode(array(
                "user_list" => $userlist
            ));
        }
        else
        {
            echo json_encode(array(
                "user_list" => ''
            ));
        }
		
    }
}

?>