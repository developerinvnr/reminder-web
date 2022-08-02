<?php include('common_function.php'); ?>
<?php
    session_start();
    if (!isset($_SESSION['id']))
    {
        header('Location: index.php');
    }    
    include "config.php";
    

if($_POST['action']=='getcalendar')
{ 


function getColor($status,$priority){
  
     if($priority=="Low"){
        if ($status=="Done"){
          echo '#FFFFFF; color:#C0C0C0;';
        }else{
          echo '#ffe9ba; color:#000000;';
        }
     }else if($priority=="High"){
        if($status=="Done"){
          echo '#FFFFFF; color:green;border:1px solid green;';
        }else{
          echo '#D91E18; color:#fff;';
        }
     }else if($priority=="KMedium"){
        if($status=="Done"){
          echo '#FFFFFF; color:#C0C0C0;';
        }else{
          echo '#ff9f5b; color:#000;';
        }
     }else{ echo '#aff7c2'; }

}

  $uid = $_SESSION['id'];


  if ($_SESSION['utype']=="A") 
  {
      $sql = "SELECT Status, from_date as f, to_date as t, DATE_FORMAT(from_date, '%Y-%m-%d') as i,DATE_FORMAT(to_date, '%Y-%m-%d') as j, priority, title, description, rem_id FROM reminder WHERE activity='A' ORDER BY priority ASC";
  }
  else
  {
      $sql = "SELECT r.Status, r.from_date as f, r.to_date as t, DATE_FORMAT(r.from_date, '%Y-%m-%d') as i,DATE_FORMAT(r.to_date, '%Y-%m-%d') as j, r.priority, r.title, r.description, r.rem_id FROM reminder r INNER JOIN reminder_participants rp ON r.rem_id=rp.rem_id WHERE (r.created_by='$uid' OR rp.userid='$uid') AND r.activity='A' ORDER BY r.priority ASC";
  }
    $array = array();
    $result = mysql_query($sql,$conn);
    while($row = mysql_fetch_assoc($result))
    {
      // echo $row['i'];
      // echo $row['j'];
       $from_date = date_create($row['f']);
       $to_date = date_create($row['t']);
      // echo $to_date = $row['j'];
       $diff=date_diff($to_date,$from_date);
       $date_diff = $diff->format("%a");
       // $date_diff +=1;
       $array[] =$row;
       for ($i=1; $i <=$date_diff ; $i++) 
       { 
          $cdate = date('Y-m-d', strtotime($row['f']. ' + '.$i.' days'));
          $push = array();
          $push['Status'] = $row['Status']; 
          $push['f'] = $row['f']; 
          $push['t'] = $row['t']; 
          $push['i'] = $cdate; 
          $push['j'] = $row['j']; 
          $push['priority'] = $row['priority']; 
          $push['title'] = $row['title']; 
          $push['description'] = $row['description']; 
          $push['rem_id'] = $row['rem_id']; 
           $array[] =$push;
          
       }
    }
    

  

  if($_POST['v']=='P')
  {
    if($_POST['m']==1)
    {
      $nm=12; 
      $ny=$_POST['y']-1;
    }
    else
    {
      $nm=$_POST['m']-1; 
      $ny=$_POST['y'];
    } 
  }
  else
  {
    if($_POST['m']==12)
    {
      $nm=1; $ny=$_POST['y']+1;
    }
    else
    {
      $nm=$_POST['m']+1; $ny=$_POST['y'];
    } 
  }

                 
$m=$nm; $y=$ny; if(strlen($nm)==1){$nnm='0'.$nm;}else{$nnm=$nm;}
$mkdate = mktime(0,0,0, $nnm, 1, $ny); $FDay = date('w',$mkdate); $pwkDay = date('w',$mkdate);
$days = date('t',$mkdate); $day = '01';  $showBtn=1;  


$monthNum  = $m;
$dateObj   = DateTime::createFromFormat('!m', $monthNum);
$monthName = $dateObj->format('F'); // March


?>
<table style="width:100%;" cellspacing="0">

<tr>
  <td class="monthday" colspan="2"><span onClick="FunMonth('P',<?php echo $nnm.','.$ny;?>)"><u class="btn btn-secondary"  style="font-weight: bold !important;"><< Prev</u> </span></td>
  <td class="monthday" colspan="3" id="calMonth"><?php echo $monthName.' '.$ny; ?></td>
  <td class="monthday" colspan="2"><span onClick="FunMonth('N',<?php echo $nnm.','.$ny;?>)">  <u class="btn btn-secondary" style="font-weight: bold !important;">Next >></u></span></td>
</tr>


<tr>
 <td class="weekday">SUN</td><td class="weekday">MON</td><td class="weekday">TUE</td>
 <td class="weekday">WED</td><td class="weekday">THU</td><td class="weekday">FRI</td>
 <td class="weekday">SAT</td>
</tr>
<tr>
<?php $weeks = '1'; $loopCount ='1'; 
      while($loopCount<=$FDay){ ?><td class="day">&nbsp;</td><?php $loopCount++; } $FDay++;
    while($day<=$days){ //While-Open ?>
      <td class="day" 

        <?php if(date($y."-".$nnm."-".$day)==date("Y-m-d")){?> style="background-color: #abd8f4;"<?php } ?> 
      >



      <?php
                                 
      echo '<b style="font-size:14px;font-weight:bold;color:#2E3131;">'.$day.'</b>';

      $allRemDates=array_column($array, 'i');

      $thisTdDate=date($ny."-".$nnm."-".$day);

      $thisTDRems = array();


      foreach ($allRemDates as $key => $value) {
        if($allRemDates[$key]==$thisTdDate){
          $thisTDRems[$key]=$value;
        }
      }





      foreach ($thisTDRems as $key => $value) {
        
            echo "
            <a href='javascript:void(0)' onclick='showmodel(".$array[$key]['rem_id'].")'>";
                echo '
                <div 
                  style="font-family: Calibri;font-size:11px;padding:1px;border-radius:4px;border:1px solid #c1c1c1; margin-bottom:4px;background-color:';
                  echo getColor($array[$key]['Status'],$array[$key]['priority']); 
                  echo ';"
                >';
                
                    if ($array[$key]['Status']=="Done"){
                      ?>
                      <i class="fa fa-check-circle" aria-hidden="true" style="color:green;font-size:14px;"></i>
                      <?php
                    }
                    echo "<b>".$array[$key]['title']."</b>";
                
                echo "
                </div>";
            echo "
            </a>";
          
      }

      
        // echo $day;
        // $ind = array_search(date($ny."-".$nnm."-".$day), array_column($array, 'i'));
        // if($day>0 &&in_array(date($ny."-".$nnm."-".$day), array_column($array, 'i')))
        // { 
        //   if ($array[$ind]['Status']=="Done") 
        //             {
        //               echo "<a href='calendar.php?id=".$array[$ind]['rem_id']."'>";
        //                 // $result = substr($array[$ind]['description'], 0, 5);
        //                 echo "<br><b style='color:#C0C0C0'>&nbsp;&nbsp;&nbsp;Title: ".$array[$ind]['title']."</b>";
        //                 echo "<br><b style='color:#C0C0C0'>&nbsp;&nbsp;&nbsp;Desc: ".substr($array[$ind]['description'], 0, 5)."</b>";
        //                 echo "</a>";
        //             }
        //             else
        //             {
        //               echo "<a href='calendar.php?id=".$array[$ind]['rem_id']."'>";
        //                 // $result = substr($array[$ind]['description'], 0, 5);
        //                 echo "<br><b>&nbsp;&nbsp;&nbsp;Title: ".$array[$ind]['title']."</b>";
        //                 echo "<br><b>&nbsp;&nbsp;&nbsp;Desc: ".substr($array[$ind]['description'], 0, 5)."</b>";
        //                 echo "</a>";
        //             }
        // }
        // else
        // {
        //   echo '';
        // } 
          ?>
      </td> 
<?php if($FDay == '7'){echo '</tr><tr>'; $FDay='0'; $weeks++;} $day++; $day=sprintf('%02d',$day); $FDay++; 
      } //While-Close ?>
    
<?php $dim=$weeks*7; $lastdays=$dim-($days+$pwkDay); $lc=1; 
      while($lc<=$lastdays){ ?><td class="day">&nbsp;</td><?php $lc++; } ?>
</tr>

  </table>



<?php } 
// else if($_POST['action']=='change_status')
// {
//  $rem_id = $_POST['rem_id'];
//  $uid = $_POST['uid'];
//  $status = $_POST['status'];

