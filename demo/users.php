<?php
    session_start();
    if (!isset($_SESSION['id']))
    {
        header('Location: index.php');
    }
  include "config.php";
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
  <link rel="stylesheet" href="assets/vendor_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="css/master_style.css">
  <link rel="stylesheet" href="css/skins/_all-skins.css"> 
  <link rel="stylesheet" href="css/jquery.datetimepicker.css">  
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
  <script src="js/sweetalert.js"></script>
  <link rel="stylesheet" href="css/sweetalert.css">
</head>
<body class="hold-transition skin-yellow-light sidebar-mini">
<div class="wrapper">
<?php include("header.php"); ?>
  
    <aside class="main-sidebar">
      <section class="sidebar">
        <?php include("menu.php"); ?>
      </section>
    </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="padding-top:0px;">
    <section class="content-header">
      <!-- <div class="row">
      <a href="home.php"> < Back </a>
    </div> -->
      <!--<h2>Users List</h2>-->
      <ol class="breadcrumb">
        <span class="pull-left"><li class="breadcrumb-item"><a href="home.php">< Back</a></li></span>

        <span class="pull-right">
        <li class="breadcrumb-item"><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
        <li class="breadcrumb-item active">Users</li>
      </span>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">










    <form action="">
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default" style="padding-top:0px; padding:0px;">
        <div class="box-header with-border">
         <!-- <h3 class="box-title" style="font-size:14px;">Search Remider Task</h3>-->

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">


            <div class="col-md-4">
              <div class="form-group">
                <label style="font-size:12px;">User Status</label>
                <select class="form-control select2" style="width: 100%;" name="user">
                  <option value="">Select</option>
                  <option value="A" <?php if(isset($_REQUEST['user']) && $_REQUEST['user']=='A'){echo 'selected'; }?> > Active</option>
                  <option value="D" <?php if(isset($_REQUEST['user']) && $_REQUEST['user']=='D'){echo 'selected'; }?> >Deactive</option>
                </select>
              </div>
            </div>
            


            <div class="col-md-3 text-left" style="margin-top: 30px;">
              <button class="btn btn-info" type="submit">Search</button>
              <a href="users.php" class="btn btn-warning">Reset</a>
              <a href="users.php" class="btn btn-danger">Cancel</a>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
      </form>










      <div class="row">


        <div class="col-lg-3 col-md-12 col-sm-3 col-xs-12">
          <div class="box">
            <div class="box-header">Contact Groups<hr></div>
            <!-- /.box-header -->
            <div class="box-body" style="min-height:10px; max-height: 260px; overflow-y:scroll;">
                <input type="hidden" id="hidden-val">
                <ul class="uu" style="list-style: circle;">
                  <li class="ll"><a onClick="group_contact('')" href="#" >All Contacts <span class="pull-right badge bg-yellow">
                    <?php
                      $sql1 = "SELECT COUNT(userid) as c FROM user WHERE utype!='A' AND userid!='".$_SESSION['id']."' AND user_varified='Yes'";
                      // echo $sql1;
                      $result1 = mysql_query($sql1,$conn);
                      $row1 = mysql_fetch_assoc($result1);
                      echo $row1['c'];
                    ?>
                  </span> </a></li>
                  <?php
                    $sql = "SELECT * FROM group_table WHERE created_by=".$_SESSION['id'];
                    $result = mysql_query($sql,$conn);
                    if (mysql_num_rows($result)>0) 
                    {
                        while($row = mysql_fetch_assoc($result))
                        { ?>
                          <li class="ll"><a id="ID<?=$row['gid']?>" onClick="group_contact('<?=$row['gid']?>')" <?php if (isset($_REQUEST['gid']) && $_REQUEST['gid']==$row['gid']) {echo "class='act' ";} ?> href="#"><?= $row['gname'] ?>  <span id="count_id<?=$row['gid']?>" class="pull-right badge bg-yellow">
                            <?php
                                $sql1 = "SELECT COUNT(userid) as c FROM group_contact WHERE gid=".$row['gid'];
                                // echo $sql1;
                                $result1 = mysql_query($sql1,$conn);
                                $row1 = mysql_fetch_assoc($result1);
                                echo $row1['c'];
                            ?>
                          </span></a></li>
                       <?php }
                    }
                    //else
                   // { ?>
                      <!-- <li><a href="">No Group Created</a></li> -->
                  <?php  //}
                  ?>
                </ul>
            </div>
          </div>
        </div>



        <div class="col-9">
         
         <div class="box">
            <div class="box-header">
              <button class="btn btn-default" data-toggle="modal" role="dialog" data-target="#add-new-events">Add New User</button>
            </div>
            <!-- /.box-header -->
            <div class="box-body" id="usersListDiv">
              
            </div>
          </div>
          </div>      
        </div>
    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->
  <footer class="main-footer">
    <?php include("footer.php"); ?>
  </footer>
  
  <div class="control-sidebar-bg"></div>
