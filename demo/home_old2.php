<?php include('common_function.php'); ?>
<?php
    session_start();
    if (!isset($_SESSION['id']))
    {
        header('Location: index.php');
    } 
    include "config.php";   
    $sid = $_SESSION['id'];
    $uu = $_SESSION['id'];

    if (isset($_POST['rate_n_close']) && $_POST['rate_n_close']!="" ) 
    {
      $update = "UPDATE reminder SET activity='D' WHERE rem_id='".$_POST['close_rem_id']."' ";
      $rrr = mysql_query($update,$conn);
      if ($rrr) 
      {
        echo "<script>window.location='home.php?rem_delete=success';</script>";
      } 
    }
    elseif (isset($_POST['forward_rem'])) 
    {
      // echo "<script>alert('hello')</script>";
      $aa = "INSERT INTO forward_rem(rem_id, froward_by) VALUES('".$_POST['rem_id']."', '".$_SESSION['id']."')";
      $res= mysql_query($aa, $conn);
      $last_key = mysql_insert_id($conn);
      if($res) 
      {
        foreach ($_POST['forward_parti'] as $key) 
        {
          $a = "INSERT INTO forward_user(rm_id, userid) VALUES('".$last_key."', '".$key."')";
          mysql_query($a, $conn);

          $b = "INSERT INTO reminder_participants(rem_id, userid, forwarded) VALUES('".$_POST['rem_id']."', '".$key."', '1')";
          mysql_query($b, $conn);
        }
      }
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" href="images/favicon.png">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title><?php include("tital.php"); ?></title>
<link rel="stylesheet" href="assets/vendor_components/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/vendor_components/bootstrap/dist/css/bootstrap-extend.css">
<link rel="stylesheet" href="assets/vendor_components/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/vendor_components/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="css/master_style.css">
<link rel="stylesheet" href="css/skins/_all-skins.css">
<link rel="stylesheet" href="css/jquery.datetimepicker.css">  
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
<script src="js/sweetalert.js"></script>
<link rel="stylesheet" href="css/sweetalert.css">
<style type="text/css">
  

.result-container{
  width: 82px; height: 18px;
  position: relative;
  background-color: #ccc;
  border: #ccc 1px solid;
  margin:auto;
}
.rate-stars{
  width: 82px; height: 18px;
  background: url(rate-stars.png) no-repeat;
  position: absolute;
}
.rate-bg{
  height: 18px;
  background-color: #ffbe10;
  position: absolute;
}


  .rate
  {
  width:400px; 
  height: 40px;
  border:#e9e9e9 1px solid;
  background-color:  #f6f6f6;
  /*margin:60px auto;*/
  margin-top:2px;
  }
  .rate .rate-btn{
  width: 45px; height:40px;
  float: left;
  background: url(rate-btn.png) no-repeat center center;
  cursor: pointer;
  margin-top: -1px;
  }
  .rate .rate-btn:hover, .rate  .rate-btn-hover, .rate  .rate-btn-active{
    background: url(rate-btn-hover.png) no-repeat center center;
    width: 45px; height:40px;
  }



@media screen and (max-width: 480px){
  .rate{
    width:280px; 
    height: 40px;
    border:#e9e9e9 1px solid;
    background-color:  #f6f6f6;
    margin-bottom:0px;
  }
  .rate .rate-btn{
    width: 28px; height:30px;
    float: left;
    background: url(rate-btn.png) no-repeat center center;
    cursor: pointer;
    margin-top: 5px;
    }
  .rate .rate-btn:hover, .rate  .rate-btn-hover, .rate  .rate-btn-active{
    background: url(rate-btn-hover.png) no-repeat center center;
    width: 28px; height:30px;
  }


}

  blockquote:not(:first-child) 
  {
      margin-top:30px;
  }
  blockquote{
  display:block;
  /*background: #fff;*/
  padding: 3px 3px 3px 3px;
  margin: 0 0 -27px;
  position: relative;
  
  /*Font*/
  font-family: Georgia, serif;
  font-size: 14px;
  line-height: 1.2;
  color: #666;

  /*Box Shadow - (Optional)*/
  -moz-box-shadow: 2px 2px 15px #ccc;
  -webkit-box-shadow: 2px 2px 15px #ccc;
  box-shadow: 2px 2px 15px #ccc;

  /*Borders - (Optional)*/
  border-left-style: solid;
  border-left-width: 0px;
  border-right-style: solid;
  border-right-width: 0px;    
}


blockquote a{
  text-decoration: none;
  background: #eee;
  cursor: pointer;
  padding: 0 3px;
  color: #c76c0c;
}

blockquote a:hover{
 color: #666;
}

blockquote em{
  font-style: italic;
}

  /*Default Color Palette*/
blockquote.default{ 
  border-left-color: #656d77;
  border-right-color: #434a53;  
}

blockquote.white{ 
  border-left-color: #FFFFFF;
  border-right-color: #FFFFFF;  
}

/*Grapefruit Color Palette*/
blockquote.grapefruit{
  border-left-color: #ed5565;
  border-right-color: #da4453;
}

/*Bittersweet Color Palette*/
blockquote.bittersweet{
  border-left-color: #fc6d58;
  border-right-color: #e95546;
}

/*Sunflower Color Palette*/
blockquote.sunflower{
  border-left-color: #ffcd69;
  border-right-color: #f6ba59;
}

/*Grass Color Palette*/
blockquote.grass{
  border-left-color: #9fd477;
  border-right-color: #8bc163;
}

/*Mint Color Palette*/
blockquote.mint{
  border-left-color: #46cfb0;
  border-right-color: #34bc9d;
}

/*Aqua Color Palette*/
blockquote.aqua{
  border-left-color: #4fc2e5;
  border-right-color: #3bb0d6;
}

/*Blue Jeans Color Palette*/
blockquote.bluejeans{
  border-left-color: #5e9de6;
  border-right-color: #4b8ad6;
}

/*Lavander Color Palette*/
blockquote.lavander{
  border-left-color: #ad93e6;
  border-right-color: #977bd5;
}

/*Pinkrose Color Palette*/
blockquote.pinkrose{
  border-left-color: #ed87bd;
  border-right-color: #d870a9;
}

/*Light Color Palette*/
blockquote.light{
  border-left-color: #f5f7fa;
  border-right-color: #e6e9ed;
}

/*Gray Color Palette*/
blockquote.gray{
  border-left-color: #ccd1d8;
  border-right-color: #aab2bc;
}
</style>
</head>

<body class="hold-transition skin-yellow-light sidebar-mini">
<div class="wrapper">

<?php include("header.php"); ?>
  
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar -->
    <section class="sidebar">
<?php include("menu.php"); ?>
    </section>
    <!-- /.sidebar -->
  </aside>

  <div class="content-wrapper" style="margin-top: -20px;">
    <section class="content-header">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content Open -->
    <section class="content">
      <div class="row">
        <style type="text/css">
          .fa-2x {
    font-size: 1.5em;
}
        </style>
        




      <!-- /.col -->
        
<!-- Col 11111111111111111111111111111111111111111111111111111111111111111111111111111111 Open --> 
<?php $sql2 = "SELECT * FROM reminder_participants rp INNER JOIN reminder r ON r.rem_id=rp.rem_id WHERE r.activity='A' AND rp.userid=".$_SESSION['id']; $result2 = mysql_query($sql2,$conn);
              if (mysql_num_rows($result2) >0)
              {
?>       
        <div class="col-md-12 col-lg-4" style="margin-top: -20px;">
          <div class="box box-default">
              <div style="background-color:#E9A70C;height:30px;padding:4px;color:#FFF; font-size:12px;"><span class="pull-left">My Task</span><a class="pull-right " href="public_reminder.php" style="color: white"><span class="fa fa-plus-square fa-2x"></span></a></div>
            <div class="box-body" style="min-height:60px; max-height: 210px; overflow-y:scroll;">  

            <?php while($row2 = mysql_fetch_assoc($result2))
                  { ?>

                    <a style="background-color: red" href='home.php?id=<?=$row2['rem_id']?>'><blockquote>
                     <p style="background-color: <?php if($row2['priority']=='Low'){echo " rgb(168, 255, 81)";}elseif($row2['priority']=='KMedium'){echo "rgb(255, 255, 100)";}else{echo " rgb(255, 40, 40)";} ?>; padding: 2px" class='card-text' style='font-size:12px; margin-top:-10px;'><b style='color:<?php if($row2['priority']=='Low'){echo "blue";}elseif($row2['priority']=='KMedium'){echo "blue";}else{echo "#FFFF00";} ?>'>Title : </b><span style="color: <?php if($row2['priority']=='Low'){echo "black";}elseif($row2['priority']=='KMedium'){echo "black";}else{echo "white";} ?>"><?=$row2['title']?></span><br><b style='color:<?php if($row2['priority']=='Low'){echo "blue";}elseif($row2['priority']=='KMedium'){echo "blue";}else{echo "#FFFF00";} ?>'>Date : </b><span style="color: <?php if($row2['priority']=='Low'){echo "black";}elseif($row2['priority']=='KMedium'){echo "black";}else{echo "white";} ?>"><?=date('d-M', strtotime($row2['from_date']))?> <?=date('y  h:i A', strtotime($row2['from_date']))?>,</span> <b style='color:<?php if($row2['priority']=='Low'){echo "blue";}elseif($row2['priority']=='KMedium'){echo "blue";}else{echo "#FFFF00";} ?>'>Created By : </b><span style="color: <?php if($row2['priority']=='Low'){echo "black";}elseif($row2['priority']=='KMedium'){echo "black";}else{echo "white";} ?>"><?=get_name($row2['created_by']);?> </span></p> </blockquote></a>
                    <hr style="border-color: white">

              <?php }
              
              /*if (mysql_num_rows($result2)==0)
              {
                echo "<center><img src='images/notdatafound.png' class='img img-responsive' height=50 width=50></center>";
              }*/
            ?>           
                   
              </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
<?php    } //if (mysql_num_rows($result2) >0) ?>		
<!-- Col 11111111111111111111111111111111111111111111111111111111111111111111111111111111 Close -->







<!-- Col 222222222222222222222222222222222222222222222222222222222222222222222222222 Open-->
<?php $sql1 = "SELECT * FROM reminder WHERE type!='Personal' AND activity='A' AND created_by=".$_SESSION['id'];
                   $result1 = mysql_query($sql1,$conn);           
                    if (mysql_num_rows($result1) > 0)
                    {
?>					
        <div class="col-md-12 col-lg-4" style="margin-top: -20px;">
          <div class="box box-default">
              <div style="background-color:#E9A70C;height:30px;padding:4px;color:#FFF;font-size:12px;">
              <span class="pull-left">Given Task</span><a class="pull-right " href="public_reminder.php" style="color: white"><span class="fa fa-plus-square fa-2x"></span></a> </div>
            <div class="box-body" style="min-height:60px; max-height: 210px; overflow-y:scroll;">             
                  <?php  
                      while($row1 = mysql_fetch_assoc($result1))
                      { ?>
                        <a style="background-color: red" href='home.php?id=<?=$row1['rem_id']?>'><blockquote>
                        <p style="background-color: <?php if($row1['priority']=='Low'){echo "rgb(168, 255, 81)";}elseif($row1['priority']=='KMedium'){echo "rgb(255, 255, 100)";}else{echo " rgb(255, 40, 40)";} ?>; padding: 2px" class='card-text' style='font-size:10px; margin-top:-10px;'><b style='color:<?php if($row1['priority']=='Low'){echo "blue";}elseif($row1['priority']=='KMedium'){echo "blue";}else{echo "#FFFF00";} ?>; font-size:12px;'>Title : </b>
						
						<span style="color: <?php if($row1['priority']=='Low'){echo "black";}elseif($row1['priority']=='KMedium'){echo "black";}else{echo "white";} ?>;font-size:12px;"><?=$row1['title']?></span><br>
						
						<b style='color:<?php if($row1['priority']=='Low'){echo "blue";}elseif($row1['priority']=='KMedium'){echo "blue";}else{echo "#FFFF00";} ?>;font-size:12px;'>Date : </b><span style="color: <?php if($row1['priority']=='Low'){echo "black";}elseif($row1['priority']=='KMedium'){echo "black";}else{echo "white";} ?>;font-size:12px;"><?=date('d-M', strtotime($row1['from_date']))?> <?=date('y H:i A', strtotime($row1['from_date']))?>,</span> 
						
						<b style='color:<?php if($row1['priority']=='Low'){echo "blue";}elseif($row1['priority']=='KMedium'){echo "blue";}else{echo "#FFFF00";} ?>;font-size:12px;'>CrBy :</b> <span style="color: <?php if($row1['priority']=='Low'){echo "black";}elseif($row1['priority']=='KMedium'){echo "black";}else{echo "white";} ?>;font-size:12px;"><?=get_name($row1['created_by']);?></span> </p></blockquote></a>
                        <hr style="border-color: white">
                    <?php }
                    
                    /*else
                    {
                      echo "<center><img src='images/notdatafound.png' class='img img-responsive' height=70 width=70></center>";
                    }*/
                    ?>
              </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
<?php } //if (mysql_num_rows($result1) > 0) ?>
<!-- Col 22222222222222222222222222222222222222222222222222222222222222222222222222 Close-->



<!-- Col 33333333333333333333333333333333333333333333333333333333333333333333333333 Open-->
<?php $sql = "SELECT * FROM my_note WHERE created_by=".$_SESSION['id'];
                    $result = mysql_query($sql,$conn);
                    if (mysql_num_rows($result) > 0)
                    { 
?>					
        <div class="col-md-12 col-lg-4" style="margin-top: -20px;">
          <div class="box box-default">
              <div style="background-color:#E9A70C;height:30px;padding:4px;color:#FFF;font-size:12px;">
                <span class="pull-left">My Note</span><a class="pull-right " href="my_note.php" style="color: white"><span class="fa fa-plus-square fa-2x"></span></a>
              </div>
              <div class="box-body" style="min-height:60px max-height:250px;overflow-y:scroll;">             
                  <?php
                      while($row = mysql_fetch_assoc($result))
                      { ?>

                         <a style="background-color: red" href='home.php?noteid=<?=$row['id']?>'><blockquote>
                        <p style="background-color: white; padding: 2px" class='card-text' style='font-size:10px; margin-top:-10px;'><b style='color:blue;'>Title : </b><?=$row['title']?><br><b style='color:blue'>Date : </b><?=date('d-M-y H:i A', strtotime($row['created_at']))?></p> </blockquote></a><hr style="border-color: white">

                     <?php }
                    
                    /*else
                    {
                      // echo "<hr><h3>No Data found</h3><hr>";
                      echo "<center><img src='images/notdatafound.png' class='img img-responsive' height=70 width=70></center>";
                    }*/
                  ?>
              </div>
          </div>
        </div>
<?php } //if (mysql_num_rows($result) > 0) ?>		
<!-- Col 33333333333333333333333333333333333333333333333333333333333333333333333333 Close-->


        
        <div class="col-md-12 col-lg-3" style="display: none;" style="margin-top: -20px;">
          <div class="box box-default">
              <div style="background-color:#E9A70C;height:25px;padding:3px;color:#FFF;">Birthdays & Anniversaries</div>
            <div class="box-body" style="min-height:60px; max-height: 210px; overflow-y:scroll;" id="scroll">             
                  
                  <?php
                    $sql1 = "SELECT * FROM user WHERE user_varified='Yes' AND MONTH(udob) = MONTH(NOW()) ORDER BY udob ASC";
                    $result1 = mysql_query($sql1,$conn);

                    $sql = "SELECT * FROM user WHERE user_varified='Yes' AND MONTH(Anniversary) = MONTH(NOW()) ORDER BY udob ASC";
                    $result = mysql_query($sql,$conn);


                    if (mysql_num_rows($result1) > 0 || mysql_num_rows($result) > 0)
                    {
                      while($row1 = mysql_fetch_assoc($result1))
                      {
                          echo "<blockquote class='white'><p><b><i class='fa fa-user'></i> </b>".$row1['ufname']." ".$row1['ulname']."</p>";
                          
                          echo "<p class='card-text' style='font-size:12px; margin-top:-10px'>
                          <a href='tel:".$row1['ucontact']."'><i class='fa fa-phone'></i> ".$row1['ucontact']."</a>
                          

                          &nbsp;&nbsp;&nbsp;<b><i class='fa fa-birthday-cake'></i></b> ".date('d-m-Y', strtotime($row1['udob']))."</p> </blockquote>";
                          // echo "<hr>";
                      }
                      while($row = mysql_fetch_assoc($result))
                      {
                          echo "<blockquote style='margin-top:30px;' class='white'><p><b><i class='fa fa-user'></i></b> ".$row['ufname']." ".$row['ulname']."</p>";

                          echo "<p class='card-text' style='font-size:12px; margin-top:-10px'>
                          <a href='tel:".$row['ucontact']."'><i class='fa fa-phone'></i> ".$row['ucontact']."</a>

                          &nbsp;&nbsp;&nbsp;<b><i class='fa fa-gift'></i></b> ".date('d-m-Y', strtotime($row['Anniversary']))."</p> </blockquote>";
                          // echo "<hr>";
                      }
                      echo "<br>";
                    }
                    else
                    {
                      echo "<center><img src='images/notdatafound.png' class='img img-responsive' height=70; width=70></center>";
                    }
                  ?>
              </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        
      </div>
      <!-- /.row -->
    
    <?php
    $sql = "SELECT count(rem_id) as i FROM reminder WHERE activity='A' ";
    $result = mysql_query($sql,$conn);
    $row = mysql_fetch_assoc($result);
    $total = $row['i'];

    $sql1 = "SELECT count(rem_id) as j FROM reminder WHERE activity='A' AND Status='Pending' ";
    $result1 = mysql_query($sql1,$conn);
    $row1 = mysql_fetch_assoc($result1);
    $pending = $row1['j'];

    $complete = $total-$pending; 


// user task detail | user task detail | user task detail | user task detail | user task detail | user task detail | 


     $total_user = "SELECT * from reminder r INNER JOIN reminder_participants rp ON r.rem_id=rp.rem_id WHERE r.activity='A' AND (r.created_by='".$_SESSION['id']."' || rp.userid='".$_SESSION['id']."' ) GROUP BY r.rem_id";


    $user_result = mysql_query($total_user,$conn);
    $user_total = mysql_num_rows($user_result);
    

    $user_sql2 = "SELECT * from reminder r INNER JOIN reminder_participants rp ON r.rem_id=rp.rem_id WHERE r.activity='A' AND (r.created_by='".$_SESSION['id']."' || rp.userid='".$_SESSION['id']."' ) AND r.Status='Done' GROUP BY r.rem_id";


    $user_result2 = mysql_query($user_sql2,$conn);
    $user_complete = mysql_num_rows($user_result2);
    

    $user_pending = $user_total-$user_complete;

// user task detail | user task detail | user task detail | user task detail | user task detail | user task detail | 

    

  ?>
    
    <div class="row">
        <div data-toggle="modal" data-target="#tot_task" class="col-xl-3 col-md-6 col-12" style="margin-top: -20px;">
          <div class="info-box">
            <span class="info-box-icon push-bottom bg-orange"><i class="fa fa-tasks"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Task</span>
              <span class="info-box-number"><?=$user_total?></span>
              <!-- <span class="info-box-number"><?php if ($_SESSION['utype']=="A"){echo $total;}else{echo $user_total;} ?></span> -->
              <div class="progress">
                <div class="progress-bar bg-orange" style="width:100%;"></div>
              </div>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div data-toggle="modal" data-target="#com_task" class="col-xl-3 col-md-6 col-12" style="margin-top: -20px;">
          <div class="info-box">
            <span class="info-box-icon push-bottom bg-green"><i class="fa fa-check-circle-o"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Complete</span>
              <span class="info-box-number"><?=$user_complete?></span>
              <!-- <span class="info-box-number"><?php if ($_SESSION['utype']=="A"){echo $complete;}else{echo $user_complete;} ?></span> -->
              <div class="progress">
                <div class="progress-bar bg-orange" style="width: 
                <?php
                  if ($_SESSION['utype']=="A")
                  {
                    $per_complete = ($complete/$total)*100;
                    echo $per_complete = number_format($per_complete, 2);echo "%";
                  }
                  else
                  {
                    $per_complete = ($user_complete/$user_total)*100;
                    echo $per_complete = number_format($per_complete, 2);echo "%";
                  }
                ?>
                "></div>
                
              </div>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div data-toggle="modal" data-target="#pen_task" class="col-xl-3 col-md-6 col-12" style="margin-top: -20px;">
          <div class="info-box">
            <span class="info-box-icon push-bottom bg-blue"><i class="fa fa-outdent"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Pending</span>
              <span class="info-box-number"><?=$user_pending?></span>
              <!-- <span class="info-box-number"><?php if ($_SESSION['utype']=="A"){echo $pending;}else{echo $user_pending;} ?></span> -->
              <div class="progress">
                <div class="progress-bar bg-orange" style="width:
                <?php
                  if ($_SESSION['utype']=="A")
                  {
                    $per_pending = ($pending/$total)*100;
                    echo $per_pending = number_format($per_pending,2);echo "%";
                  }
                  else
                  {
                    $per_pending = ($user_pending/$user_total)*100;
                    echo $per_pending = number_format($per_pending,2);echo "%";
                  }
                ?>
                ;"></div>
              </div>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-xl-3 col-md-6 col-12" style="margin-top: -20px;">
          <div class="info-box">
            <span class="info-box-icon push-bottom bg-yellow"><i class="fa fa-times"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Drop</span>
              <span class="info-box-number">0</span>
              <div class="progress">
                <div class="progress-bar bg-orange" style="width:0%;"></div>
              </div>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      
  </section>
    <!-- Main content Close -->
  </div>
  
  
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <?php include("footer.php"); ?>
  </footer>
  
  <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
  
</div>
<!-- ./wrapper -->
    
   


<script src="assets/vendor_components/jquery/dist/jquery.min.js"></script>
<script src="assets/vendor_components/popper/dist/popper.min.js"></script>
<script src="assets/vendor_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- <script src="assets/vendor_components/jquery-slimscroll/jquery.slimscroll.js"></script> -->
<!-- <script src="assets/vendor_components/fastclick/lib/fastclick.js"></script> -->
<script src="js/template.js"></script>
<!-- <script src="js/pages/dashboard.js"></script> -->

<script src="assets/vendor_components/select2/dist/js/select2.full.js"></script>
<script src="js/pages/advanced-form-element.js"></script> 



  <!-- dfsbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb -->
  <?php
    $sql = "SELECT * FROM user WHERE userid =".$_SESSION['id'];
    $result = mysql_query($sql,$conn);
    $row = mysql_fetch_assoc($result);
    $fname = $row['ufname'];
    $ulname = $row['ulname'];
    if ($row['user_varified']=="No") 
    { ?>
      
   

<script type="text/javascript">
    $(window).on('load',function(){
        $('#modal-default').modal({
          backdrop: 'static',
          keyboard: false
        });
    });
</script>

<?php }
   
  ?>

<div class="modal fade" id="modal-default">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Reset Password</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <!-- <span aria-hidden="true">&times;</span></button> -->
      </div>
      <div class="modal-body">
      
        <form class="form-element" action="reset_password.php">
              <div class="box-body">
                
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" class="form-control"  placeholder="Password" required name="pass">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Confirm Password</label>
                  <input type="password" class="form-control" placeholder="Password" required>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
        
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary float-right">Save changes</button> -->
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- dfsbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb -->

<!-- dfsbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb -->
<button class="tst3 btn btn-success" style="display: none;"></button>
<button class="tst4 btn btn-danger" style="display: none;"></button>

<?php
if (isset($_GET['update']) && $_GET['update'] == "success")
{ ?>
  <script type="text/javascript">

    $(document).ready(function () {
      $.toast({
          heading: 'Password reset Successfully',
          text: '<?php echo "Welcome"." ".$fname." ".$ulname;?>',
          position: 'top-right',
          loaderBg: '#ff6849',
          icon: 'success',
          hideAfter: 3500,
          stack: 6
      });

  });
  </script>

<?php }

if (isset($_GET['pass_update']) && $_GET['pass_update'] == "success")
{ ?>
  <script type="text/javascript">

    $(document).ready(function () {
      $.toast({
          heading: 'Reminder Updated Successfully',
          text: '',
          position: 'top-right',
          loaderBg: '#ff6849',
          icon: 'success',
          hideAfter: 3500,
          stack: 6
      });

  });
  </script>
<?php }



if (isset($_GET['status']) && $_GET['status']!="") 
  { ?>
  <script type="text/javascript">

    $(document).ready(function () {
      $.toast({
          heading: 'Status changed Successfully',
          text: '',
          position: 'top-right',
          loaderBg: '#ff6849',
          icon: 'success',
          hideAfter: 3500,
          stack: 6
      });

  });
  </script>
<?php }
else if(isset($_GET['update']) && $_GET['update'] == "fail")
{ ?>
    
  <script type="text/javascript">
   $(document).ready(function () {
        $.toast({
            heading: 'Password update fail',
            text: 'Please reset password immediatly',
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'error',
            hideAfter: 3500

        });

    });
  </script>

<?php  }

else if(isset($_GET['pass_update']) && $_GET['pass_update'] == "fail")
{ ?>
  <script type="text/javascript">
   $(document).ready(function () {
        $.toast({
            heading: 'Reminder updation failed',
            text: 'Please reset password immediatly',
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'error',
            hideAfter: 3500
        });
    });
  </script>

<?php  }

else if(isset($_GET['rem_delete']) && $_GET['rem_delete'] == "fail")
{ ?>
    
  <script type="text/javascript">
   $(document).ready(function () {
        $.toast({
            heading: 'Reminder close fail',
            text: 'Please try again later',
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'error',
            hideAfter: 3500

        });

    });
  </script>
<?php  }


else if (isset($_GET['rem_delete']) && $_GET['rem_delete'] == "success")
{ ?>

  <script type="text/javascript">

    $(document).ready(function () {
      $.toast({
          heading: 'Reminder close Successfully',
          position: 'top-right',
          loaderBg: '#ff6849',
          icon: 'success',
          hideAfter: 3500,
          stack: 6
      });

  });
  </script>

<?php }


?>

<link rel="stylesheet" type="text/css" href="assets\vendor_components\jquery-toast-plugin-master\src\jquery.toast.css">
<script src="assets\vendor_components\jquery-toast-plugin-master\src\jquery.toast.js"></script>
<!-- dfsbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb -->





<!-- view modal view modal view modal view modal view modal view modal view modal view modal -->
<div class="modal fade task_detail none-border" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
  <?php
    $sql = "SELECT * FROM reminder WHERE rem_id = ".$_REQUEST['id'];
    $result = mysql_query($sql,$conn);
    $row = mysql_fetch_assoc($result);
    $type = $row['type'];
    $title = $row['title'];
    $description = $row['description'];
    $priority = $row['priority'];
    $from_date = date('d-m-Y H:i',strtotime($row['from_date']));
    $to_date =  date('d-m-Y H:i',strtotime($row['to_date']));
    $Status = $row['Status'];
    $created_by = $row['created_by'];
    $rem_req = $row['rem_req'];
    $period = $row['period'];
    $start_date = date('d-m-Y H:i',strtotime($row['start_date']));
?>

  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myLargeModalLabel">Reminder Task (<?=$title?>)</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal form-element col-12" action="update_reminder.php" method="post">

          <input type="hidden" name="rem_id" value="<?=$_REQUEST['id']?>">
          



          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Title</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" disabled value="<?php echo $title; ?>">
            </div>
          </div>

          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">description</label>
            <div class="col-sm-9">
              
              <?php
                if ($Status=='Pending' && $created_by==$uu) 
                { ?>
                  <input disabled id="user_desc" type="text" class="form-control" name="description" value="<?php echo $description; ?>">
               <?php }
                else
                { ?>
                    <input type="text" class="form-control" disabled value="<?php echo $description; ?>">
               <?php }
              ?>

            </div>
          </div>

          


          <input type="hidden" class="form-control" name="hidden_from_date" value="<?php echo $from_date  ?>">
          <input type="hidden" class="form-control" name="page_name" value="home">

          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">From Date </label>
            <div class="col-sm-9">
              
              <?php
                if ($Status=='Pending' && $created_by==$uu && $from_date>=date('d-m-Y') ) 
                { ?>
                  <input type="text" disabled class="form-control" name="f_date" id="f_date" value="<?php echo $from_date  ?>">
               <?php }
                else
                { ?>
                    <input type="text" class="form-control" disabled value="<?php echo $from_date  ?>">
               <?php }
              ?>

            </div>
          </div>

          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">To Date</label>
            <div class="col-sm-9">
              
              <?php
                if ($Status=='Pending' && $created_by==$uu && $to_date>=date('d-m-Y')) 
                { ?>
                  <input onchange="picker()" disabled type="text" class="form-control disabled" name="t_date" id="t_date" value="<?php echo $to_date  ?>">
               <?php }
                else
                { ?>
                    <input type="text" class="form-control" disabled value="<?php echo $to_date  ?>">
               <?php }
              ?>
            </div>
          </div>


          <button style="display: none;" class="btn btn-primary sweet-1" onclick="_gaq.push(['_trackEvent', 'example', 'try', 'sweet-1']);">Try It</button>
        <script type="text/javascript">
          function picker()
          {
              var date_ini = $('#f_date').val();
              var date_end = $('#t_date').val();
              if (date_ini > date_end) 
              {
                  swal({
                    title: "Warning..!",
                    text: "Invalid To Date! Please select To date greater than From Date",
                    type: "warning"
                  });
                  $('#t_date').val('');
                  return false;
              }

          }
          function picker2()
          {
              var date_ini = $('#f_date').val();
              var start_date = $('#start_date').val();
              if (date_ini <= start_date) 
              {
                  swal({
                    title: "Warning..!",
                    text: "Invalid Start Date! Please select Start Date Less than From Date",
                    type: "warning"
                  });
                  $('#start_date').val('');
                  return false;
              }
          }
        </script>

        <?php
                if ($Status=='Pending' && $created_by==$uu && $rem_req==1 && $from_date>=date('d-m-Y')) 
                { ?>
                  <div class="form-group row">
                    <label for="inputName" class="col-sm-3 control-label">Start Date </label>
                    <div class="col-sm-9">
                      <input onchange="picker2()" disabled type="text" class="form-control" name="start_date5" id="start_date" value="<?php echo $start_date  ?>">
                    </div>
                  </div>
               <?php }
          ?>



          <?php
                if ($Status=='Pending' && $created_by==$uu && $rem_req==1 && $from_date>=date('d-m-Y')) 
                { ?>
                  <div class="form-group row">
                    <label for="inputName" class="col-sm-3 control-label">Time Periods </label>
                    <div class="col-sm-9">
                      <select disabled id="user_tp" class="form-control select2" style="width: 100%;" name="period">
                        <option value="">Select</option>
                        <option value="24" <?php if($period==24){echo "selected";} ?> >Onces a day</option>
                        <option value="12" <?php if($period==12){echo "selected";} ?> >Twice a Day</option>
                      </select>
                    </div>
                  </div>
               <?php }
          ?>



              <?php
          $sql = "SELECT * FROM reminder_participants WHERE rem_id =".$_REQUEST['id']." AND userid='$sid' ";
          $result = mysql_query($sql,$conn);
          if (mysql_num_rows($result) > 0)
          {
            $row = mysql_fetch_assoc($result);
             ?>
              <div class="form-group row">
              <label for="inputName" class="col-sm-3 control-label"><b>My Task Status</b></label>
              <div class="col-sm-9">
              <input type="text" class="form-control" disabled value="<?php if($row['status']==0){echo"Pending";}else{echo"Done";} ?>">
              </div>
              </div>
           <?php 
            
          }
        ?>

          <?php
            $sql = "SELECT * FROM user WHERE user_varified='Yes' AND userid = ".$created_by;
            $result = mysql_query($sql,$conn);
            $row = mysql_fetch_assoc($result);
            $fname = $row['ufname'];
            $lname = $row['ulname'];
          ?>

          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Created By </label>
            <div class="col-sm-9">
              <input type="text" class="form-control" disabled value="<?= $fname." ".$lname; ?>">
            </div>
          </div>


          <div style="display:none;" class="form-group row" <?php if ($type=="Personal"){ echo "style='display:none;' "; } ?>>
            <label for="inputName" class="col-sm-3 control-label">Participants </label>
            <div class="col-sm-9">
              <select class="form-control select2" multiple="multiple" data-placeholder="Choose" style="width: 100%" name="" disabled="disabled">
            <?php
              $sql = "SELECT * FROM reminder_participants rp INNER JOIN reminder r ON rp.rem_id = r.rem_id INNER JOIN user u ON rp.userid = u.userid WHERE r.rem_id =".$_REQUEST['id'];
              $result = mysql_query($sql,$conn);
              if (mysql_num_rows($result) > 0)
              {
                while ($row = mysql_fetch_assoc($result)) 
                {
                  $fname = $row['ufname']; 
                  $lname = $row['ulname']; 
                  echo '<option value="'.$uid.'" selected>'."&nbsp;&nbsp;".$fname.' '.$lname.'</option>';
                }
              }
            ?>
            </select>
            </div>
          </div>


          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">More Details</label>
            <div class="col-sm-9">
              <div class="radio" style="display: inline;">
              <input name="r_require" type="radio" id="Yes" value="1" class="radio-col-yellow" onclick="show1()">
              <label for="Yes">Yes</label>                    
            </div>
            <div class="radio" style="display: inline;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="r_require" type="radio" id="No" value="0" class="radio-col-yellow" onclick="show2()" checked="">
            <label for="No">No</label>   
            </div>
            </div>
          </div>



          <div id="more_detail" style="display: none;">
          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Type</label>
            <div class="col-sm-9">
              <input type="text" class="form-control disabled" disabled readonly value="<?php echo $type; ?>">
            </div>
          </div> 


          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Priority</label>
            <div class="col-sm-9">
              <select class="form-control" name="priority" disabled id="user_prior" >
                  <option value="Low" <?php if($priority=="Low"){echo "selected";} ?>>Low</option>
                  <option value="KMedium" <?php if($priority=="KMedium"){echo "selected";} ?>>Medium</option>
                  <option value="High" <?php if($priority=="High"){echo "selected";} ?>>High</option>
              </select>
            </div>
          </div>



          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Overall Task Status </label>
            <div class="col-sm-9">
              <input type="text" class="form-control" disabled value="<?php echo $Status ;  ?>">
            </div>
          </div>



        <div class="form-group row" <?php if($type=="Personal"){echo "style='display:none;' ";}?> >
            <label for="inputName" class="col-sm-3 control-label">Participants </label>
            <div class="col-sm-9">
              <select disabled id="usr_parti" class="form-control select2" multiple="multiple" data-placeholder="Choose" style="width: 100%" name="parti[]">
            <?php

              // echo $qry = "SELECT * FROM forward_user fu INNER JOIN forward_rem fr ON fu.rm_id=fr.rm_id WHERE fu.userid='".$_SESSION['id']."' AND fr.rem_id='".$_GET['id']."' "; 
              // $p = mysql_query($qry,$conn);

              $sql = "SELECT * FROM reminder_participants rp INNER JOIN reminder r ON rp.rem_id = r.rem_id INNER JOIN user u ON rp.userid = u.userid WHERE r.rem_id =".$_REQUEST['id'];
              $arr = array();
              $result = mysql_query($sql,$conn);
              if (mysql_num_rows($result) > 0)
              {
                while ($row = mysql_fetch_assoc($result)) 
                {
                  $userid = $row['userid']; 
                  $fname = $row['ufname']; 
                  $lname = $row['ulname']; 

                  if($row['forwarded']==0)
                  {
                  echo '<option value="'.$row['userid'].'" selected>'."&nbsp;&nbsp;".$fname.' '.$lname.'</option>';
                  }
                  else
                  {
                  echo '<option value="'.$row['userid'].'" selected>'."&nbsp;&nbsp;".$fname.' '.$lname.' (Forwarded)</option>';
                    
                  }
                  array_push($arr, $userid);
                }
                $arr_list = implode(', ', $arr);
              }

              $sql11 = "SELECT * FROM user WHERE userid NOT IN ('".$arr_list."') ";
              $result11 = mysql_query($sql11,$conn);
              if (mysql_num_rows($result11) > 0)
              {
                while ($row11 = mysql_fetch_assoc($result11)) 
                {
                  $fname = $row11['ufname']; 
                  $lname = $row11['ulname']; 
                  echo '<option value="'.$row11['userid'].'">'."&nbsp;&nbsp;".$fname.' '.$lname.'</option>';
                }
              }
            ?>
            </select>
            </div>
          </div>

          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Tasks</label>
            <div class="col-sm-9">
              <select class="form-control select2" multiple="multiple" data-placeholder="Choose Tasks" style="width: 100%" name="" disabled="disabled">
            <?php
              $sql = "SELECT * FROM reminder_task WHERE rem_id =".$_REQUEST['id'];
              $result = mysql_query($sql,$conn);
              if (mysql_num_rows($result) > 0)
              {
                while ($row = mysql_fetch_assoc($result)) 
                {
                  $task = $row['task'];
                  echo '<option selected>'.$task.'</option>';
                }
              }
            ?>
            </select>
            </div>
          </div>

          </div><!-- MORE DETAIL DIV -->




          <?php
            if ( $created_by==$_SESSION['id'])  { ?> 
          <div class="form-group row">
            <label for="inputName" class="col-sm-12 control-label">User Comments for this task</label>


            <?php
              $sql = "SELECT * FROM reminder r INNER JOIN reminder_participants rp ON r.rem_id=rp.rem_id WHERE rp.userid=".$_SESSION['id']." AND r.rem_id = ".$_REQUEST['id'];
              $result = mysql_query($sql,$conn);
              $row = mysql_fetch_assoc($result);
              $title = $row['title'];
              $description = $row['description'];
              $comment = $row['comment'];
              $status = $row['status'];
              $created_at = date('d-M-Y h:i A', strtotime($row['created_at']));

              $pic = "SELECT * FROM user WHERE userid=".$_SESSION['id'];
              $pic_result = mysql_query($pic,$conn);
              $pic_row = mysql_fetch_assoc($pic_result);
              $pic_row['profile_pic'];
            ?>

            <div class="col-xl-12 col-lg-12">
          <!-- Box Comment -->
          <div class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
                <img class="rounded" src="<?=$pic_row['profile_pic']?>" alt="User Image">
                <span class="username"><a href="#"><?= $_SESSION['ufname']." ".$_SESSION['ulname'] ?></a></span>
                <span class="description">Shared publicly - <?= $from_date ?></span>
              </div>
              <!-- /.user-block -->
              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <!-- /.box-body -->
            <div class="box-footer box-comments">
  
              <!-- /.box-comment -->
                <?php
                $sql = "SELECT * FROM reminder_participants  r INNER JOIN user u ON r.userid=u.userid WHERE r.rem_id = ".$_REQUEST['id'];
                $result = mysql_query($sql,$conn);
                if (mysql_num_rows($result)>0) 
                {
                
                while($row = mysql_fetch_assoc($result))
                {
                    $ufname = $row['ufname'];
                    $profile_pic = $row['profile_pic'];
                    $ulname = $row['ulname'];
                    $created_at = date('d-M-Y h:i A', strtotime($row['created_at']));
                    $comment = $row['comment'];
                    if ($comment!="") {
                      # code...
                    
                    ?>

                    <div class='box-comment'>
                    <img class='rounded' src='<?php if($profile_pic==""){echo'images/user.jpg';}else{echo $profile_pic;} ?>' alt='User Image'>
                    <div class='comment-text'>
                    <span class='username'><?=$ufname." ".$ulname ?><span class='text-muted pull-right'><?=$created_at?></span></span>
                    <?=$comment?>
                    </div>
                    </div>


                    <?php }
                }
              }
              else
              { ?>

                <div class='box-comment'>
                <div class='comment-text'>
                <h1>No Comments Yet</h1>
                </div>
                </div>

            <?php  }
                
              ?>
                
              <!-- /.box-comment -->
            </div>
          </div>
          <!-- /.box -->
        </div><!-- /.column -->






          </div><!-- /.row -->

            <?php } ?>


      </div> <!-- modal bode -->

      <script type="text/javascript">
        function discard_reminder(id)
        {
          swal({   
            title: "Are you sure?",   
            text: "You will not be able to open this reminder back!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes, delete it!",   
            closeOnConfirm: false 
        }, function(){  
          // window.location="delete_reminder1.php?page=home&rem_id="+id;
          window.location="home.php?close_id="+id;
             
        });
        }  
      </script>
      <div class="modal-footer">
        <hr>
        <?php
          if ($Status=='Pending' && $created_by==$_SESSION['id']) 
          {
            $i= $_REQUEST['id']; ?>
            <button type='button' class='btn btn-info waves-effect text-right' id="show_save_button">Edit Reminder</button>
            <button style="display: none;" type='submit' class='btn btn-info waves-effect text-right' id="save_button">Save Reminder</button>
            <a href="#" onclick="discard_reminder(<?= $_REQUEST['id']; ?>)" class='btn btn-warning waves-effect text-right'>Close reminder</a>
       <?php   }
        ?>
        
        <?php
          $sql = "SELECT * FROM reminder_participants WHERE rem_id =".$_REQUEST['id']." AND userid='$sid' ";
          $result = mysql_query($sql,$conn);
          if (mysql_num_rows($result) > 0)
          {
            $row = mysql_fetch_assoc($result);
            if ($row['status']==0) 
            { ?>
                <a href="home.php?rem_id=<?=$_REQUEST['id']?>&userid=<?=$sid?>" class="btn btn-info waves-effect text-right">Update My status</a>

                  
                     
           <?php
                $qry = "SELECT * FROM forward_user fu INNER JOIN forward_rem fr ON fu.rm_id=fr.rm_id WHERE fu.userid='".$_SESSION['id']."' AND fr.rem_id='".$_GET['id']."' ";
                $p = mysql_query($qry,$conn);
                if(mysql_num_rows($p)==0)
                { ?>
                  <a href="home.php?f_rem_id=<?=$_REQUEST['id']?>&userid=<?=$sid?>" class="btn btn-info waves-effect text-right">Forward Task</a> 
               <?php }
            }
            
          }
        ?>
        

        <button type="button" class="btn btn-danger waves-effect text-right" data-dismiss="modal">Close</button>

      </div>
      </form>
    </div>
  </div>
</div>
<!-- /. viewmodal -->


<!-- view event modal -->
<a id="modal_view" data-toggle="modal" data-target=".task_detail" style="display: none;">dsvdsv</a>
  <?php
    if (isset($_REQUEST['id']) && $_REQUEST['id']!="") 
    { ?>
          <script type="text/javascript">
            document.getElementById('modal_view').click();
          </script>
   <?php }
  ?>
<script type="text/javascript">
  $("input[name='r_type']:radio")
    .change(function() {
      $("#par").toggle($(this).val() == "Public");
});
</script>

<!--   date time picker -->
  <script src="js/jquery.datetimepicker.full.min.js"></script>
  <script type="text/javascript">

    $(function () {
      $('#from_date').datetimepicker({ minDate: new Date() }); 
    });

    $(function () {
      $('#to_date').datetimepicker({ minDate: new Date() }); 
    });

    $(function () {
      $('#start_date').datetimepicker({ minDate: new Date() }); 
    });

    $(function () {
      $('#f_date').datetimepicker({ minDate: new Date() }); 
    });

    $(function () {
      $('#t_date').datetimepicker({ minDate: new Date() }); 
    });

    // $(function () {
    //   $('#start_date2').datetimepicker({ minDate: new Date() }); 
    // });

    jQuery('#from_date').datetimepicker({
      startDate:'+1971/05/01',
      format:'d.m.Y H:i'
    });

    jQuery('#to_date').datetimepicker({
      startDate:'+1971/05/01',
      format:'d.m.Y H:i'
    });

    jQuery('#start_date').datetimepicker({
      startDate:'+1971/05/01',
      format:'d.m.Y H:i'
    });

    jQuery('#f_date').datetimepicker({
      startDate:'+1971/05/01',
      format:'d.m.Y H:i'
    });

    jQuery('#t_date').datetimepicker({
      startDate:'+1971/05/01',
      format:'d.m.Y H:i'
    });

    // jQuery('#start_date2').datetimepicker({
    //   startDate:'+1971/05/01',
    //   format:'d.m.Y H:i'
    // });
  </script>
<!--   date time picker -->


<!-- for show hide start date and time period based on rem_req -->
<script type="text/javascript">
  function show1(){document.getElementById('rr').style.display = 'block'; }
function show2(){document.getElementById('rr').style.display ='none';}
</script>
<!-- for show hide start date and time period based on rem_req -->





<!-- view modal view modal view modal view modal view modal view modal view modal view modal -->

<div class="modal fade bs-example-modal-lg none-border" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myLargeModalLabel">My Note</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal form-element col-12" action="update_reminder.php" method="post">

          <?php
                $sql = "SELECT * FROM my_note WHERE id = ".$_REQUEST['noteid'];
                $result = mysql_query($sql,$conn);
                $row = mysql_fetch_assoc($result);
                $title = $row['title'];
                $des = $row['des'];
            ?>

          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Title</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" disabled value="<?= $title ?>">
            </div>
          </div>

          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Description</label>
            <div class="col-sm-9">
              <textarea  rows="3" class="form-control" name="description" disabled=""><?= $des ?></textarea>
            </div>
          </div>

      </div> <!-- modal bode -->
      <div class="modal-footer">
        <hr>
        <button type="button" class="btn btn-danger waves-effect text-right" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- /. viewmodal -->

<!-- view event modal -->
<a id="modal_view1" data-toggle="modal" data-target=".bs-example-modal-lg" style="display: none;">dsvdsv</a>
  <?php
    if (isset($_REQUEST['noteid']) && $_REQUEST['noteid']!="") 
    { ?>
          <script type="text/javascript">
            document.getElementById('modal_view1').click();
          </script>
   <?php }
  ?>



<!-- Modal change task status for particular user -->
<a data-toggle="modal" data-target=".update_task_status" id="aaa" style="display: none;"> update task</a>
<form action="update_user_status.php" method="post">
<div class="modal fade none-border update_task_status" id="update_task_status">
 <div class="modal-dialog">
  <div class="modal-content">
   
   <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  <h4 class="modal-title"><strong>Update task Reminder</strong> </h4>
   </div>
   
   <div class="modal-body">

    <?php
      $sql = "SELECT * FROM reminder r INNER JOIN reminder_participants rp ON r.rem_id=rp.rem_id WHERE rp.userid=".$sid." AND r.rem_id = ".$_REQUEST['rem_id'];
      $result = mysql_query($sql,$conn);
      $row = mysql_fetch_assoc($result);
      $title = $row['title'];
      $description = $row['description'];
      $comment = $row['comment'];
      $status = $row['status'];
    ?>
    <div class="form-group row">
          <label for="example-text-input" class="col-sm-4 col-form-label">Title</label>
          <div class="col-sm-8">
          <input class="form-control" type="text" placeholder="Enter title" id="title" name="title" autocomplete="off" required disabled="" value="<?=$title?>">
          </div>
        </div>

        <div class="form-group row">
          <label for="example-search-input" class="col-sm-4 col-form-label">Description</label>
          <div class="col-sm-8">
          <input class="form-control" type="search" placeholder="Enter Description" id="desc" name="desc" autocomplete="off" required disabled="" value="<?=$description?>">
          </div>
        </div>

        <div class="form-group row">
          <label for="example-search-input" class="col-sm-4 col-form-label">Status</label>
          <div class="col-sm-8">
          <!-- <input class="form-control" type="search" placeholder="Enter Description" id="desc" name="desc" autocomplete="off" required disabled="" value="<?=$description?>"> -->
          <select class="form-control" name="status">
            <option value="0" <?php if ($status==0){echo "selected";} ?>>Pending</option>
            <option value="1" <?php if ($status==1){echo "selected";} ?>>Done</option>
          </select>
          </div>
        </div>

        <div class="form-group row">
          <label for="example-search-input" class="col-sm-4 col-form-label">Comment <label style="color: red">*</label></label>
          <div class="col-sm-8">
            <input type="hidden" name="page_name" value="home">
            <input type="hidden" name="rem_id" value="<?=$_REQUEST['rem_id']?>">
          <textarea name="comment" class="form-control" placeholder="enter task comment" rows="5" required=""><?=$comment?></textarea>


          </div>
        </div>

   </div>
   
   <div class="modal-footer">
    <hr>
  <button type="submit" class="btn btn-info waves-effect waves-light save-category">Update Status</button>
  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
   </div>
   
  </div>
 </div>
</div>
</form>


<?php
    if (isset($_REQUEST['rem_id']) && $_REQUEST['rem_id']!="" && isset($_REQUEST['userid']) && $_REQUEST['userid']!="") 
    {
    echo $_REQUEST['rem_id']; ?>
          <script type="text/javascript">
            document.getElementById('aaa').click();
          </script>
   <?php }
  ?>


<!-- Modal change task status for particular user -->

</body>
</html>




<div id="loading"></div>
<style type="text/css">
.page    { display: none; padding: 0 0.5em; }
.page h1 { font-size: 2em; line-height: 1em; margin-top: 1.1em; font-weight: bold; }
.page p  { font-size: 1.5em; line-height: 1.275em; margin-top: 0.15em; }

#loading {
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  z-index: 100;
  width: 100vw;
  height: 100vh;
  background-color: rgba(192, 192, 192, 0.5);
  background-image: url("loader.gif");
  background-repeat: no-repeat;
  background-position: center;
}
</style>
<script type="text/javascript">
 function onReady(callback) {
  var intervalId = window.setInterval(function() {
    if (document.getElementsByTagName('body')[0] !== undefined) {
      window.clearInterval(intervalId);
      callback.call(this);
    }
  }, 1000);
}