//  $q = "UPDATE reminder_participants SET status='1' WHERE rem_id='$rem_id' AND userid='$uid' ";
//  $rq = mysql_query($q,$conn);

//  if ($rq) 
//  {
//    echo "Status Updated";
//  }

// }

else if($_POST['action']=='contact_list')
{ ?>
             <table id="example11" class="table table-bordered table-striped table-responsive table-condensed">
              <thead>
                <tr style="background-color: #e2dede">
                  <th><b>Call</b></th>
                  <th><b>Name</b></th>
                  <th><b>Number</b></th>
                  <th width="1%"></th>
                </tr>
              </thead>
              <tbody>
            <?php
            if (isset($_REQUEST['gid']) && $_REQUEST['gid']!="") 
            {
              $gid = $_REQUEST['gid'];
              $sql = "SELECT * FROM group_contact gc INNER JOIN user u ON gc.userid=u.userid WHERE gc.gid='$gid' AND u.user_varified='Yes' ";
            }
            else
            {
                $sql = "SELECT * FROM user WHERE user_varified='Yes'";
            }
              
              $result = mysql_query($sql,$conn);
              while($row = mysql_fetch_assoc($result))
              { ?>
                <tr>
                <td><a href="tel:<?= $row['ucontact'] ?>"><i class="fa fa-phone" aria-hidden="true"></i> Call</a></td>
                <td><?= $row['ufname'] ?> <?= $row['ulname'] ?></td>
                <td><?= $row['ucontact'] ?></td> 
                <!-- <td><a title="Delete User" href="delete_user_from_contact.php?gid=<?=$gid?>&userid=<?= $row['userid'] ?>" onclick="return confirm('Delete User?')"><i class="fa fa-trash" aria-hidden="true"></i></a></td> -->
                <td><a onclick="delete_contact(<?=$_REQUEST['gid']?>, <?=$row['userid']?>)" title="Delete User" href="#" id="<?= $_REQUEST['gid']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                </tr>
                <input type="hidden" name="gid" value="<?= $_REQUEST['gid'] ?>">
             <?php }

            ?>
              </tbody>
            </table>
<?php
}