</div>
  <script src="assets/vendor_components/jquery/dist/jquery.min.js"></script>
  <script src="assets/vendor_components/popper/dist/popper.min.js"></script>
  <script src="assets/vendor_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="assets/vendor_components/select2/dist/js/select2.full.js"></script>
  <script src="js/pages/advanced-form-element.js"></script>
  <!-- <script src="assets/vendor_components/fastclick/lib/fastclick.js"></script> -->
  <script src="js/template.js"></script>
  <script src="js/demo.js"></script>
  <script src="assets/vendor_plugins/DataTables-1.10.15/media/js/jquery.dataTables.min.js"></script>
  <script src="js/pages/data-table.js"></script>
  <script type="text/javascript">
    $('.bs-example-modal-lg').on('show.bs.modal', function(e) 
    {
    var apply = $(e.relatedTarget).data('apply');
    $(e.currentTarget).find('input[name="apply"]').val(apply);
    
    });
  </script>
<!--   date time picker -->
  <script src="js/jquery.datetimepicker.full.min.js"></script>
  <script type="text/javascript">
    jQuery('#from_date').datetimepicker({
      startDate:'+1971/05/01',
      format:'d.m.Y H:i'
    });
    jQuery('#to_date').datetimepicker({
      startDate:'+1971/05/01',
      format:'d.m.Y H:i'
    });
  </script>
<!--   date time picker -->
<script type="text/javascript">
  $("input[name='r_type']:radio")
    .change(function() {
      $("#par").toggle($(this).val() == "Public");
});
</script>
<!-- view modal -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
  
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myLargeModalLabel">View User Profile</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal form-element col-12" action="">
          <?php
                $sql = "SELECT * FROM user WHERE userid = ".$_REQUEST['view'];
                $result = mysql_query($sql,$conn);
                $row = mysql_fetch_assoc($result);
                $fname = $row['ufname'];
                $lname = $row['ulname'];
                $email = $row['uemail'];
                $contact = $row['ucontact'];
                $dob = date('d-m-Y',strtotime($row['udob']));
                $ann_date =  date('d-m-Y',strtotime($row['Anniversary']));
                $gender = $row['ugender'];
                $m_status = $row['marital_status'];
            ?>
          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">First Name</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="inputName" placeholder="Not Available" name="fname" autocomplete="off" required disabled value="<?php echo $fname ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Last Name</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="inputName" placeholder="Not Available" name="fname" autocomplete="off" required disabled value="<?php echo $lname ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Contact</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="inputName" placeholder="Not Available" name="fname" autocomplete="off" required disabled value="<?php echo $contact ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Email</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="inputName" placeholder="Not Available" name="fname" autocomplete="off" required disabled value="<?php echo $email ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Gender</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="inputName" placeholder="Not Available" name="fname" autocomplete="off" required disabled value="<?php echo $gender ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">DOB </label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="inputName" placeholder="Not Available" name="fname" autocomplete="off" required disabled value="<?php echo $dob ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Marital Status</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="inputName" placeholder="Not Available" name="fname" autocomplete="off" required disabled value="<?php echo $m_status ?>">
            </div>
          </div>
          <?php
            if($m_status=="Married")
            { ?>
                <div class="form-group row">
                  <label for="inputName" class="col-sm-3 control-label">Anniversary</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="inputName" placeholder="Not Available" name="fname" autocomplete="off" required disabled value="<?php echo $ann_date ?>">
                  </div>
                </div>
           <?php }
          ?>
          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Varified</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="inputName" name="fname" placeholder="Not Available" autocomplete="off" required disabled value="<?php echo $row['user_varified']; ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Address</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="inputName" placeholder="Not Available" name="fname" autocomplete="off" required disabled value="<?php echo $row['address']; ?>">
            </div>
          </div>
        <!-- </form> -->
      </div> <!-- modal bode -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger waves-effect text-right" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- /. viewmodal -->
