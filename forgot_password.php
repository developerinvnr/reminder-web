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
        $email = $_POST['email'];
        $sql = "SELECT * FROM user WHERE uemail='$email'";
        $result = mysql_query($sql,$conn);
        if (mysql_num_rows($result)>0) 
        {
            $row = mysql_fetch_assoc($result);
            $mobile =  $row['ucontact'];
            $uname =  $row['ufname'];
            $otp = rand(11111,99999);

            $sql = "UPDATE user SET otp=$otp WHERE uemail='$email' ";
            $result = mysql_query($sql,$conn);
            if ($result) 
            {
                $username = "developerinvnr@gmail.com";
                $hash = "736397e8c20036f67d304d4d8ee316720a93c9d9d83046cbb453303194086efa";
                $test = "0";
                $sender = "REMIND";
                $message = "Dear $uname,


 $otp is an OTP for reset password.


Reminder";
                $message = urlencode($message);
                $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$mobile."&test=".$test;
                $ch = curl_init('http://api.textlocal.in/send/?');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $result = curl_exec($ch); 
                curl_close($ch);
                header('Location: varify_otp.php?email='.$email);
            }

            
        }
        else
        {
            header('Location: forgot_password.php?email=fail');
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
<link rel="stylesheet" href="css/master_style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
        }
    }
  </style>
</head>
<body>

<body style="background-color:#D4A814;">
<div class="login-box">
  <div class="login-logo"><b style="font-family: Sofia;font-size: 35px;">Reminder</b></div>
  <div class="login-box-body" style="box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22); border-top: 5px solid #45aef1; border-radius: 10px;">
    <?php
    if (isset($_GET['email']) && $_GET['email'] == "fail")
    { ?>
        <div class="alert alert-danger alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Failed!</strong> Email not found..!
        </div>
   <?php } ?>

    <p class="login-box-msg">Forgot Password</p>

    <form action="#" method="post" class="form-element">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Enter your registered email" name="email" required autofocus>
      </div>
      <div class="row">
        <div class="col-12">
        </div>
        <div class="col-12 text-center">
          <input type="submit" name="submit" value="RECOVER" class="btn btn-block btn-flat margin-top-10" style="background-color:#EDD736; height: 35px">
        </div>
      </div>
    </form>
    <div class="margin-top-30 text-center">
        <p>Suddenly remember password ? <a href="index.php" class="text-info m-l-5">Sign In</a></p>
    </div>
  </div>
</div>
</body>
</html>