function setVisible(selector, visible) {
  document.querySelector(selector).style.display = visible ? 'block' : 'none';
}

onReady(function() {
  setVisible('body', true);
  setVisible('#loading', false);
});
</script>












<!-- Trigger the modal with a button -->
<button id="close" type="button" style="display: none;" data-toggle="modal" data-target="#a"></button>

<!-- Modal -->
<div id="a" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form action="home.php" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Give Ratings to user</h4>
      </div>
      <div class="modal-body">
        
        <p>

          <?php
            $user = "SELECT * FROM reminder r INNER JOIN reminder_participants pr ON r.rem_id=pr.rem_id WHERE r.rem_id=".$_REQUEST['close_id'];
            $ur = mysql_query($user, $conn);
            while($fr = mysql_fetch_assoc($ur))
            { ?>
              <input type="hidden" name="close_rem_id" value="<?= $_REQUEST['close_id'] ?>">
              <?php $post_id = $_REQUEST['close_id']; ?>
              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-3">
                    <?php
                    $rate = get_rate($fr['userid'], $_REQUEST['close_id']);
                    $rate= intval($rate);

                     ?> 

                  </div>
                    <div class="col-md-7">
                      
                      <div class="rate">
                            <!-- <div class="col-md-4 pull-left"> -->
                            <!-- </div> -->
                            <div class="col-md-12">
                              <span style="float: left; margin: 5px 8px 0px -5px; width: 100px;margin-top: 10px;"><?= get_name($fr['userid']) ?></span>
                              <div id="<?=$fr['userid']?>-1" class="btn-1 rate-btn <?php if($rate>=1 && $rate!=0){echo "rate-btn-active";} ?>"></div>
                            <div id="<?=$fr['userid']?>-2" class="btn-2 rate-btn <?php if($rate>=2 && $rate!=0){echo "rate-btn-active";} ?>"></div>
                            <div id="<?=$fr['userid']?>-3" class="btn-3 rate-btn <?php if($rate>=3 && $rate!=0){echo "rate-btn-active";} ?>"></div>
                            <div id="<?=$fr['userid']?>-4" class="btn-4 rate-btn <?php if($rate>=4 && $rate!=0){echo "rate-btn-active";} ?>"></div>
                            <div id="<?=$fr['userid']?>-5" class="btn-5 rate-btn <?php if($rate>=5 && $rate!=0){echo "rate-btn-active";} ?>"></div>


                            </div>
                            
                      </div>
                    </div>
                </div>
              </div>

           <?php } ?>
        </p>
        
      </div>
      <div class="box-result">
       <?php
          $query = mysql_query("SELECT * FROM rating"); 
              while($data = mysql_fetch_assoc($query))
              {
                    $rate_db[] = $data;
                    $sum_rates[] = $data['rate'];
                }
                if(@count($rate_db)){
                    $rate_times = count($rate_db);
                    $sum_rates = array_sum($sum_rates);
                    $rate_value = $sum_rates/$rate_times;
                    $rate_bg = (($rate_value)/5)*100;
                }else{
                    $rate_times = 0;
                    $rate_value = 0;
                    $rate_bg = 0;
                }
        ?> 
    </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-warning" name="rate_n_close" value="ss">Save & Close Reminder</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </form>
    </div>

  </div>
