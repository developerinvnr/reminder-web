<?php
include "db.php";

if ($_REQUEST['userid'])
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


/*
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
        $query_user = $conn->prepare('SELECT * FROM contact_request
        WHERE request_by="'.$_REQUEST['userid'].'" and request_approve=1  
		UNION  SELECT * FROM contact_request WHERE request_by IN 
		(SELECT request_to FROM contact_request WHERE request_sent=1 AND request_approve=1) 
		AND request_approve=1');
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
*/

?>