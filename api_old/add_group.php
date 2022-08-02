<?php 
    include 'db.php';
	
		//---------------Fetch Varified User--------------------//
	if($_REQUEST['user_list']!='' && $_REQUEST['UserId']!=''){
		    
		  $query = $conn->prepare("SELECT utype FROM user WHERE userid='" . $_REQUEST['UserId'] . "' AND usts='A'");
    $query->execute();
    $query = $query->fetchAll();
    if ($query[0]['utype'] == 'A')
    {
        $ulist=$conn->prepare("SELECT userid, ufname, ulname FROM user WHERE user_varified='Yes'" );
			$ulist->execute();
			$user_list = $ulist->fetchAll();
    }
    else
    {
        $ulist = $conn->prepare("SELECT u.userid,u.ufname,u.ulname FROM user u inner join contact_request cr on (u.userid=cr.request_by OR u.userid=cr.request_to) WHERE (cr.request_by=".$_REQUEST['UserId']." OR cr.request_to=".$_REQUEST['UserId']." OR u.userid=".$_REQUEST['UserId']." OR u.crby=".$_REQUEST['UserId'].") and u.usts='A' group by u.userid asc");
        
        $ulist->execute();
			$user_list = $ulist->fetchAll();
        
    }
		    
			
			if ($user_list!=''){
					 echo json_encode(array("user_list"=>$user_list,'status'=>200));
				}
				else{
					 echo json_encode(array("user_list"=>'Reocrd not found.','status'=>500));
				}
		}
		//--------------------------------------------------------
		
    if($_REQUEST['UserId']!='' && $_REQUEST['Group_Name']!=''){                                                                   
        $user_id=$_REQUEST['UserId'];
		$grp_name=$_REQUEST['Group_Name'];
		$participant=$_REQUEST['Participant_Id'];
		//---------------Create Group, and Insert into group table, fetch last insert ID ------------------------//
        $query_task=$conn->prepare("INSERT INTO group_table (gname, created_by) VALUES ('$grp_name','$user_id')");	
		$query_task->execute();
		$last_gid=$conn->lastInsertId();
		//------------------------------------------------------------------------
		
		$array_data = explode(',',$participant);
		
		//--------------------------Insert Group Id and User ID into Group Contact Table -----------------------
		if($query_task){
			$data = '';
			foreach($array_data as $key=> $p_id){
				if($key == 0){
						$data .= "($last_gid,$p_id)";
				}else{
					$data .= ",($last_gid,$p_id)";
				}
			}
			$query_task1 = $conn->prepare("INSERT INTO group_contact(gid,userid) VALUES $data");
			$query_task1->execute();
			if($query_task1){
			 echo json_encode(array('msg'=>'Group Created Successfully.','status'=>200));
			}else{
				 echo json_encode(array('msg'=>'Group Creation Faild','status'=>500));
			}
		}
    }
    
?>




<?php /*
    include 'db.php';
	
		//---------------Fetch Varified User--------------------//
		if($_REQUEST['user_list'] != ''){
			$ulist=$conn->prepare("SELECT userid, ufname, ulname FROM user WHERE user_varified='Yes'" );
			$ulist->execute();
			$user_list = $ulist->fetchAll();
			if ($user_list!=''){
					 echo json_encode(array("user_list"=>$user_list,'status'=>200));
				}
				else{
					 echo json_encode(array("user_list"=>'Reocrd not found.','status'=>500));
				}
		}
		//--------------------------------------------------------
		
    if($_REQUEST['UserId']!=''){                                                                   
        $user_id=$_REQUEST['UserId'];
		$grp_name=$_REQUEST['Group_Name'];
		$participant=$_REQUEST['Participant_Id'];
		//---------------Create Group, and Insert into group table, fetch last insert ID ------------------------//
        $query_task=$conn->prepare("INSERT INTO group_table (gname, created_by) VALUES ('$grp_name','$user_id')");	
		$query_task->execute();
		$last_gid=$conn->lastInsertId();
		//------------------------------------------------------------------------
		
		$array_data = explode(',',$participant);
		
		//--------------------------Insert Group Id and User ID into Group Contact Table -----------------------
		if($query_task){
			$data = '';
			foreach($array_data as $key=> $p_id){
				if($key == 0){
						$data .= "($last_gid,$p_id)";
				}else{
					$data .= ",($last_gid,$p_id)";
				}
			}
			$query_task1 = $conn->prepare("INSERT INTO group_contact(gid,userid) VALUES $data");
			$query_task1->execute();
			if($query_task1){
			 echo json_encode(array('msg'=>'Group Created Successfully.','status'=>200));
			}else{
				 echo json_encode(array('msg'=>'Group Creation Faild','status'=>500));
			}
		}
    }
    
    */
?>