</div>

<?php
    if (isset($_REQUEST['close_id']) && $_REQUEST['close_id']!="") 
    { ?>
          <script type="text/javascript">
            document.getElementById('close').click();
          </script>
   <?php }
  ?>
<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
  <script>

    function act_star(id)
    {
      var s=id.split("-");
    var uid=s[0];
    var c=s[1];
   $('#'+id).removeClass('rate-btn-hover');
      for (var i = c; i >= 0; i--) {
   $('#'+uid+'-'+i).addClass('rate-btn-hover');
       };
       for (var i = c; i <= 5; i++) {
   $('#'+uid+'-'+i).removeClass('rate-btn-hover');
       };
    }


$(function(){ 

$('.rate').hover(function(){
// $(this).css("background-color","red");
});

$( ".rate" ).mouseout(function() {
// $(this).css("background-color","green");
$('.rate div').removeClass('rate-btn-hover');
});
  $('.rate-btn').hover(function(){
    var id = $(this).attr("id");
    var s=id.split("-");
    var uid=s[0];
    var c=s[1];
    $('#'+id).removeClass('rate-btn-hover');

    for (var i = c; i >= 0; i--) {
      $('#'+uid+'-'+i).addClass('rate-btn-hover');
    }
    for (var i = c; i <= 5; i++) {
      $('#'+uid+'-'+i).removeClass('rate-btn-hover');
    }
  });        




    $('.rate-btn').click(function(){    
      var id = $(this).attr("id");
      // act_star(id);

    var s=id.split("-");
    var uid=s[0];
    var c=s[1];



   var dataRate = 'act=rate&userid='+uid+'&post_id=<?php echo $post_id; ?>&rate='+c; //
   $('#'+id).removeClass('rate-btn-active');
      for (var i = c; i >= 0; i--) {
        $('#'+uid+'-'+i).addClass('rate-btn-active');
        $('#'+uid+'-'+i).addClass('rate-btn-hover');
      }
      for (var i = c; i <=5; i++) {
        $('#'+uid+'-'+i).removeClass('rate-btn-active');
        $('#'+uid+'-'+i).removeClass('rate-btn-hover');
      }

$(this).addClass('rate-btn-active');



   $.ajax({
      type : "POST",
      url : "ajax.php",
      data: dataRate,
      success:function(d){}
    });
  });
});
</script>

