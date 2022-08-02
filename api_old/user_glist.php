<?php

include "db.php";

  
if($_REQUEST['Group'] && $_REQUEST['UserId']>0)

{	
    //echo $_REQUEST['Group'];
	if($_REQUEST['Group']>0)
	{ $grp='gc.gid='.$_REQUEST['Group']; 
	  $query_guser = $conn->prepare("SELECT u.userid,u.ufname,u.ulname,u.ucontact,u.user_token FROM group_contact gc inner join user u on gc.userid=u.userid WHERE (".$grp." OR u.userid=".$_REQUEST['UserId'].") and u.usts='A' group by u.userid asc");  
	}
	else
	{ 
	    
	   $query = $conn->prepare("SELECT utype FROM user WHERE userid='". $_REQUEST['UserId']."' AND usts='A'");
       $query->execute();
       $query = $query->fetchAll(); 
       if ($query[0]['utype'] == 'A')
       {
           $query_guser = $conn->prepare("SELECT u.userid,u.ufname,u.ulname,u.ucontact,u.user_token FROM user u where usts='A' AND user_varified='Yes' AND userid!=1 AND utype!='A' order by ufname asc");
           
       }
       else
       {
	    
	    $query_guser = $conn->prepare("SELECT u.userid,u.ufname,u.ulname,u.ucontact,u.user_token FROM user u inner join contact_request cr on (u.userid=cr.request_by OR u.userid=cr.request_to) WHERE (cr.request_by=".$_REQUEST['UserId']." OR cr.request_to=".$_REQUEST['UserId']." OR u.userid=".$_REQUEST['UserId']." OR u.crby=".$_REQUEST['UserId'].") and u.usts='A' group by u.userid asc");
	    
	    //$query_guser = $conn->prepare("SELECT u.userid,u.ufname,u.ulname,u.ucontact,u.user_token FROM group_table gt inner join group_contact gc on gt.gid=gc.gid inner join user u on gc.userid=u.userid WHERE (gt.created_by=".$_REQUEST['UserId']." OR u.userid=".$_REQUEST['UserId'].") and u.usts='A'");
	    
	    //echo "SELECT u.userid,u.ufname,u.ulname,u.ucontact,u.user_token FROM group_table gt inner join group_contact gc on gt.gid=gc.gid inner join user u on gc.userid=u.userid WHERE (gt.created_by=".$_REQUEST['UserId']." OR u.userid=".$_REQUEST['UserId'].") and u.usts='A'"; die();
       }
	}     


	$query_guser->execute();
	$result_guser_list = $query_guser->fetchAll();
	



  if ($result_guser_list!='') 
  {
       echo json_encode(array("group_user_list"=>$result_guser_list) );
  }
  else if ($result_guser_list=='') 
  {
       $query_guser = $conn->prepare("SELECT u.userid,u.ufname,u.ulname,u.ucontact,u.user_token FROM user u inner join contact_request cr on (u.userid=cr.request_by OR u.userid=cr.request_to) WHERE (cr.request_by=".$_REQUEST['UserId']." OR cr.request_to=".$_REQUEST['UserId']." OR u.userid=".$_REQUEST['UserId'].") and u.usts='A' group by u.userid asc");
       
       	$query_guser->execute();
	    $result_guser_list = $query_guser->fetchAll();
	    echo json_encode(array("group_user_list"=>$result_guser_list) );
  }

  else
  {
    echo json_encode(array("group_user_list"=>'Error') );
  }


}


elseif($_REQUEST['UserId']!='')

{	

	     

 $query_group = $conn->prepare("SELECT gid,gname FROM group_table WHERE created_by=".$_REQUEST['UserId']);

 $query_group->execute();

 $group_list = $query_group->fetchAll();



  if ($group_list!='') 

  {



       echo json_encode(array("group_list"=>$group_list) );



  }

  else

  {

       echo json_encode(array("group_list"=>'Error') );

  }



}  

   

	

?>