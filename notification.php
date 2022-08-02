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
<link rel="stylesheet" href="assets/vendor_plugins/iCheck/flat/blue.css">
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
    <section class="content-header">
      <h1>
        Notification
      </h1>
      <ol class="breadcrumb">
        <span class="pull-left"><li class="breadcrumb-item"><a href="home.php">< Back</a></li></span>

        <span class="pull-right">
        <li class="breadcrumb-item"><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item active">Notification</li>
        </span>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        
        <!-- /.col -->
        <div class="col-lg-12 col-12">
          <div class="box box-primary">
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-outline btn-sm checkbox-toggle" onclick="window.location='add_notification.php';"><i class="ion ion-plus"></i> New notification
                </button>
                <!-- /.btn-group -->
                
                <!-- /.btn-group -->
                <div class="pull-right">
                  1-50/200
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-outline btn-sm"><i class="fa fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-default btn-outline btn-sm"><i class="fa fa-chevron-right"></i></button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
              <div class="mailbox-messages">
                <table class="table table-hover table-striped table-responsive table-condensed">
                  <tbody>
                    <?php
                      if(get_user_type($_SESSION['id'])=='A')
                      {
                        $select_not = "SELECT * FROM user_notification";
                      }
                      else
                      {
                        $select_not = "SELECT * FROM user_notification n INNER JOIN user_notification_user nu ON nu.nid=n.nid WHERE nu.userid=".$_SESSION['id'];
                      }
                      $result = mysql_query($select_not,$conn);
                      while($row = mysql_fetch_assoc($result))
                      { ?>
                        <tr onclick="window.location='read_notification.php?nid=<?=$row['nid']?>';" style="cursor: pointer;">
                        <td class="mailbox-name"><?=get_name($row['created_by'])?></td>
                        <td class="mailbox-subject"><?=$row['title']?></td>
                        <td class="mailbox-attachment"></td>
                        <td class="mailbox-date"><?=date('d-m-Y', strtotime($row['created_at']))?></td>
                        </tr>
                     <?php } ?>
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
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
  
  <footer class="main-footer">
    <?php include("footer.php"); ?>
  </footer>

  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<script src="assets/vendor_components/jquery/dist/jquery.min.js"></script>
<script src="assets/vendor_components/popper/dist/popper.min.js"></script>
<script src="assets/vendor_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="assets/vendor_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="assets/vendor_components/fastclick/lib/fastclick.js"></script>
<script src="js/template.js"></script>
<script src="assets/vendor_plugins/iCheck/icheck.js"></script>
<script src="js/pages/mailbox.js"></script>
<script src="js/demo.js"></script>
</body>
</html>
