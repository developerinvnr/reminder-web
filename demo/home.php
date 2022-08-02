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
      
      $update = "UPDATE reminder SET activity='D',remark='".$_POST['remark']."' WHERE rem_id='".$_POST['close_rem_id']."' ";
      $rrr = mysql_query($update,$conn);
      if ($rrr) 
      {
        echo "<script>window.location='home.php?rem_delete=success';</script>";
      } 
    }
    elseif (isset($_GET['delete_rem_id']) && $_GET['delete_rem_id']!="" ) 
    {
      $update = "UPDATE reminder SET activity='De' WHERE rem_id='".$_GET['delete_rem_id']."' ";
      $rrr = mysql_query($update,$conn);
      if ($rrr) 
      {
        echo "<script>window.location='home.php?delete_rem=success';</script>";
      } 
    }
    elseif (isset($_POST['forward_rem'])) 
    {
      /* echo "<script>alert('hello')</script>";*/
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
        

<?php $a1=0; $a2=0; $a3=0; $a4=0; $totn=0;

 $sql2 = mysql_query("SELECT * FROM reminder_participants rp INNER JOIN reminder r ON r.rem_id=rp.rem_id WHERE rp.status=0 AND rp.userid=".$_SESSION['id']." AND r.activity!='De' AND r.activity!='D' order by r.from_date desc",$conn); 
 $num2 = mysql_num_rows($sql2); if($num2>0){ $a1=1; }

 $sql22 = mysql_query("SELECT * FROM reminder_participants rp INNER JOIN reminder r ON r.rem_id=rp.rem_id WHERE rp.status=1 AND rp.userid=".$_SESSION['id']." AND r.activity!='De' AND r.activity!='D' order by r.from_date desc",$conn); 
 $num22 = mysql_num_rows($sql22); if($num22>0){ $a2=1; }
 
 $sql1 = mysql_query("SELECT * FROM reminder r WHERE Status='Pending' AND created_by=".$_SESSION['id']." AND type!='Personal' AND activity!='De' AND activity!='D' order by r.from_date desc",$conn); 
 $num1 = mysql_num_rows($sql1); if($num1>0){ $a3=1; }
 
 $sql11 = mysql_query("SELECT * FROM reminder r WHERE Status='Done' AND created_by=".$_SESSION['id']." AND type!='Personal' AND activity!='De' AND activity!='D' order by r.from_date desc",$conn); 
 $num11 = mysql_num_rows($sql11); if($num11>0){ $a4=1; }

$sqldl = mysql_query("SELECT * FROM reminder r WHERE Status='Pending' AND created_by=".$_SESSION['id']." AND type!='Personal' AND activity!='De' AND activity!='D' and to_date < '".date("Y-m-d")."' order by r.from_date desc",$conn); 

$numdl = mysql_num_rows($sqldl);


 $totn=$a1+$a2+$a3+$a4;

?>


      <!-- /.col -->
<!-- Col My Task My Task 11111111111111111111111111111111111111111111111111111111111111111111111111111111 Open --> 
<?php  
       if($num2>0)
       {
?>       
        <div class="col-md-12 col-lg-<?php if($totn==1){echo 12;}elseif($totn==2){echo 6;}elseif($totn==3){echo 4;}elseif($totn==4){echo 3;}else{echo 6;} ?>" style="margin-top:-20px; padding:0px;">
          <div class="box box-default">
              <div style="background-color:#E9A70C;height:25px;padding:3px;color:#FFF; font-size:12px;"><span class="pull-left">My Task (Pending)</span><a class="pull-right " href="public_reminder.php" style="color: white"><span class="fa fa-plus-square fa-2x"></span></a></div>
            <div class="box-body" style="min-height:60px; max-height:250px; overflow-y:scroll; padding:0px;">  

            <?php while($row2 = mysql_fetch_assoc($sql2))
                  { ?>

                    <a href="home.php?t=mtp&id=<?=$row2['rem_id']?>"><blockquote>
                     <p style="background-color:<?php if($row2['priority']=='Low'){echo " rgb(168, 255, 81)";}elseif($row2['priority']=='KMedium'){echo "rgb(255, 255, 100)";}else{echo "rgb(247, 91, 1)";} ?>; padding: 2px" class='card-text' style='font-size:12px; margin-top:-10px;'><b style='color:<?php if($row2['priority']=='Low'){echo "blue";}elseif($row2['priority']=='KMedium'){echo "blue";}else{echo "#FFFF00";} ?>;font-size:12px;'>Title : </b><span style="color: <?php if($row2['priority']=='Low'){echo "black";}elseif($row2['priority']=='KMedium'){echo "black";}else{echo "white";} ?>;font-size:12px;"><?=$row2['title']?></span><br> 
           <b style='color:<?php if($row2['priority']=='Low'){echo "blue";}elseif($row2['priority']=='KMedium'){echo "blue";}else{echo "#FFFF00";} ?>;font-size:12px;'>Date : </b><span style="color: <?php if($row2['priority']=='Low'){echo "black";}elseif($row2['priority']=='KMedium'){echo "black";}else{echo "white";} ?>;font-size:12px;"><?=date('d-M', strtotime($row2['from_date']))?> <?=date('y  h:i A', strtotime($row2['from_date']))?></span>,  
           <b style='color:<?php if($row2['priority']=='Low'){echo "blue";}elseif($row2['priority']=='KMedium'){echo "blue";}else{echo "#FFFF00";} ?>;font-size:12px;'>CrBy : </b><span style="color: <?php if($row2['priority']=='Low'){echo "black";}elseif($row2['priority']=='KMedium'){echo "black";}else{echo "white";} ?>;font-size:12px;text-transform:capitalize;"><?=get_name($row2['created_by']);?> </span></p> </blockquote></a>
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


<?php  
      if($num22>0)
      {
?>       
        <div class="col-md-12 col-lg-<?php if($totn==1){echo 12;}elseif($totn==2){echo 6;}elseif($totn==3){echo 4;}elseif($totn==4){echo 3;}else{echo 6;} ?>" style="margin-top:-20px;padding:0px;">
          <div class="box box-default">
              <div style="background-color:#58B306;height:25px;padding:3px;color:#FFF; font-size:12px;"><span class="pull-left">My Task (Complete)</span><!--<a class="pull-right " href="public_reminder.php" style="color: white"><span class="fa fa-plus-square fa-2x"></span></a>--></div>
            <div class="box-body" style="min-height:60px; max-height: 250px; overflow-y:scroll;padding:0px;">  

            <?php while($row22 = mysql_fetch_assoc($sql22))
                  { ?>

                    <a style="background-color:#C4FFC4;" href='home.php?t=mtc&id=<?=$row22['rem_id']?>'><blockquote>
                     <p style="padding: 2px;" class='card-text' style='font-size:12px; margin-top:-10px;'><b style='color:#0076EC;font-size:12px;'>Title : </b><span style="color:#000;font-size:12px;"><?=$row22['title']?></span><br> 
           <b style='color:000;font-size:12px;'>Date : </b><span style="color:#0076EC;font-size:12px;"><?=date('d-M', strtotime($row22['from_date']))?> <?=date('y  h:i A', strtotime($row22['from_date']))?></span>,  
           <b style='color:000;font-size:12px;'>CrBy : </b><span style="color:#0076EC;font-size:12px;text-transform:capitalize;"><?=get_name($row22['created_by']);?> </span></p> </blockquote></a>
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
<?php    } //if (mysql_num_rows($result22) >0) ?>
    
<!-- Col 11111111111111111111111111111111111111111111111111111111111111111111111111111111 Close -->







<!-- Col 222222222222222222222222222222222222222222222222222222222222222222222222222 Open-->
<?php           
                    if($num1>0)
                    { 
?>          
        <div class="col-md-12 col-lg-<?php if($totn==1){echo 12;}elseif($totn==2){echo 6;}elseif($totn==3){echo 4;}elseif($totn==4){echo 3;}else{echo 6;} ?>" style="margin-top: -20px;padding:0px;">
          <div class="box box-default">
              <div style="background-color:#E9A70C;height:25px;padding:3px;color:#FFF;font-size:12px;">
              <span class="pull-left">Given Task (Pending)</span><a class="pull-right " href="public_reminder.php" style="color: white"><span class="fa fa-plus-square fa-2x"></span></a> </div>
            <div class="box-body" style="min-height:60px; max-height: 250px; overflow-y:scroll;padding:0px;">             
                  <?php  
                      while($row1 = mysql_fetch_assoc($sql1))
                      { ?>
                        <a href="home.php?t=gtp&id=<?=$row1['rem_id']?>"><blockquote>
                        <p style="background-color:<?php if($row1['priority']=='Low'){echo "rgb(168, 255, 81)";}elseif($row1['priority']=='KMedium'){echo "rgb(255, 255, 100)";}else{echo "rgb(247, 91, 1)";} ?>; padding: 2px" class='card-text' style='font-size:10px; margin-top:-10px;'><b style='color:<?php if($row1['priority']=='Low'){echo "blue";}elseif($row1['priority']=='KMedium'){echo "blue";}else{echo "#FFFF00";} ?>; font-size:12px;'>Title : </b><span style="color: <?php if($row1['priority']=='Low'){echo "black";}elseif($row1['priority']=='KMedium'){echo "black";}else{echo "white";} ?>;font-size:12px;"><?=$row1['title']?></span>,  
            <b style='color:<?php if($row1['priority']=='Low'){echo "blue";}elseif($row1['priority']=='KMedium'){echo "blue";}else{echo "#FFFF00";} ?>;font-size:12px;'>Date : </b><span style="color: <?php if($row1['priority']=='Low'){echo "black";}elseif($row1['priority']=='KMedium'){echo "black";}else{echo "white";} ?>;font-size:12px;"><?=date('d-M', strtotime($row1['from_date']))?> <?=date('y H:i A', strtotime($row1['from_date']))?></span><br>  
      
      <b style='color:<?php if($row1['priority']=='Low'){echo "blue";}elseif($row1['priority']=='KMedium'){echo "blue";}else{echo "#FFFF00";} ?>;font-size:12px;'>For : </b><span style="color: <?php if($row1['priority']=='Low'){echo "black";}elseif($row1['priority']=='KMedium'){echo "black";}else{echo "white";} ?>;font-size:12px;">
      
      <?php 
      $ssql2 = mysql_query("SELECT user.ufname, user.ulname, reminder_participants.status as rps from user INNER JOIN reminder_participants ON reminder_participants.userid=user.userid AND reminder_participants.rem_id=".$row1['rem_id'],$conn);
            while($rrow2 = mysql_fetch_assoc($ssql2))
      { ?>
       <span style="color:<?php if($row1['priority']=='Low'){echo "black";}elseif($row1['priority']=='KMedium'){echo "black";}else{echo "white";} ?>;"><?php echo $rrow2['ufname'].' '.$rrow2['ulname']; ?></span><span style="color:blue"> | </span>
      <?php }
       
            ?> 
           
        <?php /*?><b style='color:<?php if($row1['priority']=='Low'){echo "blue";}elseif($row1['priority']=='KMedium'){echo "blue";}else{echo "#FFFF00";} ?>;font-size:12px;'>CrBy :</b> <span style="color: <?php if($row1['priority']=='Low'){echo "black";}elseif($row1['priority']=='KMedium'){echo "black";}else{echo "white";} ?>;font-size:12px;text-transform:capitalize;"><?=get_name($row1['created_by']);?></span><?php */?> 
      
      </p></blockquote></a>
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


<?php                    
                    if($num11>0)
                    { 
?>          
        <div class="col-md-12 col-lg-<?php if($totn==1){echo 12;}elseif($totn==2){echo 6;}elseif($totn==3){echo 4;}elseif($totn==4){echo 3;}else{echo 6;} ?>" style="margin-top: -20px;padding:0px;">
          <div class="box box-default">
              <div style="background-color:#58B306;height:25px;padding:3px;color:#FFF;font-size:12px;">
              <span class="pull-left">Given Task (Complete)</span><!--<a class="pull-right " href="public_reminder.php" style="color: white"><span class="fa fa-plus-square fa-2x"></span></a> --></div>
            <div class="box-body" style="min-height:60px; max-height: 250px; overflow-y:scroll;padding:0px;">             
                  <?php  
                      while($row11 = mysql_fetch_assoc($sql11))
                      { ?>
                        <a style="background-color:#C4FFC4;" href='home.php?t=gtc&id=<?=$row11['rem_id']?>'><blockquote>
                        <p style="padding: 2px;" class='card-text' style='font-size:10px; margin-top:-10px;'><b style='color:#0076EC; font-size:12px;'>Title : </b><span style="color: #000;font-size:12px;"><?=$row11['title']?></span>, 
            <b style='color:#0076EC;font-size:12px;'>Date : </b><span style="color: #000;font-size:12px;"><?=date('d-M', strtotime($row11['from_date']))?> <?=date('y H:i A', strtotime($row11['from_date']))?></span><br> <b style='color:#0076EC; font-size:12px;'>For : </b>
            <?php 
      $ssqql2 = mysql_query("SELECT user.ufname, user.ulname, reminder_participants.status as rps from user INNER JOIN reminder_participants ON reminder_participants.userid=user.userid AND reminder_participants.rem_id=".$row11['rem_id'],$conn);
            while($rroww2 = mysql_fetch_assoc($ssqql2))
      { ?>
       <span style="color:#000;"><?php echo $rroww2['ufname'].' '.$rroww2['ulname']; ?></span><span style="color:blue"> | </span>
      <?php }
       
            ?>  
            <!-- <b style='color:#0076EC;font-size:12px;'>CrBy :</b> <span style="color: #000;font-size:12px;text-transform:capitalize;"><?=get_name($row11['created_by']);?></span> </p></blockquote></a>
                        <hr style="border-color: white"> -->
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




        

    
        
      </div>
      <!-- /.row -->

      <div class="row">
        <?php                    
        if($numdl>0){ 
        ?>          
          <div class="col-md-12 col-lg-<?php if($totn==1){echo 12;}elseif($totn==2){echo 6;}elseif($totn==3){echo 4;}elseif($totn==4){echo 3;}else{echo 6;} ?>" style="margin-top: -20px;padding:0px;">
            <div class="box box-default">
                <div style="background-color:#3d5c5c;height:25px;padding:3px;color:#FFF;font-size:12px;">
                  <span class="pull-left">Deadline Crossed Tasks</span>
                </div>

                <div class="box-body" style="min-height:60px; max-height: 250px; overflow-y:scroll;padding:0px;">             
                  <?php  
                  while($rowdl = mysql_fetch_assoc($sqldl))
                  { 
                    ?>
                    <a  href='home.php?t=dltc&id=<?=$rowdl['rem_id']?>'>
                      <div style="background-color:#d6d6c2;margin-bottom: 3px;">
                        
                      

                      <p style="padding: 2px;" class='card-text' style='font-size:10px; margin-top:-10px;'>
                        <b style='color:#00264d; font-size:12px;font-weight: bold !important;'>Title : </b>
                        <span style="color: #000;font-size:12px;"><?=$rowdl['title']?></span>, 
                        <span class="pull-right" style="width: 35%;">
                          <b style='color:#00264d;font-size:12px;font-weight: bold !important'>Date : </b>
                          <span style="color: #000;font-size:12px;">
                            <?=date('d-M', strtotime($rowdl['from_date']))?> <?=date('y H:i A', strtotime($rowdl['from_date']))?>
                          </span>
                        </span>
                        <br> 
                        <b style='color:#00264d; font-size:12px;font-weight: bold !important'>For : </b>
                        <?php 
                        

                        $ssqldl = mysql_query("SELECT user.ufname, user.ulname, reminder_participants.status as rps from user INNER JOIN reminder_participants ON reminder_participants.userid=user.userid AND reminder_participants.rem_id=".$rowdl['rem_id'],$conn);
                        
                        while($rrowwdl = mysql_fetch_assoc($ssqldl)){ 
                            ?>
                            <span style="color:#000; font-size:12px;"><?php echo $rrowwdl['ufname'].' '.$rrowwdl['ulname']; ?></span>
                            <span style="color:blue; font-size:12px;"> | </span>
                            <?php
                        }
                        ?>
                      </p>
                      </div>
                    </a>
                    <?php

                    
                  }

                  
                  ?>
                </div>
              
            </div>
            
          </div>
        <?php
        } 
        ?>
        
      </div>
    
 

 
      
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

if (isset($_GET['delete_rem']) && $_GET['delete_rem'] == "success")
{ ?>

  <script type="text/javascript">

    $(document).ready(function () {
      $.toast({
          heading: 'Reminder Deleted Successfully',
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
        <h4 class="modal-title" id="myLargeModalLabel"><?php if($_GET['t']=='mtp'){echo "My Task (Pending)";}elseif($_GET['t']=='mtc'){echo "My Task (Complete)";}elseif($_GET['t']=='gtp'){echo "Given Task (Pending)";}elseif($_GET['t']=='gtc'){echo "Given Task (Complete)";}elseif($_GET['t']=='dltc'){echo "Deadline Crossed Task";} ?> : <?=$title?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal form-element col-12" action="update_reminder.php" method="post">

          <input type="hidden" name="rem_id"  id="rem_id" value="<?=$_REQUEST['id']?>">
          
          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Title</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" disabled value="<?php echo $title; ?>">
            </div>
          </div>

          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Description</label>
            <div class="col-sm-9">
              
              <?php
               if ($Status=='Pending' && $created_by==$uu) 
                { ?>
                  <textarea disabled id="user_desc" type="text" class="form-control" name="description" ><?php echo $description; ?></textarea>
               <?php }
                else
                { ?>
                    <textarea type="text" class="form-control" disabled rows="4"><?php echo $description; ?></textarea>
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
                  <input onChange="picker()" disabled type="text" class="form-control disabled" name="t_date" id="t_date" value="<?php echo $to_date  ?>">
               <?php }
                else
                { ?>
                    <input onChange="picker()" type="text" class="form-control" disabled value="<?php echo $to_date  ?>" id="t_date">
               <?php }
              ?>
            </div>
          </div>


          <button style="display: none;" class="btn btn-primary sweet-1" onClick="_gaq.push(['_trackEvent', 'example', 'try', 'sweet-1']);">Try It</button>
          <script type="text/javascript">
            function picker()
            {
                var date_ini = new Date($('#f_date').val());
                var date_end = new Date($('#t_date').val());
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
                var date_ini = new Date($('#f_date').val());
                var start_date = new Date($('#start_date').val());
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
                      <input onChange="picker2()" disabled type="text" class="form-control" name="start_date5" id="start_date" value="<?php echo $start_date  ?>">
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
              <input name="r_require" type="radio" id="Yes" value="1" class="radio-col-yellow" onClick="show1()">
              <label for="Yes">Yes</label>                    
            </div>
            <div class="radio" style="display: inline;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="r_require" type="radio" id="No" value="0" class="radio-col-yellow" onClick="show2()" checked="">
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
          
          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Reply</label>
            <div class="col-sm-9">
             <?php
              $sql = mysql_query("SELECT * FROM reminder_participants rp INNER JOIN reminder r ON rp.rem_id = r.rem_id INNER JOIN user u ON rp.userid = u.userid WHERE r.rem_id =".$_REQUEST['id'],$conn);
              while ($row = mysql_fetch_assoc($sql)) 
                { 
                  echo '<font color="#00C100">'.$row['ufname'].' '.$row['ulname'].':</font>&nbsp;'.$row['comment'].'<br>'; 
                }
            ?>
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


        if($_GET['t']=='mtp'){ 

          if ($Status=='Pending' && $created_by==$_SESSION['id']){
            $i= $_REQUEST['id']; ?>
            <button type='button' class='btn btn-info waves-effect text-right' id="show_save_button">Edit Reminder</button>
            <a href="home.php?delete_rem_id=<?=$_REQUEST['id']?>" class='btn btn-warning waves-effect text-right'>Delete Reminder</a>
          <?php  }

          $sql = "SELECT * FROM reminder_participants WHERE rem_id =".$_REQUEST['id']." AND userid='$sid' ";
          $result = mysql_query($sql,$conn);
          if (mysql_num_rows($result) > 0)
          {
            $row = mysql_fetch_assoc($result);
            if ($row['status']==0) 
            { ?>
              <?php if($_GET['t']=='mtp'){ ?> <a href="home.php?rem_id=<?=$_REQUEST['id']?>&userid=<?=$sid?>" class="btn btn-info waves-effect text-right">Update My status</a> <?php } 
                
            }
          }
          
        }elseif($_GET['t']=='mtc'){ 
          if ($Status=='Done' && $created_by==$_SESSION['id']) 
          { ?>
            <a href="home.php?close_id=<?= $_REQUEST['id']; ?>" class='btn btn-warning waves-effect text-right'>Give Rating</a>
          <?php } 

        }elseif($_GET['t']=='gtp'){ 
          if ($Status=='Pending' && $created_by==$_SESSION['id']){
            $i= $_REQUEST['id']; ?>
            <button type='button' class='btn btn-info waves-effect text-right' id="show_save_button">Edit Reminder</button>
            <a href="home.php?delete_rem_id=<?=$_REQUEST['id']?>" class='btn btn-warning waves-effect text-right'>Delete Reminder</a>
            <?php  
          }
          
        }elseif($_GET['t']=='gtc'){ 

          if($Status=='Done' && $created_by==$_SESSION['id']){ 
            ?>
            <a href="home.php?close_id=<?= $_REQUEST['id']; ?>" class='btn btn-warning waves-effect text-right'>Give Rating</a>
            <?php 
          }
        }elseif($_GET['t']=='dltc'){ 

          if($Status=='Pending' && $created_by==$_SESSION['id']) { 
            ?>
            <button type="button" id="saveChanges" class="btn btn-primary float-right align-self-center" style="display:none;">Save changes</button>


            <button type='button' class='btn btn-info waves-effect text-right' id="expandDeadline"  style="font-weight: bold !important;">Expand Deadline</button>
            
            <a href="home.php?close_id=<?= $_REQUEST['id']; ?>" class='btn btn-warning waves-effect text-right'>End Task</a>

            <?php 
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
                    <div class="col-md-11"><br>
                      <span style="float: left; margin: 5px 8px 0px 10px; width: 100px;margin-top: 10px;">Remark</span>

                      <input class="form-control" name="remark">

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

    


    jQuery('#expandDeadline').click(function(event){        
         $('#saveChanges').show();
         $('#expandDeadline').hide();
         $('#t_date').prop('disabled', false);
         $('#t_date').focus();
    });


    

    jQuery('#saveChanges').click(function(event){    

        var tdate=$('#t_date').val();
        var remid=$('#rem_id').val();

        $.post("ajax.php",{act:'expandDeadlineSave',tdate:tdate, remid:remid}, function(data){

          // console.log(data);

            if(data.includes("saved")){

              $('#save_button').hide();

              $.toast({
                  heading: 'Deadline Expanded Successfully',
                  text: 'You can see added reminder on calendar',
                  position: 'top-right',
                  loaderBg: '#ff6849',
                  icon: 'success',
                  hideAfter: 3500,
                  stack: 6
              });
            }
        });
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