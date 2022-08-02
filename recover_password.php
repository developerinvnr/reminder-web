<?php
    session_start();
    if (isset($_SESSION['id']))
    {
        header('Location: home.php');
    }
?>
<?php
    include "config.php";
    if (isset($_POST['submit']))
    {
        $email = $_REQUEST['email'];
        $pwd = md5($_POST['pwd']);
        $sql = "UPDATE user SET upwd='$pwd' WHERE uemail='$email' ";
        $result = mysql_query($sql,$conn);
        if ($result)
        {
            header('Location: index.php?recover=success');
        }
        else
        {
            header('Location: index.php?recover=fail');
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
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css"> -->
<link rel="stylesheet" href="assets/vendor_components/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/vendor_components/bootstrap/dist/css/bootstrap-extend.css">
<link rel="stylesheet" href="css/master_style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet'>
  <style type="text/css">
    html,body 
    {
      height:100%;
      width:100%;
      margin:0;
    }
    body , body
    {
      display:flex;
    }
    form 
    {
      margin:auto;
    }
    @media screen and (max-width: 700px) 
    {
        .small_screen
        {
          margin: auto;
          /*padding: auto;*/
          /*width: 60%;*/
        }
    }
  </style>
</head>
<body>


<body style="background-color:#D4A814;">
<div class="login-box">
  <div class="login-logo"><b style="font-family: Sofia;font-size: 35px;">Reminder</b></div>
  <!-- /.login-logo -->
  <div class="login-box-body" style="box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22); border-top: 5px solid #45aef1; border-radius: 10px;">

    <?php
    if (isset($_GET['user_varified']) && $_GET['user_varified'] == "yes")
    {
        echo "
        <div class='alert alert-success alert-dismissible fade in'>
        <a href='table.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Success!</strong> User registered.
        </div>
        ";
    }
    else if(isset($_GET['user_varified']) && $_GET['user_varified'] == "no")
    {
        echo "
        <div class='alert alert-danger alert-dismissible fade in'>
        <a href='table.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Error..! registration fail.</strong>
        </div>
        ";
    }
    else if(isset($_GET['login']) && $_GET['login'] == "fail")
    {
        echo "
        <div class='alert alert-danger alert-dismissible fade in'>
        <a href='table.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Error..! login fail.</strong>
        </div>
        ";
    }
    else if(isset($_GET['already_user']) && $_GET['already_user'] == "success")
    {
        echo "
        <div class='alert alert-danger alert-dismissible fade in'>
        <a href='table.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Email Already Exist..!</strong>
        </div>
        ";
    }


    ?>

    <p class="login-box-msg">Set new password</p>

    <form action="#" method="post" class="form-element">
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Enter Password" name="pwd" required>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Confirm Pasword" name="con_pwd" required>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-12">
        </div>
        <!-- /.col -->
        <div class="col-12 text-center">
          <!-- <button type="submit" class="btn btn-block btn-flat margin-top-10" style="background-color:#EDD736;">SIGN IN</button> -->
          <input type="submit" name="submit" value="Submit" class="btn btn-block btn-flat margin-top-10" style="background-color:#EDD736;">
        </div>
        <!-- /.col -->
      </div>
    </form>

 
   <!--  <div class="margin-top-30 text-center">
      <p>Suddenly remember password ? <a href="index.php" class="text-info m-l-5">Sign In</a></p>
    </div> -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

  <script src="assets/vendor_components/jquery/dist/jquery.min.js"></script>
  <script src="assets/vendor_components/popper/dist/popper.min.js"></script>
  <script src="assets/vendor_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
