<?php
include "db.php";
if($_REQUEST['userid'] && $_REQUEST['userid']!='')
{
    $query = $conn->prepare("SELECT utype FROM user WHERE userid='" . $_REQUEST['userid'] . "' AND usts='A'");
    $query->execute();
    $query = $query->fetchAll();
    if ($query[0]['utype'] == 'A')
    {
        
        
     ini_set('memory_limit', '-1');
		
     $conn = mysql_connect("localhost", "reminder_user", "reminder@192");
     $con = mysql_select_db("reminder", $conn);

     $query = mysql_query("SELECT userid, ufname, ulname, ucontact, uemail FROM user where usts='A' AND user_varified='Yes' AND utype!='A' order by ufname asc",$conn); //AND userid!=1 

     $uarray = array();
     while($res = mysql_fetch_assoc($query))
     {
   
      $res['request_sent']=1;
      $res['request_approved']=1;
      $uarray[]=$res; 
  
     }
     echo json_encode(array("user_list" => $uarray));    
      
      /*    
	  $query = $conn->prepare("SELECT userid, ufname, ulname, ucontact, uemail FROM user WHERE usts='A'");
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
	  */
    }
    else
    {   
        if($_REQUEST['userid']==56){ $sql =$conn->prepare('SELECT crby FROM user WHERE userid=9'); }
        else{ $sql =$conn->prepare("SELECT crby FROM user WHERE userid=".$_REQUEST['userid']." "); }
        
        //(userid=".$_REQUEST['userid']." OR utype='U')
        
        $sql->execute();
        $userid_list =$sql->fetchAll();
        $ulist =[];
        foreach($userid_list as $key =>$data){
            $ulist[$key]=$data[crby];
        }
		
		$ulist2 =[];
		$sql2 =$conn->prepare('SELECT userid FROM user WHERE crby='.$_REQUEST['userid'].'');
        $sql2->execute();
        $userid2_list =$sql2->fetchAll();
        foreach($userid2_list as $key2 =>$data){
            $ulist[$ulist2[$key2]]=$data[userid];
        }
		
		$u1 =implode(',',$ulist);
		
		//echo $u1;
		
		$ulist3 =[];
		$sql3 =$conn->prepare('SELECT request_by as userid FROM contact_request WHERE request_to IN ('.$u1.','.$_REQUEST['userid'].') UNION SELECT request_to as userid FROM contact_request WHERE request_by IN('.$u1.','.$_REQUEST['userid'].')');
        $sql3->execute();
        $userid3_list =$sql3->fetchAll();
        foreach($userid3_list as $key3 =>$data){
			$ulist3[$key3]=$data[userid];
        }
		
        $u2 =implode(',',$ulist3);
		
		$ulist4 =[];
		$sql4 =$conn->prepare('SELECT request_by as userid FROM contact_request WHERE request_to IN ('.$u1.','.$u2.','.$_REQUEST['userid'].') UNION SELECT request_to as userid FROM contact_request WHERE request_by IN('.$u1.','.$u2.','.$_REQUEST['userid'].')');
        $sql4->execute();
        $userid4_list =$sql4->fetchAll();
        foreach($userid4_list as $key4 =>$data){
			$ulist4[$key4]=$data[userid];
        }
		
		$u3 =implode(',',$ulist4);
		
		if($u3!=''){$u=$u1.','.$u2.','.$u3;}else{$u=$u1.','.$u2;}
		
		
		ini_set('memory_limit', '-1');
		
		$conn = mysql_connect("localhost", "vnrseed2_remind", "vnrremind@123");
	    $con = mysql_select_db("vnrseed2_reminder", $conn);
		$query = mysql_query("SELECT userid, ufname, ulname, ucontact, uemail FROM user where userid in (".$u.") AND user_varified='Yes' AND userid!=".$_REQUEST['userid']." AND utype!='A' group by userid order by ufname asc",$conn); //AND userid!=1
		
		
		
		//echo "SELECT userid, ufname, ulname, ucontact, uemail FROM user where userid in (".$u.") AND user_varified='Yes' AND userid!=".$_REQUEST['userid']." AND userid!=1 AND utype!='A' group by userid order by ufname asc";
        
		$uarray = array();
        while($res = mysql_fetch_assoc($query))
		{
		  
		  $qchk = mysql_query("SELECT * FROM contact_request where request_by = ".$_REQUEST['userid']." AND request_to = ".$res['userid']."",$conn); $row=mysql_num_rows($qchk);
		  if($row>0)
		  {
		   $rchk=mysql_fetch_assoc($qchk);
		   $req_sent=1; $req_app=$rchk['request_approve'];
		  }
		  else
		  {
		   $req_sent=0; $req_app=0;
		  }
		 
		 $res['request_sent']=$req_sent;
		 $res['request_approved']=$req_app;
		 $uarray[]=$res; 
		  
		}
		
		echo json_encode(array("user_list" => $uarray));
				
    }
	
}
else
{

  ini_set('memory_limit', '-1');
		
  $conn = mysql_connect("localhost", "vnrseed2_remind", "vnrremind@123");
  $con = mysql_select_db("vnrseed2_reminder", $conn);

  $query = mysql_query("SELECT userid, ufname, ulname, ucontact, uemail FROM user where usts='A' AND user_varified='Yes' AND utype!='A' order by ufname asc",$conn); //AND userid!=1

  $uarray = array();
  while($res = mysql_fetch_assoc($query))
  {
   
   $res['request_sent']=1;
   $res['request_approved']=1;
   $uarray[]=$res; 
  
  }

echo json_encode(array("user_list" => $uarray));
    
   
}