<script>
jQuery(document).ready(function(){
    jQuery('#show_save_button').click(function(event) 
    {        
         jQuery('#save_button').show();
         jQuery('#show_save_button').hide();
         $('#user_desc').removeAttr("disabled");
         $('#usr_parti').removeAttr("disabled");
         $('#user_prior').removeAttr("disabled");
         $('#f_date').removeAttr("disabled");
         $('#t_date').removeAttr("disabled");
         $('#start_date').removeAttr("disabled");
         $('#user_tp').removeAttr("disabled");
         $('#user_desc').focus();
    });
});
</script>






<!-- Modal change task status for particular user -->
<a data-toggle="modal" data-target="#forward_task" id="aaa1" style="display: none;"> update task</a>
<form action="home.php" method="post">
<div class="modal fade none-border" id="forward_task">
 <div class="modal-dialog">
  <div class="modal-content">
   
   <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  <h4 class="modal-title"><strong>Forward Reminder</strong> </h4>
   </div>
   
   <div class="modal-body">

    <?php
      $sql = "SELECT * FROM reminder r INNER JOIN reminder_participants rp ON r.rem_id=rp.rem_id WHERE rp.userid=".$sid." AND r.rem_id = ".$_REQUEST['f_rem_id'];
      $result = mysql_query($sql,$conn);
      $row = mysql_fetch_assoc($result);
      $title = $row['title'];
      $description = $row['description'];
    ?>
    <input type="hidden" name="rem_id" value="<?=$_REQUEST['f_rem_id']?>">
    <div class="form-group row">
          <label for="example-text-input" class="col-sm-4 col-form-label">Title</label>
          <div class="col-sm-8">
          <input class="form-control" type="text" placeholder="Enter title" id="title" name="title" autocomplete="off" required disabled="" value="<?=$title?>">
          </div>
        </div>

        <div class="form-group row">
          <label for="example-search-input" class="col-sm-4 col-form-label">Description</label>
          <div class="col-sm-8">
          <input class="form-control" type="search" placeholder="Enter Description" id="desc" name="desc" autocomplete="off" required disabled="" value="<?=$description?>">
          </div>
        </div>



        <?php 
            $a= "SELECT * FROM contact_request WHERE (request_by='".$_SESSION['id']."' OR request_to='".$_SESSION['id']."') AND request_approve=1";
              $arr1 = array();
              $arr2 = array();
              $result = mysql_query($a,$conn);
              if (mysql_num_rows($result) > 0)
              {
                while ($row = mysql_fetch_assoc($result)) 
                {
                  array_push($arr1, $row['request_by']);
                  array_push($arr2, $row['request_to']);
                }
                $arr_list1 = implode(', ', $arr1);
                $arr_list2 = implode(', ', $arr2);
              }


              $aa= "SELECT * FROM reminder r INNER JOIN reminder_participants rp ON r.rem_id=rp.rem_id WHERE r.rem_id=".$_GET['f_rem_id'];
              $ar = array();
              $resulta = mysql_query($aa,$conn);
              if (mysql_num_rows($resulta) > 0)
              {
                while ($row1 = mysql_fetch_assoc($resulta)) 
                {
                  array_push($ar, $row1['userid']);
                }
                $arr_list22 = implode(', ', $ar);
              }


          ?>



          <div class="form-group row" <?php if($type=="Personal"){echo "style='display:none;' ";}?> >
            <label for="inputName" class="col-sm-3 control-label">Add Participants </label>
            <div class="col-sm-9">
              <select id="usr_parti" class="form-control select2" multiple="multiple" data-placeholder="Choose" style="width: 100%" name="forward_parti[]">
            <?php
            if(get_user_type($_SESSION['id'])=='A')
            {
              $sql11 = "SELECT * FROM user WHERE utype!='A' AND userid!='".$_SESSION['id']."' AND userid NOT IN (".$arr_list.") ";
            }
            else
            {
              $sql11 = "SELECT * FROM user WHERE utype!='A' AND userid!='".$_SESSION['id']."' AND userid NOT IN (".$arr_list22.")  AND (userid IN (".$arr_list1.", ".$arr_list2."))";
            }
              $result11 = mysql_query($sql11,$conn);
              if (mysql_num_rows($result11) > 0)
              {
                while ($row11 = mysql_fetch_assoc($result11)) 
                {
                  $fname = $row11['ufname']; 
                  $lname = $row11['ulname']; 
                  echo '<option value="'.$row11['userid'].'">'."&nbsp;&nbsp;".$fname.' '.$lname.'</option>';
                }
              }
            ?>
            </select>
            <!-- <?=$sql11?> -->
            </div>
          </div>






   </div>
   
   <div class="modal-footer">
    <hr>
  <button type="submit" name="forward_rem" class="btn btn-info waves-effect waves-light save-category">Forward</button>
  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
   </div>
   
  </div>
 </div>
