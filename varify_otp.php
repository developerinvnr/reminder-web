<?php 
include "config.php";
if (isset($_POST['varify']) && isset($_REQUEST['email']))
{
    $email = $_REQUEST['email'];
    $otp = $_POST["otp"];
    $check = "SELECT * FROM user WHERE otp='$otp' AND uemail='$email' ";
    $r = mysql_query($check, $conn);
    if (mysql_num_rows($r)>0) 
    {
        header('Location: recover_password.php?email='.$email);
    }
}
elseif (isset($_POST['varify'])) 
{
  $otp = $_POST["otp"];
  $check = "SELECT * FROM user WHERE otp='$otp' ";
  $r = mysql_query($check, $conn);
  if (mysql_num_rows($r)>0) 
  {
    $row=mysql_fetch_assoc($r);
    $email=$row['uemail'];
    $pwd=$row['upwd'];
    $fname=$row['ufname'];
    $lname=$row['ulname'];
    
    
    $sql = "UPDATE user SET otp_varified=1 WHERE otp='$otp' ";
    $result = mysql_query($sql,$conn);

    $from = "no-reply-reminder@maierp.in";
    $subject = "Registration successful";
    $message = " Dear ".$fname." ".$lname.",

  Congratulations! You have been registered successfully on Reminder App.
  Please go through the following details for login your account.

  "."Username : ".$email."
  Password : ".$pwd."(one time password)

  Thanks
  Team Reminder";
    $mail = mail($email, $subject, $message, "From: $from");


    $sql = "UPDATE user SET upwd='".md5($row['upwd'])."' WHERE userid='".$row['userid']."' ";
    $result = mysql_query($sql,$conn);


    header('Location: index.php?user_varified=yes');
  }
  else
  {
      header('Location: index.php?user_varified=no');
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Reminder</title>
  <link rel="icon" href="images/favicon.png">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="stylesheet" href="assets/vendor_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/vendor_components/bootstrap/dist/css/bootstrap-extend.css">
  <link rel="stylesheet" href="css/master_style.css">
  <link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet'>
  <script src="assets/vendor_components/jquery/dist/jquery.min.js"></script>
  <script src="assets/vendor_components/bootstrap/dist/js/bootstrap.min.js"></script>
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
<body class="hold-transition register-page" style="background-color:#D4A814;">
<div class="register-box">
  <div class="login-logo"><b style="font-family: Sofia;font-size: 35px;">Reminder</b></div>

  <div class="login-box-body" style="box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22); border-top: 5px solid #45aef1; border-radius: 10px;">
    <p class="login-box-msg">Verify OTP sent on your mobile</p>

    <form method="post" class="form-element" onsubmit="ShowLoading()">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Enter OTP" name="otp" required autofocus>
        <span class="ion ion-person form-control-feedback "></span>
      </div>
      <div class="row">
        <div class="col-12">
          
        </div>
        <!-- /.col -->
        <div class="col-12 text-center">
          <button type="submit" name="varify" class="btn btn-block btn-flat margin-top-10" style="background-color:#EDD736;">VERIFY</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    
     <div class="margin-top-20 text-center">
      <p>Already have an account?<a href="index.php" class="text-info m-l-5"> Sign In</a></p>
     </div>
    
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->
</body>
</html>


<script type="text/javascript">
    function ShowLoading(e) {
        var div = document.createElement('div');
        var img = document.createElement('img');
        img.src = 'loader.gif';
        div.innerHTML = "<br><br><br><br><br><br><br><br><br><br><br><br><br><br>Loading...<br />";
        div.style.cssText = 'position: fixed; top: 0; left: 0; z-index: 5000; width: 100%; height : 100vh; text-align: center; background: rgb(0,0,0,0.5); color: white; border: 1px solid #000';
        div.appendChild(img);
        document.body.appendChild(div);
        return true;
    }
</script>