<!-- Update modal -->
<div class="modal fade bs-example-modal-lg1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myLargeModalLabel">Update User Profile</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal form-element col-12" action="update_user.php" method="post" onSubmit="ShowLoading()">
          <?php
                $sql = "SELECT * FROM user WHERE userid = ".$_REQUEST['update'];
                $result = mysql_query($sql,$conn);
                $row = mysql_fetch_assoc($result);
                $fname = $row['ufname'];
                $lname = $row['ulname'];
                $email = $row['uemail'];
                $contact = $row['ucontact'];
                $dob = date('d-m-Y',strtotime($row['udob']));
                $ann_date =  date('d-m-Y',strtotime($row['Anniversary']));
                $gender = $row['ugender'];
                $m_status = $row['marital_status'];
            ?>
            <input type="hidden" class="form-control" name="uid" value="<?php echo $_REQUEST['update']; ?>">
          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">First Name <span style="color: red">*</span></label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="inputName" placeholder="Enter first name" name="fname" autocomplete="off" required value="<?php echo $fname ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Last Name <span style="color: red">*</span></label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="inputName" placeholder="Enter first name" name="lname" autocomplete="off" required value="<?php echo $lname ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Contact<span style="color: red">*</span></label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="inputName" placeholder="Enter first name" name="contact" autocomplete="off" required value="<?php echo $contact ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Email<span style="color: red">*</span></label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="inputName" placeholder="Enter Email" name="email" autocomplete="off" required value="<?php echo $email ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Gender<span style="color: red">*</span></label>
            <div class="col-sm-9">
              <div class="radio" style="display: inline;">
                <input name="gender" type="radio" id="male" value="Male"
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
                <input name="gender" type="radio" id="female" value="Female"
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
          <?php
            if($m_status=="Married")
            { ?>
                <div class="form-group row">
                  <label for="inputName" class="col-sm-3 control-label">Anniversary <span style="color: red">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="inputName" placeholder="Enter Anniversary Date" name="ann_date" autocomplete="off" required value="<?php echo $ann_date ?>">
                  </div>
                </div>
           <?php }
          ?>
          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Varified</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="inputName" name="varified" autocomplete="off" required readonly value="<?php echo $row['user_varified']; ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Address <span style="color: red">*</span></label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="inputName" placeholder="Enter Address" name="address" autocomplete="off" required value="<?php echo $row['address']; ?>">
            </div>
          </div>
        <!-- </form> -->
      </div> <!-- modal bode -->
      <div class="modal-footer">
        <button class="btn btn-info">Update</button>
        <button type="button" class="btn btn-danger waves-effect text-right" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- /. Update modal -->
<a id="modal_view" data-toggle="modal" data-target=".bs-example-modal-lg" style="display: none;">dsvdsv</a>
  <?php
    if (isset($_REQUEST['view']) && $_REQUEST['view']!="") 
    { ?>
          <script type="text/javascript">
            document.getElementById('modal_view').click();
          </script>
   <?php }
  ?>
<a id="modal_update" data-toggle="modal" data-target=".bs-example-modal-lg1" style="display: none;">dsvdsv</a>
  <?php
    if (isset($_REQUEST['update']) && $_REQUEST['update']!="") 
    { ?>
          <script type="text/javascript">
            document.getElementById('modal_update').click();
          </script>
   <?php }
  ?>