else if($_POST['action']=='contact_group')
{ ?>
  
            <?php
            if (isset($_REQUEST['gid']) && $_REQUEST['gid']!="") 
            {
              $gid = $_REQUEST['gid'];
              $user = $_REQUEST['user'];
              //echo "AAA".$user = implode(",", $user);
              // $user = serialize($user);
              $sql = "SELECT * FROM group_contact gc INNER JOIN user u ON gc.userid=u.userid WHERE u.user_varified='Yes' AND gc.gid='$gid' AND u.userid NOT IN ($user)  ";

            }
              
              $result = mysql_query($sql,$conn);
              while($row = mysql_fetch_assoc($result))
              { ?>
                <option selected value="<?= $row['userid'] ?>"><?= $row['ufname'] ?> <?= $row['ulname'] ?></option>';
        <?php }

}

else if($_POST['action']=='delete_group')
{
  if (isset($_REQUEST['gid']) && $_REQUEST['gid']!="") 
  {
    $gid = $_REQUEST['gid'];
    $sql = "DELETE FROM group_table WHERE gid='$gid'  ";
  }
  $result = mysql_query($sql,$conn);
  if ($result) 
  {
    echo "Group Deleted";
  }

}

else if($_POST['action']=='dropdown_data')
{
  if (isset($_REQUEST['gid']) && $_REQUEST['gid']!="") 
  {
    function get_name1($userid)
    {
      $sql = "SELECT * FROM user WHERE userid='".$userid."' ";
      $result = mysql_query($sql);
      $rr = mysql_fetch_assoc($result);
      return $rr['ufname'];
    }
    function get_user_type1($userid)
    {
      $sql = "SELECT * FROM user WHERE userid='".$userid."' ";
      $result = mysql_query($sql);
      $rr = mysql_fetch_assoc($result);
      return $rr['utype'];
    }
    $gid = $_REQUEST['gid'];
    if (get_user_type1($_SESSION['id'])=='A') 
    {
        $sql = "SELECT * FROM user WHERE user_varified='Yes' AND utype!='A' AND userid NOT IN (SELECT userid FROM group_contact WHERE gid='$gid')";  
    }
    else
    {
      $sql = "SELECT * FROM contact_request WHERE request_approve=1 AND request_to NOT IN (SELECT userid FROM group_contact WHERE gid='$gid') AND (request_by='".$_SESSION['id']."' OR  request_to='".$_SESSION['id']."') ";     
    }
    $result = mysql_query($sql,$conn);
    while($row = mysql_fetch_assoc($result))
    {
      if (get_user_type1($_SESSION['id'])=='A') 
      { ?>
        <option value="<?= $row['userid'] ?>"><?=get_name1($row['userid'])?></option>
     <?php }
      else
      { ?>
        <option value="<?= $row['request_to'] ?>"><?=get_name1($row['request_to'])?></option>
      <?php }
    }

  }

}


