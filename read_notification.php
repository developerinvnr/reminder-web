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

  $select_not = "SELECT * FROM user_notification WHERE nid=".$_GET['nid'];
  $result = mysql_query($select_not,$conn);
  $res = mysql_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="images/favicon.ico">
<title><?php include("tital.php"); ?></title>
<link rel="stylesheet" href="assets/vendor_components/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/vendor_components/bootstrap/dist/css/bootstrap-extend.css">
<link rel="stylesheet" href="assets/vendor_components/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/vendor_components/Ionicons/css/ionicons.min.css">
<link rel="stylesheet" href="css/master_style.css">
<link rel="stylesheet" href="css/skins/_all-skins.css">	
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
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
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="margin-top: -20px;">
      <ol class="breadcrumb">
        <span class="pull-left">
        <li class="breadcrumb-item"><a href="notification.php">< Back</a></li>
        </span>
        <span class="pull-right">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item active">Notification Box</li>
        </span>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" style="margin-top: -20px;">
      <div class="row">
        <!-- /.col -->
        <div class="col-lg-12 col-12">
          <div class="box box-primary">
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-info">
                <h3><?=$res['title']?></h3>
              </div>
              <div class="mailbox-read-info clearfix">
				<div class="left-float margin-r-5"><a href="#"><img src="images/user.jpg" alt="user" width="40" class="rounded-circle"></a></div>
                <h5 class="no-margin"><?=get_name($res['created_by'])?><br>
                     <small>From: <?=get_mail($res['created_by'])?></small>
                  <span class="mailbox-read-time pull-right">22 JUL. 2017 08:03 PM</span></h5>
              </div>
              <!-- /.mailbox-read-info -->
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
                <p>Dear USer,</p>

                <?=$res['description']?>
                
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
   
  <footer class="main-footer" style="margin-top: -40px;">
    <?php include("footer.php"); ?>
  </footer>
 <!-- /.control-sidebar -->
  
  <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
	<script src="assets/vendor_components/jquery/dist/jquery.min.js"></script>
	<script src="assets/vendor_components/popper/dist/popper.min.js"></script>
	<script src="assets/vendor_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="assets/vendor_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/vendor_components/fastclick/lib/fastclick.js"></script>
	<script src="js/template.js"></script>
	<script src="js/demo.js"></script>
</body>
</html>
