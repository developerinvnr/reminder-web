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

  if (isset($_POST['submit'])) 
  {
    $title = $_POST['title'];
    $description = $_POST['description'];

    $new_not = "INSERT INTO user_notification(title, description, created_by) VALUES('".$_POST['title']."', '".$_POST['description']."', '".$uu."')";
    $res = mysql_query($new_not, $conn);
    $last_id = mysql_insert_id($conn);
    if ($res) 
    {
      foreach ($_POST['par'] as $value) 
      {
        $not_user = "INSERT INTO user_notification_user(nid, userid) VALUES('".$last_id."', '".$value."')";
        $result = mysql_query($not_user, $conn);
      }
      echo "<script>window.location='notification.php?msg=success';</script>";
    }
  }




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
<link rel="stylesheet" href="assets/vendor_components/glyphicons/glyphicon.css">
<link rel="stylesheet" href="css/master_style.css">
<link rel="stylesheet" href="css/skins/_all-skins.css">	
<link rel="stylesheet" href="assets/vendor_plugins/iCheck/flat/blue.css">
<link rel="stylesheet" href="assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<link rel="stylesheet" href="assets/vendor_components/select2/dist/css/select2.min.css">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
</head>
<body class="hold-transition skin-yellow-light sidebar-mini">
<div class="wrapper">

  <?php include("header.php"); ?>
  
  <aside class="main-sidebar">
    <section class="sidebar"><?php include("menu.php"); ?></section>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="margin-top: -20px;">
      <!-- <h1>
        Compose
      </h1> -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item active">Compose</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <div class="col-lg-12 col-12" style="margin-top: -20px;">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Compose New Notification</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form method="post" action="#">
              <div class="form-group">
                <!-- <input class="form-control" placeholder="To:"> -->
                <select id="part" class="form-control select2" multiple="multiple" data-placeholder="Choose Participants" style="width: 100%" name="par[]" required>
            <?php
              // $sql = "SELECT * FROM user WHERE user_varified='Yes' ";
              if(get_user_type($_SESSION['id'])=='A')
              {
                $sql = "SELECT * FROM user WHERE user_varified='Yes' AND userid!=".$_SESSION['id']; 
              }
              else
              {
                $sql = "SELECT * FROM contact_request WHERE request_approve=1 AND (request_by='".$_SESSION['id']."' OR  request_to='".$_SESSION['id']."') ";                
              }
              $result = mysql_query($sql,$conn);
              if (mysql_num_rows($result) > 0)
              {
                echo '<option value="'.$_SESSION['id'].'">'."&nbsp;&nbsp;".get_name($_SESSION['id']).'</option>';
                while ($row = mysql_fetch_assoc($result)) 
                {
                  if(get_user_type($_SESSION['id'])=='A')
                  {
                      $uid = $row['userid'];
                      $fname = $row['ufname']; 
                      $lname = $row['ulname']; 
                      echo '<option value="'.$uid.'">'."&nbsp;&nbsp;".$fname.' '.$lname.'</option>';
                  }
                  else
                  {
                      if ($row['request_by']==$_SESSION['id']) 
                      {
                        echo '<option value="'.$row['request_to'].'">'."&nbsp;&nbsp;".get_name($row['request_to']).'</option>';
                      }
                      else
                      {
                          echo '<option value="'.$row['request_by'].'">'."&nbsp;&nbsp;".get_name($row['request_by']).'</option>';
                      }
                  }
                }
              }
            ?>
            </select>

              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Title:" name="title" required>
              </div>
              <div class="form-group">
                    <textarea id="compose-textarea" name="description" class="form-control" style="height: 300px" placeholder="Your Message Here...." required>
                    </textarea>
              </div>
              
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <div class="pull-right">
                <button type="submit" class="btn btn-orange" name="submit"><i class="fa fa-envelope-o"></i> Send</button>
              </div>
              <button onclick="window.location='notification.php'" type="reset" class="btn btn-orange"><i class="fa fa-times"></i> Discard</button>
            </div>
            </form>
            <!-- /.box-footer -->
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
    <div class="pull-right d-none d-sm-inline-block">
      <b>Version</b> 1.1
    </div>Copyright &copy; 2018 <a href="https://www.multipurposethemes.com/">Multi-Purpose Themes</a>. All Rights Reserved.
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
	<script src="js/demo.js"></script>
  <script src="assets/vendor_components/select2/dist/js/select2.full.js"></script>
  <script src="js/pages/advanced-form-element.js"></script>
	<script src="assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
	<script>
	  $(function () {
		//Add text editor
		$("#compose-textarea").wysihtml5();
	  });
	</script>
</body>
</html>
