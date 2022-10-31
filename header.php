<header class="main-header">
 <!-- Logo -->
 <a href="home.php" class="logo">
  <!-- mini logo for sidebar mini 50x50 pixels -->
  <span class="logo-mini"><img src="images/minimal.png" alt=""></span>
  <!-- logo for regular state and mobile devices -->
  <span class="logo-lg"><b>Surta </b><i class="fa fa-bell-o" aria-hidden="true"></i></span>
 </a>
	
 <!-- Header Navbar-->
 <nav class="navbar navbar-static-top">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
  <span class="sr-only">Toggle navigation</span>
  </a>
      
	  <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
		


          <!-- Messages-->
          <?php 
          if(get_user_type1($_SESSION['id'])=='A')
          {
            $sql1 = "SELECT * FROM user_notification";
          }
          else
          {
            $sql1 = "SELECT * FROM user_notification n INNER JOIN user_notification_user nu ON nu.nid=n.nid WHERE nu.userid=".$_SESSION['id'];
          }
          $result1 = mysql_query($sql1,$conn);
          if (mysql_num_rows($result1) > 0)
          { ?>
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell"></i>
            </a>
            <ul class="dropdown-menu scale-up">
              <li class="header">Notification</li>
              <li>
                <ul class="menu inner-content-div">
                    <?php
                    
                    if (mysql_num_rows($result1) > 0)
                    {
                      while($row1 = mysql_fetch_assoc($result1))
                      { ?>
                          <li>
                          <a href="read_notification.php?nid=<?=$row1['nid']?>">
                            <div class="pull-left">
                            <!-- <img src="<?=get_image1($row1['request_by'])?>" class="rounded-circle"> -->
                            </div>
                            <div class="mail-contnet">
                            <h4><?=get_name1($row1['created_by'])?></h4>
                            <span><?=date('d-m-Y', strtotime($row1['created_at']))?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?=date('H:i A', strtotime($row1['created_at']))?></span>
                            </div>
                          </a>
                        </li>
                          
                     <?php }
                    }
                    else
                    { ?>
                        <li>
                          <a href="#">
                            <div class="mail-contnet">
                            <h4>
                              No New Notification..!
                            </h4>
                            </div>
                          </a>
                        </li>
                  <?php }
                    ?>
                </ul>
              </li>
              <li class="footer"><a href="#">Close</a></li>
            </ul>
          </li>

        <?php } ?>
          <!-- message -->




          <!-- Messages-->
          <?php
                    $sql1 = "SELECT * FROM contact_request WHERE request_approve=0  AND request_to='".$_SESSION['id']."' ";
                    $result1 = mysql_query($sql1,$conn);
                    if (mysql_num_rows($result1) > 0)
                    { ?>
          <li class="dropdown messages-menu" <?php if (get_user_type1($_SESSION['id'])=='A'){echo "style='display:none'";}?>>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-phone"></i>
            </a>
            <ul class="dropdown-menu scale-up">
              <li class="header">Contact Requests</li>
              <li>
                <ul class="menu inner-content-div">
                    <?php
                    $sql1 = "SELECT * FROM contact_request WHERE request_approve=0  AND request_to='".$_SESSION['id']."' ";
                    $result1 = mysql_query($sql1,$conn);
                    if (mysql_num_rows($result1) > 0)
                    {
                      while($row1 = mysql_fetch_assoc($result1))
                      { ?>
                          <li>
                          <a href="#" onclick="conf1(<?=$row1['request_by']?>)">
                            <div class="pull-left">
                            <img src="<?=get_image1($row1['request_by'])?>" class="rounded-circle">
                            </div>
                            <div class="mail-contnet">
                            <h4><?=get_name1($row1['request_by'])?></h4>
                            <span><?=date('d-m-Y', strtotime($row1['created_at']))?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?=date('H:i A', strtotime($row1['created_at']))?></span>
                            </div>
                          </a>
                        </li>
                          
                     <?php }
                    }
                    else
                    { ?>
                        <li>
                          <a href="#">
                            <div class="mail-contnet">
                            <h4>
                              No Contact Request..!
                            </h4>
                            </div>
                          </a>
                        </li>
                  <?php }
                    ?>
                </ul>
              </li>
              <li class="footer"><a href="#">Close</a></li>
            </ul>
          </li>
        <?php } ?>
          <!-- message -->







           <!-- Messages-->
           <?php
            $sql = "SELECT * FROM user WHERE user_varified='Yes' AND MONTH(Anniversary) = MONTH(NOW()) AND Anniversary!='1970-01-01' AND Anniversary!='0000-00-00'  ORDER BY udob ASC";
            $result = mysql_query($sql,$conn);
            if (mysql_num_rows($result) > 0)
            { ?>
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-gift"></i>
            </a>
            <ul class="dropdown-menu scale-up">
              <li class="header">Upcoming Anniversaries</li>
              <li>
                <ul class="menu inner-content-div">
                  <!-- start message -->
                    <?php
                    $sql = "SELECT * FROM user WHERE user_varified='Yes' AND MONTH(Anniversary) = MONTH(NOW()) AND Anniversary!='1970-01-01' AND Anniversary!='0000-00-00'  ORDER BY udob ASC";
                    $result = mysql_query($sql,$conn);
                    if (mysql_num_rows($result) > 0)
                    {
                      while($row1 = mysql_fetch_assoc($result))
                      {

                       ?>
                        <li>
                            <?php
                              $sql1 = "SELECT * FROM contact_request WHERE request_approve=1 AND (request_by='".$row1['userid']."' OR request_to='".$row1['userid']."') ";
                              $result1 = mysql_query($sql1);
                              // echo mysql_num_rows($result1);
                              if (mysql_num_rows($result1)) 
                              { ?>
                                <a href='tel: <?=$row1['ucontact']?>'>
                             <?php }
                             else
                             { ?>
                                <a href="#">
                            <?php }
                            ?>
                            <div class="pull-left">
                            <img src="<?php if($row1['profile_pic']!=""){echo $row1['profile_pic'];}else{echo "profile_pics/default.png";}?>" class="rounded-circle">
                            </div>
                            <div class="mail-contnet">
                            <h4>
                              <?=$row1['ufname']," ",$row1['ulname']?>
                            <!-- <small><i class="fa fa-clock-o"></i> 15 mins</small> -->
                            </h4>
                            <span><?=date('d-m-Y', strtotime($row1['Anniversary']))?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?=$row1['ucontact']?></span>
                            </div>
                          </a>
                        </li>
                          
                     <?php }
                    }
                    else
                    { ?>
                        <li>
                          <a href="#">
                            <div class="mail-contnet">
                            <h4>
                              No current Anniversaries..!
                            </h4>
                            </div>
                          </a>
                        </li>
                  <?php }
                    ?>
                  <!-- end message -->
                </ul>
              </li>
              <li class="footer"><a href="#">Close</a></li>
            </ul>
          </li>
        <?php } ?>
          <!-- message -->



          <!-- Messages-->
          <?php
          $sql1 = "SELECT * FROM user WHERE user_varified='Yes' AND MONTH(udob) = MONTH(NOW()) ORDER BY udob ASC";
          $result1 = mysql_query($sql1,$conn);
          if (mysql_num_rows($result1) > 0)
          { ?>
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-birthday-cake"></i>
            </a>
            <ul class="dropdown-menu scale-up">
              <li class="header">Upcoming Birtdays</li>
              <li>
                <ul class="menu inner-content-div">
                  <!-- start message -->
                    <?php
                    $sql1 = "SELECT * FROM user WHERE user_varified='Yes' AND MONTH(udob) = MONTH(NOW()) ORDER BY udob ASC";
                    $result1 = mysql_query($sql1,$conn);
                    if (mysql_num_rows($result1) > 0)
                    {
                      while($row1 = mysql_fetch_assoc($result1))
                      { ?>
                        <li>
                          <a href="tel: <?=$row1['ucontact']?>">
                            <?php
                              $sql = "SELECT * FROM contact_request WHERE request_approve=1 AND (request_by='".$row1['userid']."' OR request_to='".$row1['userid']."') ";
                              $result = mysql_query($sql);
                              if (mysql_num_rows($result)) 
                              { ?>
                                <a href='tel: <?=$row1['ucontact']?>'>
                             <?php }
                             else
                             { ?>
                                <a href="#">
                            <?php }
                            ?>
                            <div class="pull-left">
                            <img src="<?php if($row1['profile_pic']!=""){echo $row1['profile_pic'];}else{echo "profile_pics/default.png";}?>" class="rounded-circle">
                            </div>
                            <div class="mail-contnet">
                            <h4>
                              <?=$row1['ufname']," ",$row1['ulname']?>
                            <!-- <small><i class="fa fa-clock-o"></i> 15 mins</small> -->
                            </h4>
                            <span><?=date('d-m-Y', strtotime($row1['udob']))?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?=$row1['ucontact']?></span> <span></span>
                            </div>
                          </a>
                        </li>
                          
                     <?php }
                    }
                    else
                    { ?>
                        <li>
                          <a href="#">
                            <div class="mail-contnet">
                            <h4>
                              No current birthday..!
                            </h4>
                            </div>
                          </a>
                        </li>
                  <?php }
                    ?>
                  <!-- end message -->
                </ul>
              </li>
              <li class="footer"><a href="#">Close</a></li>
            </ul>
          </li>
        <?php } ?>
          <!-- message -->



		  <!-- User Account Open -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <?php
                include "config.php";
                $sql1 = "SELECT * FROM user WHERE userid =".$_SESSION['id'];
                $result1 = mysql_query($sql1,$conn);
                $row = mysql_fetch_assoc($result1);
                echo $row['ufname']." ".$row['ulname'];
              ?>
            </a>
            <ul class="dropdown-menu scale-up" style="background-color:#0070DF;">
              <!-- User image -->
			  
              <li class="user-header">
			    <!-- <img src="images/user.jpg" class="float-left rounded-circle" alt="User Image"> -->


          <?php
    $sql = "SELECT * FROM user WHERE profile_pic!='' AND userid=".$_SESSION['id'];
    $result = mysql_query($sql,$conn);
    if (mysql_num_rows($result)>0) 
    { 
      $row = mysql_fetch_assoc($result);
      ?>
      <img id="cdpimg" class="float-left rounded-circle" src="<?= $row['profile_pic'] ?>" alt="User profile picture" />
  <?php  }
    else
    { ?>
        <img id="cdpimg" class="float-left rounded-circle" src="images/user.jpg" alt="User profile picture"/>
  <?php  }

  ?>

                <p>
                  <?php
                    echo $_SESSION['ufname']." ".$_SESSION['ulname'];
                  ?>
                  <small class="mb-5">
                    <?php
                      echo $_SESSION['uemail'];
                    ?>
                  </small>
                  <a href="profile.php" class="btn btn-danger btn-sm" style="display: inline;"><i class="ion ion-person"></i> Profile</a>

                  <a style="display: inline;" href="logout.php" class="btn btn-sm btn-danger"><i class="ion ion-power"></i> Log Out</a>
                </p>
              </li>
            </ul>
          </li>
	
        </ul>
      </div>
    </nav>
  </header>



<?php
  function get_user_type1($userid)
  {
    $sql = "SELECT * FROM user WHERE userid='".$userid."' ";
    $result = mysql_query($sql);
    $rr = mysql_fetch_assoc($result);
    return $rr['utype'];
  } 
  function get_name1($userid)
  {
    $sql = "SELECT * FROM user WHERE userid='".$userid."' ";
    $result = mysql_query($sql);
    $rr = mysql_fetch_assoc($result);
    return $rr['ufname'];
  }
  function get_image1($userid)
  {
    $sql = "SELECT * FROM user WHERE userid='".$userid."' ";
    $result = mysql_query($sql);
    $rr = mysql_fetch_assoc($result);
    return $rr['profile_pic'];
  }
?>
<script type="text/javascript">
  function conf1(request_by)
  {
    swal({   
        title: "Are you sure?",   
        text: "Do you really want to give your contact permission..!",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, confirm it!",   
        closeOnConfirm: false 
    }, function(){  
        $.post("getajax.php",{action:'approve_contact',request_by:request_by}, function(data){
            if(data=="success")
            {
              swal("Success!", "Your contact is being shared with user.", "success"); 
              setTimeout(function(){location.reload()}, 2000); 
            }
        });
    });
  }
</script>