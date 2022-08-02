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
        WHERE request_by IN ($u) OR request_to IN($u)");
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
        
           $array1=array($final);

        $sql =$conn->prepare("SELECT request_to FROM contact_request WHERE request_by= ".$_REQUEST['userid']." AND request_to IN($final) and request_to<>1");
        $sql->execute();
        $sql1 =$sql->fetchAll();
    
        foreach($sql1 as $key =>$data){
            $userlist[$key]=$data[request_to];
        }
        $userlist1 =implode(',',$userlist);
        
 
        $array2=array($userlist1);
        $out=array_diff($array2,$array1);
        print_r($out);die;
        
		
    }
}

?>