else if($_POST['action']=='group_name')
{
  if (isset($_REQUEST['gid']) && $_REQUEST['gid']!="") 
  {
    $gid = $_REQUEST['gid'];
    $sql = "SELECT * FROM group_table WHERE gid='$gid' ";
    $result = mysql_query($sql,$conn);
    $row = mysql_fetch_assoc($result);
    {
        echo $row['gname'];
    }
  }

}


else if($_POST['action']=='delete_user_from_contact')
{ 
  if (isset($_REQUEST['gid']) && $_REQUEST['gid']!="" && isset($_REQUEST['userid']) && $_REQUEST['userid']!="") 
  {
    $gid = $_REQUEST['gid'];
    $userid = $_REQUEST['userid'];
    $sql = "DELETE FROM group_contact WHERE gid='$gid' AND userid='$userid' ";
    $result = mysql_query($sql,$conn);
    if ($result) 
    {
      echo "contact deleted";

    }

  } ?>



<?php }

else if($_POST['action']=='delete_user_from_user_page')
{ 
  if (isset($_REQUEST['userid']) && $_REQUEST['userid']!="") 
  {
    $userid = $_REQUEST['userid'];
    $sql = "UPDATE user SET usts='D' WHERE userid='$userid' ";
    $result = mysql_query($sql,$conn);
    if ($result) 
    {
      echo "success";
    }
  } ?>
<?php }

else if($_POST['action']=='refresh_count')
{
  if (isset($_REQUEST['gid']) && $_REQUEST['gid']!="") 
  {
    $sql1 = "SELECT COUNT(userid) as c FROM group_contact WHERE gid=".$_REQUEST['gid'];
    // echo $sql1;
    $result1 = mysql_query($sql1,$conn);
    $row1 = mysql_fetch_assoc($result1);
    echo $row1['c'];
  }

}


else if($_POST['action']=='send_request')
{
  if (isset($_REQUEST['request_to']) && $_REQUEST['request_to']!="") 
  {
    $insert = "INSERT INTO contact_request(request_by, request_to, request_sent, request_approve) VALUES ('".$_SESSION['id']."', '".$_REQUEST['request_to']."', 1, 0)";
      $res = mysql_query($insert, $conn);
      if ($res) 
      {
          /*OTP*/
        $username = "developerinvnr@gmail.com";
        $hash = "736397e8c20036f67d304d4d8ee316720a93c9d9d83046cbb453303194086efa";
        $test = "0";
        $sender = "REMIND";
        // $message = "REM : ".get_name($ulist).", an event on date ".date('Y-m-d', strtotime($_POST["f_date"]))." at ".date('h:i A', strtotime($_POST["f_date"])).".";
        $message = " ".get_name($_SESSION['id'])." sent you contact request. From Reminder";
        $message = urlencode($message);
        $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".get_number($_REQUEST['request_to'])."&test=".$test;
        $ch = curl_init('http://api.textlocal.in/send/?');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch); 
        curl_close($ch);
        /*OTP*/

          ?><button class='btn btn-warning' onclick="cancel_request(<?=$_REQUEST['request_to']?>)">Cancel Request</button><?php
      }
  }
}



else if($_POST['action']=='cancel_request')
{
  $update = "DELETE FROM contact_request WHERE request_by='".$_SESSION['id']."' AND request_to='".$_REQUEST['request_to']."' ";
      $r = mysql_query($update, $conn);
      if ($r) 
      {
          ?><button class='btn btn-primary' onclick="send_request(<?=$_REQUEST['request_to']?>)">Send Request</button><?php
      }
}

