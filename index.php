<?php
    session_start();
    include "config.php";
    if (isset($_COOKIE["c_id"]) && !empty($_COOKIE["c_id"]))
    {
      $sql = "SELECT * FROM user WHERE userid=".$_COOKIE["c_id"];
      $result = mysql_query($sql,$conn);
      if (mysql_num_rows($result) > 0)
      {
        $row = mysql_fetch_assoc($result);
        $_SESSION['id'] = $row['userid'];
        $_SESSION['utype'] = $row['utype'];
        $_SESSION['ufname'] = $row['ufname'];
        $_SESSION['ulname'] = $row['ulname'];
        $_SESSION['uemail'] = $row['uemail'];
        setcookie("c_id", $_SESSION['id'], time() + (86400 * 30), "/");
        setcookie("c_utype", $_SESSION['utype'], time() + (86400 * 30), "/");
        setcookie("c_ufname", $_SESSION['ufname'], time() + (86400 * 30), "/");
        setcookie("c_ulname", $_SESSION['ulname'], time() + (86400 * 30), "/");
        setcookie("c_uemail", $_SESSION['uemail'], time() + (86400 * 30), "/");
        // header('Location: home.php');
      }
    }
    if (isset($_SESSION['id']))
    {
        header('Location: home.php');
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
<link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet'>
<link rel="stylesheet" href="assets/vendor_components/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/vendor_components/bootstrap/dist/css/bootstrap-extend.css">
<link rel="stylesheet" href="css/master_style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
<div class="login-box small_screen">
  <div class="login-logo"><b style="font-family: Sofia;font-size: 35px;">Surta</b></div>
  <div class="login-box-body" style="box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22); border-top: 5px solid #45aef1; border-radius: 10px;">
    <?php
    if (isset($_GET['user_varified']) && $_GET['user_varified'] == "yes")
    { ?>
        <div class="alert alert-success alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success!</strong> User registered. Please check your email.
        </div>
   <?php }
    else if(isset($_GET['user_varified']) && $_GET['user_varified'] == "no")
    { ?>
        <div class="alert alert-danger alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error..! registration fail.</strong>
        </div>
   <?php }
    else if(isset($_GET['already_user']) && $_GET['already_user'] == "success")
    {?>
        <div class="alert alert-danger alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Email Already Exist..!</strong>
        </div>
   <?php }
    else if(isset($_GET['recover']) && $_GET['recover'] == "success")
    {?>
        <div class="alert alert-success alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Password changed Successfully..!</strong>Please login with your credentials
        </div>
   <?php }
   else if(isset($_GET['login']) && $_GET['login'] == "fail")
    {?>
        <div class="alert alert-danger alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Login Failed..!</strong>Please check email & password
        </div>
   <?php }
    ?>
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="login_logic.php" method="post" class="form-element" onsubmit="ShowLoading()">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email" required autofocus autocomplete="off">
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" required name="pwd">
      </div>
      <div class="row">
        <div class="col-12">
         <div class="fog-pwd">
            <a href="forgot_password.php"><i class="ion ion-locked"></i> Forgot pwd?</a><br>
          </div>
        </div>
        <div class="col-12 text-center">
          <input type="submit" name="submit" value="SIGN IN" class="btn btn-block btn-flat margin-top-10" style="background-color:#EDD736; height: 35px;">
        </div>
      </div>
    </form>
    <div class="margin-top-30 text-center">
      <p>Don't have an account? <a href="register.php" class="text-info m-l-5">Sign Up</a></p>
    </div>

  </div>
</div>
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