</div>
</form>

  <?php
    if (isset($_REQUEST['f_rem_id']) && $_REQUEST['f_rem_id']!="" && isset($_REQUEST['userid']) && $_REQUEST['userid']!="") 
    { ?>
          <script type="text/javascript">
            document.getElementById('aaa1').click();
          </script>
   <?php }
  ?>
<!-- Modal change task status for particular user -->

<!-- for show hide start date and time period based on rem_req -->
<script type="text/javascript">
function show1(){document.getElementById('more_detail').style.display = 'block'; }
function show2(){document.getElementById('more_detail').style.display ='none';}
</script>
<!-- for show hide start date and time period based on rem_req -->








<!-- COMPLETE TASK -->
<div class="modal fade none-border" id="com_task">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  <h4 class="modal-title"><strong>Complete Task List</strong></h4>
   </div>
   <div class="modal-body">
        <div class="box-body" style="min-height:200px; max-height: 400px; overflow-y:scroll;">  
            <?php
              $sql2 = "SELECT * FROM reminder_participants rp INNER JOIN reminder r ON r.rem_id=rp.rem_id WHERE r.activity='A' AND rp.status=1 AND rp.userid=".$_SESSION['id'];
              $result2 = mysql_query($sql2,$conn);
              if (mysql_num_rows($result2) >0)
              {
                while($row2 = mysql_fetch_assoc($result2))
                { ?>

                    <blockquote><br>
                     <p class='card-text' style='font-size:12px; margin-top:-10px;'><b style="font-weight: 900; color: blue">Title : </b><span><?=$row2['title']?></span><br><b style="font-weight: 900; color: blue">Date : </b><span><?=date('d-M', strtotime($row2['from_date']))?> <?=date('y  h:i A', strtotime($row2['from_date']))?>,</span> <b style="font-weight: 900; color: blue">Created By : </b><span><?=get_name($row2['created_by']);?> </span></p> </blockquote>
                    <hr style="border-color: white">

              <?php }
              }
              if (mysql_num_rows($result2)==0)
              {
                echo "<center><img src='images/notdatafound.png' class='img img-responsive' height=70 width=70></center>";
              }
            ?>           
              </div>
   </div>
   <div class="modal-footer">
    <hr>
  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
   </div>
  </div>
 </div>
