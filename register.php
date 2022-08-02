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
  <link rel="stylesheet" href="css/master_style.css">
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
<body class="hold-transition register-page" style="background-color:#D4A814;">
<div class="register-box">
  <div class="login-logo"><b style="font-family: Sofia;font-size: 35px;">Reminder</b></div>

  <div class="register-box-body" style="box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22); border-top: 5px solid #45aef1; border-radius: 10px;">
    <p class="login-box-msg">Register a new membership</p>

    <form action="register_logic.php" method="post" class="form-element" onsubmit="ShowLoading()">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="First Name" name="fname" required autocomplete="off" autofocus>
        <span class="ion ion-person form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Last name" name="lname" required autocomplete="off">
        <span class="ion ion-person form-control-feedback "></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email" required autocomplete="off">
        <span class="ion ion-email form-control-feedback "></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Mobile" name="mobile" required autocomplete="off">
        <span class="ion ion-email form-control-feedback "></span>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="checkbox">
            <input type="checkbox" id="basic_checkbox_1" onchange="document.getElementById('buttonID').disabled = !this.checked;">
      <label for="basic_checkbox_1">I agree to the <a href="#"><b>Terms</b></a></label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-12 text-center">
          <button type="submit" id="buttonID" class="btn btn-block btn-flat margin-top-10" style="background-color:#EDD736; height: 35px;" disabled>SIGN UP</button>
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
  <!-- <script src="assets/vendor_components/bootstrap/dist/js/bootstrap.min.js"></script> -->
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