</body>
</html>
<!-- Modal Add Category -->
<form action="add_user.php" method="post" onSubmit="ShowLoading()">
<div class="modal fade none-border" id="add-new-events">
 <div class="modal-dialog">
  <div class="modal-content">
   
   <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  <h4 class="modal-title"><strong>Add</strong> User</h4>
   </div>
   
   <div class="modal-body">
    <div class="form-group row">
          <label for="example-text-input" class="col-sm-4 col-form-label">First Name <label style="color: red">*</label></label>
          <div class="col-sm-8">
          <input class="form-control" type="text" placeholder="Enter first name" name="fname" autocomplete="off" required min="3">
          </div>
        </div>
        <div class="form-group row">
          <label for="example-search-input" class="col-sm-4 col-form-label">Last Name <label style="color: red">*</label></label>
          <div class="col-sm-8">
          <input class="form-control" type="search" placeholder="Enter last name" name="lname" autocomplete="off" required min="3">
          </div>
        </div>
        <div class="form-group row">
          <label for="example-search-input" class="col-sm-4 col-form-label">Email <label style="color: red">*</label></label>
          <div class="col-sm-8">
          <input class="form-control" type="email" placeholder="Enter email" name="email" id="e" autocomplete="off" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
          </div>
        </div>
        <div class="form-group row">
          <label for="example-search-input" class="col-sm-4 col-form-label">Mobile <label style="color: red">*</label></label>
          <div class="col-sm-8">
          <input class="form-control" type="number" placeholder="Enter mobile" name="mobile" id="m" autocomplete="off" required>
          </div>
        </div>
   </div>
   
   <div class="modal-footer">
    <hr>
  <button type="submit" class="btn btn-info waves-effect waves-light save-category">Save</button>
  <button type="Reset" class="btn btn-warning waves-effect waves-light save-category">Reset</button>
  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
   </div>
   
  </div>
 </div>
</div>
</form>
<!-- end of modal -->
   <!-- dfsbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb -->
<button class="tst3 btn btn-success" style="display: none;"></button>
<button class="tst4 btn btn-danger" style="display: none;"></button>
<?php
if (isset($_GET['add_user']) && $_GET['add_user'] == "success")
{ ?>
  <script type="text/javascript">
    $(document).ready(function () {
      $.toast({
          heading: 'User Added Successfully..!',
          position: 'top-right',
          loaderBg: '#ff6849',
          icon: 'success',
          hideAfter: 3500,
          stack: 6
      });
  });
  </script>
<?php }
else if(isset($_GET['add_user']) && $_GET['add_user'] == "fail")
{ ?>
    
  <script type="text/javascript">
   $(document).ready(function () {
        $.toast({
            heading: 'Error occured..!',
            text: 'Please try again later.',
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'error',
            hideAfter: 3500
        });
    });
  </script>
<?php  }
else if(isset($_GET['user_update']) && $_GET['user_update'] == "fail")
{ ?>
    
  <script type="text/javascript">
   $(document).ready(function () {
        $.toast({
            heading: 'Error occured..!',
            text: 'Please try again later.',
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'error',
            hideAfter: 3500
        });
    });
  </script>
<?php  }
else if (isset($_GET['user_update']) && $_GET['user_update'] == "success")
{ ?>
  <script type="text/javascript">
    $(document).ready(function () {
      $.toast({
          heading: 'User Updated Successfully..!',
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

<script type="text/javascript">
  function delete_user(userid)
  {
    swal({   
      title: "Are you sure?",   
      text: "You will not be able to recover this user back!",   
      type: "warning",   
      showCancelButton: true,   
      confirmButtonColor: "#DD6B55",   
      confirmButtonText: "Yes, delete it!",   
      closeOnConfirm: false 
  }, function(){
    $.post("getajax.php",{action:'delete_user_from_user_page',userid:userid}, function(data)
    {
      if (data=='success') 
      {
        swal("Deleted!", "User has been deleted Successfully", "success");
        setTimeout(function(){ window.location='users.php'; }, 3000);
      }
    }); 
  });
  }  
</script>

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



    function group_contact(gid)
    {
     
      $.post("getajax.php",{action:'showGroupPeople',gid:gid}, function(data){
        $("#ajax").html('');
        $("#usersListDiv").html(data);


        $("#ID"+gid).addClass('act');
        
        
      });

      $.post("getajax.php",{action:'dropdown_data',gid:gid}, function(data){
        $("#dropdown_data").html(data);
      });

      $.post("getajax.php",{action:'group_name',gid:gid}, function(data){
        $("#group_name").val(data);
      });


    }
    group_contact('');
</script>