</div>





<!-- TOTAL TASK -->
<div class="modal fade none-border" id="tot_task">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  <h4 class="modal-title"><strong>Total Task List</strong></h4>
   </div>
   <div class="modal-body">
        <div class="box-body" style="min-height:200px; max-height: 400px; overflow-y:scroll;">  
            <?php
              $sql2 = "SELECT * FROM reminder_participants rp INNER JOIN reminder r ON r.rem_id=rp.rem_id WHERE r.activity='A' AND rp.userid=".$_SESSION['id'];
              $result2 = mysql_query($sql2,$conn);
              if (mysql_num_rows($result2) >0)
              {
                while($row2 = mysql_fetch_assoc($result2))
                { ?>

                    <blockquote><br>
                     <p class='card-text' style='font-size:12px; margin-top:-10px;'><b style="font-weight: 900; color: blue">Title : </b><span><?=$row2['title']?></span><br><b style="font-weight: 900; color: blue">Date : </b><span><?=date('d-M', strtotime($row2['from_date']))?> <?=date('y  h:i A', strtotime($row2['from_date']))?>,</span> <b style="font-weight: 900; color: blue">Created By : </b><span><?=get_name($row2['created_by']);?> </span></p> </blockquote>
                    <hr style="border-color: white">

              <?php }
              }
              if (mysql_num_rows($result2)==0)
              {
                echo "<center><img src='images/notdatafound.png' class='img img-responsive' height=70 width=70></center>";
              }
            ?>           
              </div>
   </div>
   <div class="modal-footer">
    <hr>
  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
   </div>
  </div>
 </div>
