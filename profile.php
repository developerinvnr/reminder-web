<?php
    session_start();
    include "config.php";
    if (!isset($_SESSION['id']))
    {
        header('Location: index.php');
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
  <!-- <link rel="stylesheet" href="assets/vendor_components/Ionicons/css/ionicons.min.css"> -->
  <link rel="stylesheet" href="css/master_style.css">
  <link rel="stylesheet" href="css/skins/_all-skins.css"> 
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

  <link rel="stylesheet" href="css/sweetalert.css">
  <link rel="stylesheet" href="css/croppie.css" />
  <style type="text/css">
   p{
      text-align: justify;
      text-justify: inter-word;
    }
  @media only screen and (min-width: 1000px) {
    .contentdiv{width: 60%;margin: 0 auto;}
  }
  .contentdiv{height: 50px;margin-top: -10px;}
  .cusdet{
    width:85px;
    display: inline-block;
    font-weight: bold;
  }
  .cusdetval{
    display: inline-block;
    font-weight: bold;

  }
  .cusdetinp{
    border-bottom:1px solid #c1c1c1;
    padding: 4px;
    border-radius: 3px;
    background-color:rgba(0,0,0,0);
  }
  input[type="file"] {
    display: none;
  }
  .custom-file-upload {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 3px;
    margin:0px;
    cursor: pointer;
    font-size: 11px;
    background-color: #592116;
    color: white;
    font-weight: bold;
    margin-top: -65px;
    float: right;
    border-radius: 10px;
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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <!--<h1>
        User Profile
      </h1>-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
        <li class="breadcrumb-item active">User profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-xl-4 col-lg-5">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <!-- <img class="mx-auto d-block img-responsive" src="images/user.jpg" alt="User profile picture" height="90px" style="border-radius:80%"> -->

                <?php
                  $sql = "SELECT * FROM user WHERE profile_pic!='' AND userid=".$_SESSION['id'];
                  $result = mysql_query($sql,$conn);
                
                /*  if (mysql_num_rows($result)>0) 
                  {
                    $row = mysql_fetch_assoc($result);
                    ?>
                    <img id="cdpimg" class="mx-auto d-block img-responsive" src="<?= $row['profile_pic'] ?>" alt="profile picture not found! Please upload new one" height="90px" width="90px" style="border-radius:80%"/>
                <?php  }
                  else
                  { ?>
                      <img id="cdpimg" class="mx-auto d-block img-responsive" src="images/user.JPG" alt="User profile picture" height="90px" width="90px" style="border-radius:80%"/>

                <?php  }

               /* ?>
                
                <label class="custom-file-upload">
                <input type="file" name="upload_image" id="upload_image" />
                &nbsp;Change Image
                </label>
                */ ?>


                          <div id="uploadimageModal" class="modal" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Upload & Crop Image</h4>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                        <div class="col-md-8 text-center">
                          <div id="image_demo" style="width:350px; margin-top:30px"></div>
                        </div>
                        <div class="col-md-4" style="padding-top:30px;">
                          <br />
                          <br />
                          <br/>
                          <button class="btn btn-success crop_image">Crop & Upload Image</button>
                      </div>
                    </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                  </div>
                </div>
            </div>


              <h3 class="profile-username text-center">
                <?php
                $sql1 = "SELECT * FROM user WHERE userid =".$_SESSION['id'];
                $result1 = mysql_query($sql1,$conn);
                $row = mysql_fetch_assoc($result1);
                echo $row['ufname']." ".$row['ulname'];
              ?>

              </h3>

              <p class="text-muted text-center">Developer</p>
        
              <div class="row social-states">
          <!-- <div class="col-6 text-right"><a href="#" class="link"><i class="ion ion-ios-people-outline"></i> 254</a></div>
          <div class="col-6 text-left"><a href="#" class="link"><i class="ion ion-images"></i> 54</a></div> -->
        </div>
            
              <div class="row">
                <div class="col-12">
                  <div class="profile-user-info">
            <p>Email address </p>
            <h6 class="margin-bottom"><?php echo $row['uemail']; ?></h6>
            <p>Phone</p>
            <h6 class="margin-bottom"><?php echo $row['ucontact']; ?></h6> 
            <p>Address</p>
            <h6 class="margin-bottom"><?php echo $row['address']; ?></h6>
                        
          </div>
              </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-xl-8 col-lg-7">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <!-- <li><a class="<?php if(isset($_REQUEST['update_profile']) || isset($_REQUEST['change_password'])){ echo "";} else{ echo "active"; } ?>" href="#timeline" data-toggle="tab">My Activities</a></li> -->
              <!-- <li><a href="#settings" class="<?php if(isset($_REQUEST['update_profile'])){ echo "active";} ?>" data-toggle="tab">My Profile</a></li> -->
              <li><a href="#settings" class="active" data-toggle="tab">My Profile</a></li>
              <li><a href="#reset" data-toggle="tab" class="<?php if(isset($_REQUEST['change_password'])){ echo "active";} ?>">Reset Password</a></li>
            </ul>



<div class="tab-content">
        
<!-- MY ACTIVITIES MY ACTIVITIES MY ACTIVITIES MY ACTIVITIES MY ACTIVITIES MY ACTIVITIES MY ACTIVITIES MY ACTIVITIES MY ACTIVITIES -->

  <!-- <div class="<?php if(isset($_REQUEST['update_profile']) || isset($_REQUEST['change_password'])){ echo "";}else{ echo "active"; } ?> tab-pane" id="timeline">
    <div class="post">
      <div class="user-block">
        <img class="img-bordered-sm rounded-circle" src="images/user.jpg" alt="user image">
          <span class="username">
            <a href="#">Activity 1</a>
            <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
          </span>
        <span class="description">15 minutes ago</span>
      </div>

      <div class="activitytimeline">
        <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet.
        </p>
      </div>
    </div>
    <div class="post">
      <div class="user-block">
        <img class="img-bordered-sm rounded-circle" src="images/user.jpg" alt="user image">
          <span class="username">
            <a href="#">Activity 2</a>
            <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
          </span>
        <span class="description">20 minutes ago</span>
      </div>

      <div class="activitytimeline">
        <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero.
        </p>
      </div>
    </div>
    <div class="post">
      <div class="user-block">
        <img class="img-bordered-sm rounded-circle" src="images/user.jpg" alt="user image">
          <span class="username">
            <a href="#">Activity 3</a>
            <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
          </span>
        <span class="description">25 minutes ago</span>
      </div>

      <div class="activitytimeline">
        <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit.
        </p>
        
      </div>
    </div>
  </div>
 -->
<!-- MY ACTIVITIES MY ACTIVITIES MY ACTIVITIES MY ACTIVITIES MY ACTIVITIES MY ACTIVITIES MY ACTIVITIES MY ACTIVITIES MY ACTIVITIES MY ACTIVITIES  -->
              
              
<!--  UPDATE PROFILE UPDATE PROFILE UPDATE PROFILE UPDATE PROFILE UPDATE PROFILE UPDATE PROFILE UPDATE PROFILE UPDATE PROFILE UPDATE  -->
<?php 
    $sql = "SELECT * FROM user WHERE userid = ".$_SESSION['id'];
    $result = mysql_query($sql,$conn);
    $row = mysql_fetch_assoc($result);
    $fname = $row['ufname'];
    $lname = $row['ulname'];
    $email = $row['uemail'];
    $contact = $row['ucontact'];
    $dob = date('d-m-Y',strtotime($row['udob']));
    $ann2_date =  date('d-m-Y',strtotime($row['Anniversary']));
    $gender = $row['ugender'];
    $m_status = $row['marital_status'];
    $address = $row['address'];
?>

              <div class="tab-pane <?php if(isset($_REQUEST['change_password']) && $_REQUEST['change_password']!=''){ echo "";}else{echo 'active';} ?>" id="settings">
                <form class="form-horizontal form-element col-12" action="update_profile.php" method="post" onSubmit="ShowLoading()">
                  <br>

                  <div class="form-group row">
                    <label for="inputName" class="col-sm-3 control-label">First Name <span style="color: red">*</span></label>
                    <div class="col-sm-9">
                      <input disabled type="text" class="form-control" id="fname" placeholder="Enter first name" name="fname" autocomplete="off" value="<?php echo $fname; ?>" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputName" class="col-sm-3 control-label">Last Name</label>
                    <div class="col-sm-9">
                      <input disabled type="text" class="form-control" id="lname" placeholder="Enter last name" name="lname" autocomplete="off" value="<?php echo $lname; ?>" >
                    </div>
                  </div>

                  

                  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-3 control-label">Email <span style="color: red">*</span></label>
                    <div class="col-sm-9">
                      <input disabled type="email" class="form-control" id="email" placeholder="Enter email" name="email" autocomplete="off" value="<?php echo $email; ?>" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputPhone" class="col-sm-3 control-label">Phone <span style="color: red">*</span></label>
                    <div class="col-sm-9">
                      <input disabled type="tel" class="form-control" id="mobile" placeholder="Enter phone number" name="mobile" autocomplete="off" value="<?php echo $contact; ?>" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputName" class="col-sm-3 control-label">Gender <span style="color: red">*</span></label>
                    <div class="col-sm-9">
                      <div class="radio" style="display: inline;">
                        <input disabled name="gender" type="radio" id="male" value="Male"
                        <?php 
                          if ($gender=="Male") 
                          {
                            echo "checked";
                          }
                        ?> 
                        >
                        <label for="male">Male</label>                    
                      </div>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="radio" style="display: inline;">
                        <input disabled name="gender" type="radio" id="female" value="Female"
                        <?php 
                          if ($gender=="Female") 
                          {
                            echo "checked";
                          }
                        ?> 

                        >
                        <label for="female">Female</label>   
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputExperience" class="col-sm-3 control-label">Date of Birth <span style="color: red">*</span></label>
                    <div class="col-sm-9">
                      <input disabled type="text" class="form-control" id="dob" placeholder="Enter Date of Birth (dd/mm/yyyy)" name="dob" autocomplete="off" value="<?php if($dob!='0000-00-00' AND $dob!='1970-01-01'){ echo $dob; } ?>" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputSkills" class="col-sm-3 control-label">Marital Status </label>
                    <div class="col-sm-9">
                      <div class="radio" style="display: inline;">
                        <input disabled name="m_status" type="radio" id="married" value="Married"

                        <?php 
                          if ($m_status=="Married") 
                          {
                            echo "checked";
                          }
                        ?> 

                        >
                        <label for="married">Married</label>                    
                      </div>
                      <div class="radio" style="display: inline;">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input disabled name="m_status" type="radio" id="unmarried" value="Unmarried"

                        <?php 
                          if ($m_status=="Unmarried") 
                          {
                            echo "checked";
                          }
                        ?> 

                        >
                        <label for="unmarried">Unmarried</label>   
                      </div>
                    </div>
                  </div>

                  <div class="form-group row" id="hide" style="display:<?php 

                  if ($m_status=="Unmarried") 
                  {
                    echo "none";
                  }

                   ?>">
                    <label for="inputSkills" class="col-sm-3 control-label">Anniversary Date</label>
                    <div class="col-sm-9"><?php //echo $ann2_date; ?>
                      <input type="text" class="form-control" id="ann_date" placeholder="Enter Anniversary Date (dd/mm/yyyy)" name="ann_date" value="<?php if($ann2_date!='0000-00-00' AND $ann2_date!='1970-01-01'){ echo $ann2_date; } ?>" disabled autocomplete="off" />
                    </div>
                  </div>


                  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-3 control-label">Address</label>
                    <div class="col-sm-9">
                      <textarea disabled class="form-control" placeholder="Enter address" name="address" id="address" autocomplete="off"><?= $address ?></textarea>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="ml-auto col-sm-10">
                      <div class="checkbox">
                        <input type="checkbox" id="basic_checkbox_1" checked>
            <label for="basic_checkbox_1"> I agree to the</label>
                          &nbsp;&nbsp;&nbsp;&nbsp;<a href="#">Terms and Conditions</a>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="ml-auto col-sm-10">
                      <button type="button" id="update_btn" class="btn btn-orange" onclick="check_click()">Update Profile</button>
                      <button type="submit" id="save_btn" class="btn btn-success" style="display: none;">Save Profile</button>

                      <input type="hidden" value="closed" id="btn_status">      



                    </div>
                  </div>
                </form>

              </div><!-- /.tab-pane -->

<!--  UPDATE PROFILE UPDATE PROFILE UPDATE PROFILE UPDATE PROFILE UPDATE PROFILE UPDATE PROFILE UPDATE PROFILE UPDATE PROFILE UPDATE -->


<!-- RESET PASSWORD RESET PASSWORD RESET PASSWORD RESET PASSWORD RESET PASSWORD RESET PASSWORD RESET PASSWORD RESET PASSWORD  -->
                <div class="tab-pane <?php if(isset($_REQUEST['change_password']) && $_REQUEST['change_password']!=''){ echo "active";} ?>" id="reset">

                <form class="form-horizontal form-element col-12" action="change_password.php" method="post" id="rs" onSubmit="ShowLoading()">
                  <br>
                  <div class="form-group row">
                    <label for="inputName" class="col-sm-3 control-label">Current Password <span style="color: red">*</span></label>
                    <div class="col-sm-9">
                      <input disabled type="password" class="form-control" placeholder="Enter current password" id="old_pass" name="old_pass" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-3 control-label">New Password <span style="color: red">*</span></label>

                    <div class="col-sm-9">
                      <input disabled type="password" class="form-control" placeholder="Enter new password" name="new_pass" id="new_pass" required >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPhone" class="col-sm-3 control-label">Confirm Password<span style="color: red">*</span></label>

                    <div class="col-sm-9">
                      <input disabled type="password" class="form-control" placeholder="Confirm password" name="con_pass" id="con_pass" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="ml-auto col-sm-10">
                      <div class="checkbox">
                        <input type="checkbox" id="basic" checked="">
            <label for="basic"> I agree to the</label>
                          &nbsp;&nbsp;&nbsp;&nbsp;<a href="#">Terms and Conditions</a>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="ml-auto col-sm-10">
                      <!-- <input type="submit" class="btn btn-orange" onclick="check_pass()" value="Update"> -->
                      <button type="button" class="btn btn-orange" id="update_pass" onclick="pass_tab()">Change Password</button>
                      <button type="submit" onclick="return check_old_pass()" class="btn btn-success" id="save_pass" style="display: none;">Save Password</button>
                      <input type="hidden" value="closed" id="pass_status">
                    </div>
                  </div>
                </form>
              </div><!-- /.tab-pane -->

              <style type="text/css">
                .red
                {
                  border-bottom: 1px solid red;
                }
              </style>




              <button style="display: none;" class="btn btn-primary sweet-1" onclick="_gaq.push(['_trackEvent', 'example', 'try', 'sweet-1']);">Try It</button>
                            <script>
      document.querySelector('.sweet-1').onclick = function(){
        swal("Here's a message!");
      };
</script>




              <script type="text/javascript">
                var old_pass = document.getElementById('old_pass');
                var new_pass = document.getElementById('new_pass');
                var con_pass = document.getElementById('con_pass');
                function check_old_pass()
                {
                  if (old_pass.value=="") 
                  {
                      swal({
                        title: "Warning..!",
                        text: "Please enter old password!",
                        type: "warning"
                      });
                      return false; 
                  }
                  if (new_pass.value=="") 
                  {
                      swal({
                        title: "Warning..!",
                        text: "Please enter new password!",
                        type: "warning"
                      });
                      return false; 
                  }
                  if (new_pass.length<=4) 
                  {
                      swal({
                        title: "Warning..!",
                        text: "Poor Password!",
                        type: "warning"
                      });
                      return false; 
                  }
                
                  if (con_pass.value=="") 
                  {
                    swal({
                        title: "Warning..!",
                        text: "Confirm Password field cannot be null!",
                        type: "warning"
                      });
                      return false; 
                  }
                 if (con_pass.value!=new_pass.value) 
                  {
                      swal({
                        title: "Warning..!",
                        text: "Password Not match..!",
                        type: "danger"
                      });
                      return false; 
                  }
                  if (old_pass.value==con_pass.value==new_pass.value) 
                  {
                      alert("Please Enter new password Which is never used before");
                      swal({
                        title: "Warning..!",
                        text: "Please Enter new password Which is never used before",
                        type: "warning"
                      });
                      return false; 
                  }
                }
                  
              </script>

<!--  RESET PASSWORD RESET PASSWORD RESET PASSWORD RESET PASSWORD RESET PASSWORD RESET PASSWORD RESET PASSWORD RESET PASSWORD  -->



            </div><!-- /.tab-content -->
          </div><!-- /.nav-tabs-custom -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
 
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
  <!-- <script src="assets/vendor_components/fastclick/lib/fastclick.js"></script> -->
  <script src="js/template.js"></script>
  <script src="js/demo.js"></script>
  <script src="js/sweetalert.js"></script>
  <script src="js/croppie.js"></script>

  <script>  
$(document).ready(function(){

  $image_crop = $('#image_demo').croppie({
    enableExif: true,
    viewport: {
      width:200,
      height:200,
      type:'square' //circle
    },
    boundary:{
      width:300,
      height:300
    }
  });

  $('#upload_image').on('change', function(){
    var reader = new FileReader();
    reader.onload = function (event) {
      $image_crop.croppie('bind', {
        url: event.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
    $('#uploadimageModal').modal('show');
  });

  $('.crop_image').click(function(event){
    $image_crop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function(response){
      $.ajax({
        url:"upload.php",
        type: "POST",
        data:{"image": response},
        success:function(data)
        {
          $('#uploadimageModal').modal('hide');
          $('#uploaded_image').html(data);
          location.reload();
        }
      });
    })
  });

});  
</script>


  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
   <script>
      $(document).ready(function(){
      var from_date_input=$('input[name="dob"]'); //our date input has the name "date"
      var to_date_input=$('input[name="ann_date"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      from_date_input.datepicker({
      format: 'dd-mm-yyyy',
      container: container,
      todayHighlight: true,
      autoclose: true,
      })
      to_date_input.datepicker({
      format: 'dd-mm-yyyy',
      container: container,
      todayHighlight: true,
      autoclose: true,
      })
      })
   </script>

   <!-- dfsbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb -->
<button class="tst3 btn btn-success" style="display: none;"></button>
<button class="tst4 btn btn-danger" style="display: none;"></button>
<?php
if (isset($_GET['update_profile']) && $_GET['update_profile'] == "success")
{ ?>

  <script type="text/javascript">

    $(document).ready(function () {
      $.toast({
          heading: 'Profile Successfully Updated',
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
else if(isset($_GET['update_profile']) && $_GET['update_profile'] == "fail")
{ ?>
    
  <script type="text/javascript">
   $(document).ready(function () {
        $.toast({
            heading: 'Profile Updation fail',
            text: 'Please try again later',
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'error',
            hideAfter: 3500

        });

    });
  </script>

<?php  }
?>


<?php
if (isset($_GET['change_password']) && $_GET['change_password'] == "success")
{ ?>

  <script type="text/javascript">

    $(document).ready(function () {
      $.toast({
          heading: 'Password Changed Successfully',
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
else if(isset($_GET['change_password']) && $_GET['change_password'] == "fail")
{ ?>
    
  <script type="text/javascript">
   $(document).ready(function () {
        $.toast({
            heading: 'Unexpected Error..!',
            text: 'Please try again with valid password',
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'error',
            hideAfter: 3500

        });

    });
  </script>

<?php  }
?>

<link rel="stylesheet" type="text/css" href="assets\vendor_components\jquery-toast-plugin-master\src\jquery.toast.css">
<script src="assets\vendor_components\jquery-toast-plugin-master\src\jquery.toast.js"></script>
<!-- dfsbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb -->


<script type="text/javascript">
function check_click()
{

  var Status = $('#btn_status').val();
  // alert(Status);
  if (Status=='closed') 
  {
    $('#btn_status').val('open');
    $('#fname').prop('disabled',false);
    $('#lname').prop('disabled',false);
    $('#email').prop('disabled',false);
    $('#mobile').prop('disabled',false);
    $('#male').prop('disabled',false); $('#female').prop('disabled',false);
    $('#dob').prop('disabled',false);
    $('#married').prop('disabled',false); $('#unmarried').prop('disabled',false);
    $('#ann_date').prop('disabled',false);
    $('#address').prop('disabled',false);

    $('#update_btn').css('display','none');
    $('#save_btn').css('display','block');

  }
  else if(Status=='open')
  {
    $('#btn_status').val('closed');
  }
}
</script>

<script type="text/javascript">
function pass_tab()
{

  var Pass_Status = $('#pass_status').val();
 // alert(Pass_Status);
  if (Pass_Status=='closed') 
  {

    $('#pass_status').val('open');
    $('#old_pass').prop('disabled',false);
    $('#new_pass').prop('disabled',false);
    $('#con_pass').prop('disabled',false);

    $('#update_pass').css('display','none');
    $('#save_pass').css('display','block');

  }
  else if(Pass_Status=='open')
  {
    $('#pass_status').val('closed');
  }
}
</script>
  

  <script type="text/javascript">
  $("input[name='m_status']:radio")
    .change(function() {
      $("#hide").toggle($(this).val() == "Married");
      $('#ann_date').val('');
});

    $(document).ready(function() {
    //$('#ann_date').datepicker().datepicker('setDate', '');
    });
</script>



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