?>


<?php /*
include "db.php";
if($_REQUEST['userid'] && $_REQUEST['userid']!='')
{
    $query = $conn->prepare("SELECT utype FROM user WHERE userid='" . $_REQUEST['userid'] . "' AND usts='A'");
    $query->execute();
    $query = $query->fetchAll();
    
    //echo $query[0]['utype'];
    
    if($query[0]['utype'] == 'A')
    {
        
        
     ini_set('memory_limit', '-1');
		
     $conn = mysql_connect("localhost", "vnrseed2_remind", "vnrremind@123");
     $con = mysql_select_db("vnrseed2_reminder", $conn);

     $query = mysql_query("SELECT userid, ufname, ulname, ucontact, uemail FROM user where usts='A' AND user_varified='Yes' AND userid!=1 AND utype!='A' order by ufname asc",$conn);

     $uarray = array();
     while($res = mysql_fetch_assoc($query))
     {
   
      $res['request_sent']=1;
      $res['request_approved']=1;
      $uarray[]=$res; 
  
     }
     echo json_encode(array("user_list" => $uarray));    
      
      /*    
	  $query = $conn->prepare("SELECT userid, ufname, ulname, ucontact, uemail FROM user WHERE usts='A'");
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
	  */ /*
    }
    else
    {   
       $sql =$conn->prepare('SELECT crby FROM user WHERE userid='.$_REQUEST['userid'].''); 
        
        $sql->execute();
        $userid_list =$sql->fetchAll();
        $ulist =[];
        foreach($userid_list as $key =>$data){
            $ulist[$key]=$data[crby];
        }
		
		$ulist2 =[];
		$sql2 =$conn->prepare('SELECT userid FROM user WHERE crby='.$_REQUEST['userid'].'');
        $sql2->execute();
        $userid2_list =$sql2->fetchAll();
        foreach($userid2_list as $key2 =>$data){
            $ulist[$ulist2[$key2]]=$data[userid];
        }
		
		$u1 =implode(',',$ulist);
		
		$ulist3 =[];
		
		$sql3 =$conn->prepare('SELECT request_by as userid FROM contact_request WHERE request_to IN ('.$u1.','.$_REQUEST['userid'].') AND request_by NOT IN ('.$u1.','.$_REQUEST['userid'].') UNION SELECT request_to as userid FROM contact_request WHERE request_by IN('.$u1.','.$_REQUEST['userid'].') AND request_to NOT IN ('.$u1.','.$_REQUEST['userid'].')');
        $sql3->execute();
        $userid3_list =$sql3->fetchAll();
        foreach($userid3_list as $key3 =>$data){
			$ulist3[$key3]=$data[userid];
        }
		
        $u2 =implode(',',$ulist3);
		
		$ulist4 =[];
		
		 
		$sql4 =$conn->prepare('SELECT request_by as userid FROM contact_request WHERE request_to IN ('.$u1.','.$u2.','.$_REQUEST['userid'].') AND request_by NOT IN ('.$u1.','.$u2.','.$_REQUEST['userid'].') UNION SELECT request_to as userid FROM contact_request WHERE request_by IN('.$u1.','.$u2.','.$_REQUEST['userid'].') AND request_to NOT IN ('.$u1.','.$u2.','.$_REQUEST['userid'].')');
        $sql4->execute();
        $userid4_list =$sql4->fetchAll();
        foreach($userid4_list as $key4 =>$data){
			$ulist4[$key4]=$data[userid];
        }
        
       
		
		$u3 =implode(',',$ulist4);
		
		if($u3!=''){$u=$u1.','.$u2.','.$u3;}else{$u=$u1.','.$u2;}
		
	    
		
		ini_set('memory_limit', '-1');
		
		$conn = mysql_connect("localhost", "vnrseed2_remind", "vnrremind@123");
	    $con = mysql_select_db("vnrseed2_reminder", $conn);
		$query = mysql_query("SELECT userid, ufname, ulname, ucontact, uemail FROM user where userid in (".$u.") AND user_varified='Yes' AND userid!=1 AND utype!='A' order by ufname asc",$conn);
        
		$uarray = array();
        while($res = mysql_fetch_assoc($query))
		{
		  
		  $qchk = mysql_query("SELECT * FROM contact_request where request_by = ".$_REQUEST['userid']." AND request_to = ".$res['userid']."",$conn); $row=mysql_num_rows($qchk);
		  if($row>0)
		  {
		   $rchk=mysql_fetch_assoc($qchk);
		   $req_sent=1; $req_app=$rchk['request_approve'];
		  }
		  else
		  {
		   $req_sent=0; $req_app=0;
		  }
		 
		 $res['request_sent']=$req_sent;
		 $res['request_approved']=$req_app;
		 $uarray[]=$res; 
		  
		}
		
		echo json_encode(array("user_list" => $uarray));
				
    }
	
}
else
{

  ini_set('memory_limit', '-1');
		
  $conn = mysql_connect("localhost", "vnrseed2_remind", "vnrremind@123");
  $con = mysql_select_db("vnrseed2_reminder", $conn);

  $query = mysql_query("SELECT userid, ufname, ulname, ucontact, uemail FROM user where usts='A' AND user_varified='Yes' AND userid!=1 AND utype!='A' order by ufname asc",$conn);

  $uarray = array();
  while($res = mysql_fetch_assoc($query))
  {
   
   $res['request_sent']=1;
   $res['request_approved']=1;
   $uarray[]=$res; 
  
  }

echo json_encode(array("user_list" => $uarray));
    
   
}
*/
?>