</div>





<!-- PENDING TASK -->
<div class="modal fade none-border" id="pen_task">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  <h4 class="modal-title"><strong>Pending Task List</strong></h4>
   </div>
   <div class="modal-body">
        <div class="box-body" style="min-height:200px; max-height: 400px; overflow-y:scroll;">  
            <?php
              $sql2 = "SELECT * FROM reminder_participants rp INNER JOIN reminder r ON r.rem_id=rp.rem_id WHERE r.activity='A' AND rp.status=0 AND rp.userid=".$_SESSION['id'];
              $result2 = mysql_query($sql2,$conn);
              if (mysql_num_rows($result2) >0)
              {
                while($row2 = mysql_fetch_assoc($result2))
                { ?>

                    <blockquote><br>
                     <p class='card-text' style='font-size:12px; margin-top:-10px;'><b style="font-weight: 900; color: blue">Title : </b><span><?=$row2['title']?></span><br><b style="font-weight: 900; color: blue">Date : </b><span><?=date('d-M', strtotime($row2['from_date']))?> <?=date('y  h:i A', strtotime($row2['from_date']))?>,</span> <b style="font-weight: 900; color: blue">Created By : </b><span><?=get_name($row2['created_by']);?> </span></p> </blockquote>
                    <hr style="border-color: white">

              <?php }
              }
              if (mysql_num_rows($result2)==0)
              {
                echo "<center><img src='images/notdatafound.png' class='img img-responsive' height=70 width=70></center>";
              }
            ?>           
              </div>
   </div>
   <div class="modal-footer">
    <hr>
  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
   </div>
  </div>
 </div>
</div>