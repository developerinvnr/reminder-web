<?php
include "db.php";

if($_REQUEST['SelType']=='dept' && $_REQUEST['UserId']>0 && $_REQUEST['DeptId']>0)
{
   $ccon=mysql_connect('localhost','vnrseed2_hr','vnrhrims321');
   $db=mysql_select_db('vnrseed2_hrims',$ccon);     
   $query = mysql_query("SELECT CONCAT_WS( ' ', Fname, Sname, Lname ) as ufname, MobileNo_Vnr as phoneNum FROM hrm_employee_general g inner join hrm_employee e on g.EmployeeID=e.EmployeeID WHERE g.DepartmentId=".$_REQUEST['DeptId']." and e.EmpStatus='A' group by e.EmployeeID order by e.Fname", $ccon);     
  $emp = array();
  while($res = mysql_fetch_assoc($query)){ $emp[]=$res; }
  if($emp!='')
  {
   echo json_encode(array("atype" => 'vspl_group', "vspl_group_List"=>$emp));     
  }
  else
  {
   echo json_encode(array("atype" => 'user', "msg"=>'data not found'));  
  }
      
}    
      
elseif($_REQUEST['SelType']=='group' && $_REQUEST['Group'] && $_REQUEST['UserId']>0 && $_REQUEST['contactno']>0)
{	
    
   if($_REQUEST['Group']>0 AND $_REQUEST['Group']!=101 AND $_REQUEST['Group']!=102 AND $_REQUEST['Group']!=103)
	{ $grp='gc.gid='.$_REQUEST['Group']; 
	  $query_guser = $conn->prepare("SELECT u.userid,u.ufname,u.ulname,u.ucontact,u.user_token FROM group_contact gc inner join user u on gc.userid=u.userid WHERE (".$grp." OR u.userid=".$_REQUEST['UserId'].") and u.usts='A' group by u.userid order by u.ufname asc");  
	
	   $query_guser->execute();
	   $result_guser_list = $query_guser->fetchAll(); 
	   if ($result_guser_list!='') 
       { echo json_encode(array("atype" => 'user', "group_user_list"=>$result_guser_list) ); }
       else if ($result_guser_list=='') 
       {
       $query_guser = $conn->prepare("SELECT u.userid,u.ufname,u.ulname,u.ucontact,u.user_token FROM user u inner join contact_request cr on (u.userid=cr.request_by OR u.userid=cr.request_to) WHERE (cr.request_by=".$_REQUEST['UserId']." OR cr.request_to=".$_REQUEST['UserId']." OR u.userid=".$_REQUEST['UserId'].") and u.usts='A' group by u.userid order by u.ufname asc");
       
       	$query_guser->execute();
	    $result_guser_list = $query_guser->fetchAll();
	    echo json_encode(array("atype" => 'user', "group_user_list"=>$result_guser_list) );
       }
       else{ echo json_encode(array("group_user_list"=>'Error') ); }
	  
	}
	elseif($_REQUEST['Group']==101 OR $_REQUEST['Group']==102 OR $_REQUEST['Group']==103)
	{ 
	  if($_REQUEST['Group']==101){ $comid=1; } 
	  elseif($_REQUEST['Group']==102){ $comid=3; }
	  elseif($_REQUEST['Group']==103){ $comid=2; } 
	  $ccon=mysql_connect('localhost','vnrseed2_hr','vnrhrims321');
      $db=mysql_select_db('vnrseed2_hrims',$ccon);
      $query = mysql_query("SELECT DepartmentId as deptid,DepartmentCode as deptcode FROM hrm_department WHERE CompanyId=".$comid." and DeptStatus='A' order by DepartmentCode",$ccon);     
      $dept = array();
      while($res = mysql_fetch_assoc($query)){ $dept[]=$res; }
      if($dept!='')
      {
       echo json_encode(array("status" => '300', "atype" => 'dept', "department_list" => $dept));
      }
      else
      {
       echo json_encode(array("status" => '100', "msg" => 'data not found'));  
      }
          
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
	    
	    $query_guser = $conn->prepare("SELECT u.userid,u.ufname,u.ulname,u.ucontact,u.user_token FROM user u inner join contact_request cr on (u.userid=cr.request_by OR u.userid=cr.request_to) WHERE (cr.request_by=".$_REQUEST['UserId']." OR cr.request_to=".$_REQUEST['UserId']." OR u.userid=".$_REQUEST['UserId']." OR u.crby=".$_REQUEST['UserId'].") and u.usts='A' group by u.userid order by u.ufname asc ");
	    
	    //$query_guser = $conn->prepare("SELECT u.userid,u.ufname,u.ulname,u.ucontact,u.user_token FROM group_table gt inner join group_contact gc on gt.gid=gc.gid inner join user u on gc.userid=u.userid WHERE (gt.created_by=".$_REQUEST['UserId']." OR u.userid=".$_REQUEST['UserId'].") and u.usts='A'");
	    
	    //echo "SELECT u.userid,u.ufname,u.ulname,u.ucontact,u.user_token FROM group_table gt inner join group_contact gc on gt.gid=gc.gid inner join user u on gc.userid=u.userid WHERE (gt.created_by=".$_REQUEST['UserId']." OR u.userid=".$_REQUEST['UserId'].") and u.usts='A'"; die();
       }
       
       $query_guser->execute();
	   $result_guser_list = $query_guser->fetchAll();
	   if ($result_guser_list!='') 
       { echo json_encode(array("atype" => 'user', "group_user_list"=>$result_guser_list) ); }
       else if ($result_guser_list=='') 
       {
       $query_guser = $conn->prepare("SELECT u.userid,u.ufname,u.ulname,u.ucontact,u.user_token FROM user u inner join contact_request cr on (u.userid=cr.request_by OR u.userid=cr.request_to) WHERE (cr.request_by=".$_REQUEST['UserId']." OR cr.request_to=".$_REQUEST['UserId']." OR u.userid=".$_REQUEST['UserId'].") and u.usts='A' group by u.userid order by u.ufname asc");
       
       	$query_guser->execute();
	    $result_guser_list = $query_guser->fetchAll();
	    echo json_encode(array("atype" => 'user', "group_user_list"=>$result_guser_list) );
      }
       else{ echo json_encode(array("group_user_list"=>'Error') ); }
	   
	}     



}


elseif($_REQUEST['UserId']!='' && $_REQUEST['contactno']>0)
{	
 
 $ccon=mysqli_connect('localhost','vnrseed2_hr','vnrhrims321');
 $db=mysqli_select_db( $ccon, 'vnrseed2_hrims');
 $query = mysqli_query($ccon, "SELECT MobileNo_Vnr FROM hrm_employee_general g inner join hrm_employee e on g.EmployeeID=e.EmployeeID WHERE e.EmpStatus='A' AND g.MobileNo_Vnr='".$_REQUEST['contactno']."'");  
 $rowno=mysqli_num_rows($query);
    
 if($rowno>0){ $subQ="(created_by=".$_REQUEST['UserId']." OR created_by=0)"; }else{ $subQ="created_by=".$_REQUEST['UserId']; }
    
 $query_group = $conn->prepare("SELECT gid,gname FROM group_table WHERE ".$subQ);
 $query_group->execute();
 $group_list = $query_group->fetchAll();
 if($group_list!='') 
 {
   echo json_encode(array("group_list"=>$group_list) );
 }
 else
 {
   echo json_encode(array("group_list"=>'Error') );
 }

}  

?>