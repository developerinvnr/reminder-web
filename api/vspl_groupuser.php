<?php
$con=mysqli_connect('localhost','vnrseed2_hr','vnrhrims321');
if(!$con) die("Failed to connect to database!");
$db=mysqli_select_db( $con, 'vnrseed2_hrims');
if(!$db) die("Failed to select database!");

	
if($_REQUEST['userid']!='' && $_REQUEST['atype']=='contact')
{
    $query = mysqli_query($con,"SELECT MobileNo_Vnr as contactno FROM hrm_employee_general g inner join hrm_employee e on g.EmployeeID=e.EmployeeID WHERE e.EmpStatus='A' group by MobileNo_Vnr order by MobileNo_Vnr");     
    $contact = array();
    while($res = mysqli_fetch_assoc($query)){ $contact[]=$res; }
	echo json_encode(array("contact_list" => $contact));
}

elseif($_REQUEST['userid']!='' && $_REQUEST['atype']=='group')
{
  echo json_encode(array("G1_Id" => '1', "G1_Name" => 'VNR Seeds Pvt Ltd', "G1_Code" => 'VSPL', "G2_Id" => '3', "G2_Name" => 'VNR Nursery Pvt Ltd', "G2_Code" => 'VNPL', "G4_Id" => '4', "G4_Name" => 'VNR Farm Pvt Ltd', "G4_Code" => 'VFPL' ));
}	

elseif($_REQUEST['userid']!='' && $_REQUEST['atype']=='dept' && $_REQUEST['comid']>0)
{
  $query = mysqli_query($con,"SELECT DepartmentId as deptid,DepartmentCode as deptcode FROM hrm_department WHERE CompanyId=".$_REQUEST['comid']." and DeptStatus='A' order by DepartmentCode");     
  $dept = array();
  while($res = mysqli_fetch_assoc($query)){ $dept[]=$res; }
  echo json_encode(array("department_list" => $dept));
}


elseif($_REQUEST['userid']!='' && $_REQUEST['atype']='employee' && $_REQUEST['deptid']>0)
{
  $query = mysqli_query($con,"SELECT CONCAT_WS( ' ', Fname, Sname, Lname ) as ename, MobileNo_Vnr as contactno FROM hrm_employee_general g inner join hrm_employee e on g.EmployeeID=e.EmployeeID WHERE g.DepartmentId=".$_REQUEST['deptid']." and e.EmpStatus='A' group by e.EmployeeID order by e.Fname");     
  $emp = array();
  while($res = mysqli_fetch_assoc($query)){ $emp[]=$res; }
  echo json_encode(array("employee_list" => $emp));
}	


?>