else if($_POST['action']=='approve_contact')
{
  $update = "UPDATE contact_request SET request_approve=1 WHERE request_by='".$_POST['request_by']."' AND request_to='".$_SESSION['id']."'   ";
  $r = mysql_query($update, $conn);
  if ($r) 
  {
     echo "success";
  }
}

else if($_POST['action']=='showGroupPeople')
{
  ?>

  <table id="example1" class="table table-bordered table-striped table-responsive table-condensed" cellspacing="0" cellpadding="0">
    <thead>
      <tr style="background-color: #e2dede">
        <th style="text-align:center;font-size:12px;"><b>Action</b></th>
        <th style="text-align:center;font-size:12px;"><b>Name</b></th>
        <th style="text-align:center;font-size:12px;"><b>Contact</b></th>
        <th style="text-align:center;font-size:12px;"><b>Email</b></th>
        <!--<th style="text-align:center;font-size:12px;"><b>Gender</b></th>
        <th style="text-align:center;font-size:12px;"><b>DOB</b></th>
        <th style="text-align:center;font-size:12px;"><b>Marital</b></th>-->
        <th style="text-align:center;font-size:12px;"><b>Varified</b></th>
      </tr>
    </thead>
    <tbody>
      <?php 
        if (isset($_REQUEST['gid']) && $_REQUEST['gid']!="") 
        {
          $gid = $_REQUEST['gid'];
          $sql = "SELECT * FROM group_contact gc INNER JOIN user u ON gc.userid=u.userid WHERE gc.gid='$gid' AND usts='A' ";
        }
        else
        {
            $sql = "SELECT * FROM user WHERE usts='A'";
        }
          
        
        $result = mysql_query($sql,$conn);
        while($row = mysql_fetch_assoc($result))
        {
          echo "<tr>";
        ?>
        <td style="text-align:center;font-size:12px;">
          <a href="users.php?update=<?php echo $row['userid']; ?>" title="Edit User Detail" href=""><img src="images/edit.png"></a>
          <a title="View Detail" href="users.php?view=<?php echo $row['userid']; ?>"><img src='images/view.png'></a>
          <a onClick="delete_user('<?=$row['userid']?>')" title="Delete User" href="#"><img src='images/delete.png'></a>
        </td>
        <?php
          echo "<td style='font-size:12px;'>".ucfirst($row['ufname'])." ".ucfirst($row['ulname'])."</td>";
          echo "<td style='text-align:center;font-size:12px;'>".$row['ucontact']."</td>";
          echo "<td style='font-size:12px;'>".$row['uemail']."</td>";
          /*if ($row['ugender']==""){ echo "<td style='text-align:center;font-size:12px;'>NONE</td>"; } else{ echo "<td style='text-align:center;font-size:12px;'>".$row['ugender']."</td>"; }

          if ($row['udob']=='0000-00-00'){ echo "<td style='text-align:center;font-size:12px;'>NONE</td>";}else{ echo "<td style='text-align:center;font-size:12px;'>".date('d-m-Y', strtotime($row['udob']))."</td>";}
          if ($row['marital_status']==""){ echo "<td style='text-align:center;font-size:12px;'>NONE</td>";}else{echo "<td style='text-align:center;font-size:12px;'>".$row['marital_status']."</td>";}*/
          if($row['user_varified']=="Yes"){echo "<td style='text-align:center;font-size:12px;'><span class=' badge bg-green'>Yes<span></td>";}else{echo "<td style='text-align:center;font-size:12px;'><span class=' badge bg-red'>No<span></td>";}
          echo "</tr>";
        }
      ?>
    </tbody>
    <tfoot>
      <tr style="background-color: #e2dede">
        <th style='text-align:center;font-size:12px;'><b>Action</b></th>
        <th style='text-align:center;font-size:12px;'><b>Name</b></th>
        <th style='text-align:center;font-size:12px;'><b>Contact</b></th>
        <th style='text-align:center;font-size:12px;'><b>Email</b></th>
        <!--<th style='text-align:center;font-size:12px;'><b>Gender</b></th>
        <th style='text-align:center;font-size:12px;'><b>DOB</b></th>
        <th style='text-align:center;font-size:12px;'><b>Marital Status</b></th>-->
        <th style='text-align:center;font-size:12px;'><b>Varified</b></th>
      </tr>
    </tfoot>
  </table>

  <?php
}

?>