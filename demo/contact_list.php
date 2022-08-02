<?php include('common_function.php'); ?>
<?php
    session_start();
    if (!isset($_SESSION['id']))
    {
        header('Location: index.php');
    }
  include "config.php";
  $uu = $_SESSION['id'];
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

  <style type="text/css">
  #return-to-top {
    position: fixed;
    bottom: 63px;
    right: 20px;
    background: #ffbf36;
    background: #ffbf36;
    width: 50px;
    height: 50px;
    display: block;
    text-decoration: none;
    -webkit-border-radius: 35px;
    -moz-border-radius: 35px;
    border-radius: 35px;
    -webkit-transition: all 0.3s linear;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease;
}
#return-to-top i {
    color: #fff;
    margin: 0;
    position: relative;
    left: 0px;
    top: 9px;
    font-size: 19px;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease;
}
#return-to-top:hover {
    background: #ffbf36;
}
#return-to-top:hover i {
    color: #fff;
    /*top: 5px;*/
    -webkit-transform: rotate(360000deg);
  -ms-transform: rotate(360000deg);
  transform: rotate(360000deg);
}
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
    color: #fff;
    border: 1px solid #ffbf36;
    background-color: #ffbf36;
}

.uu
{
    list-style: none;
}
ul.uu li{
    display: block;
    position: relative;
    text-align: left;
}
ul.uu li a{
    display: block;
    padding: 8px 25px;
    text-decoration: none;
    margin-left: -50px;
}
ul.uu li a:hover{
    color: #aaa;
    background: #e8e8e8;
}
.act
{
  color: #ffbf36;
    background: #e8e8e8;
}
</style>

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
  <div class="content-wrapper">
    <section class="content-header">
      <!-- <div class="row">
      <a href="home.php"> < Back </a>
    </div> -->
      <h4>Contact List</h4>
      <ol class="breadcrumb">
        <span class="pull-left"><li class="breadcrumb-item"><a href="home.php">< Back</a></li></span>
&nbsp;
        <span class="pull-right">
        <li class="breadcrumb-item"><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
        <li class="breadcrumb-item active">Contact</li>
      </span>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">


      <form action="" style="display: none;">
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Search Contact here</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">

            <div class="col-md-3">
              <div class="form-group">
                <label>From Date</label>
                <input class="form-control" name="from_date" id="from_date" autocomplete="off" placeholder="Enter From Date" value="<?php if(isset($_REQUEST['from_date']) && $_REQUEST['from_date'] !=''){echo date("d-m-Y",strtotime($_REQUEST['from_date']));} ?>">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label>To Date</label>
                <input class="form-control" name="to_date" id="to_date" autocomplete="off" placeholder="Enter To Date" value="<?php if(isset($_REQUEST['to_date']) && $_REQUEST['to_date']!=''){echo date("d-m-Y",strtotime($_REQUEST['to_date']));}?>">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label>Priority</label>
                <select class="form-control select2" style="width: 100%;" name="priority">
                  <option value="">Select</option>
                  <option value="Low" <?php if(isset($_REQUEST['priority']) && $_REQUEST['priority']=='Low'){echo 'selected'; }?> > Low</option>
                  <option value="KMedium" <?php if(isset($_REQUEST['priority']) && $_REQUEST['priority']=='KMedium'){echo 'selected'; }?> >Medium</option>
                  <option value="High" <?php if(isset($_REQUEST['priority']) && $_REQUEST['priority']=='High'){echo 'selected'; }?> >High</option>
                </select>
              </div>
            </div>


            <?php if ($_SESSION['utype']=="A") 
            { ?>
              <div class="col-md-3">
              <div class="form-group">
                <label>Participants</label>
                <select class="form-control select2" style="width: 100%;" name="par">
                  <option value="">Select</option>
                  <?php
                      $sql = "SELECT * FROM user WHERE user_varified='Yes' ";
                      $result = mysql_query($sql,$conn);
                      while($row = mysql_fetch_assoc($result))
                      {
                        if ( ($_REQUEST['par']) && $_REQUEST['par']==$row['userid'] )
                        {
                            echo "<option value='".$row['userid']."' selected>".$row['ufname']." ".$row['ulname']."</option>";
                        }
                        else
                        {
                            echo "<option value='".$row['userid']."'>".$row['ufname']." ".$row['ulname']."</option>";
                        }
                      }
                  ?>
                </select>
              </div>
            </div>
           <?php } ?>
            



            <div class="col-md-12 text-right">
              <button class="btn btn-info" type="submit">Search</button>
              <a href="reports.php" class="btn btn-warning">Reset</a>
              <a href="reports.php" class="btn btn-danger">Cancel</a>
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
                  <li class="ll"><a href="contact_list.php">All Contacts <span class="pull-right badge bg-yellow">
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

        <script type="text/javascript">
          function refresh_count(gid)
          {
            $.post("getajax.php",{action:'refresh_count',gid:gid}, function(data){
             //alert(data);
             $('#count_id'+gid).html(data);
             $("#ID"+gid).addClass('act');

            });
          }

          function send_request(userid)
          {
            $.post("getajax.php",{action:'send_request',request_to:userid}, function(data){
             $('#userid'+userid).html(data);
            });
          }

          function cancel_request(userid)
          {
            $.post("getajax.php",{action:'cancel_request',request_to:userid}, function(data){
             $('#userid'+userid).html(data);
            });
          }
        </script>



        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
         <div class="box">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <a data-toggle="modal" data-target="#edit_group" id="add" href="#" class="btn btn-default" style="display: none;"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Group</a>
              <a onClick="delete_contact_group($('#group_id_value').val())" id="delete" href="#" class="btn btn-default" style="display: none;"><i class="fa fa-trash" aria-hidden="true"></i> Delete Group</a>
              <div id="ajax">
              <table id="example1" class="table table-bordered table-striped table-responsive table-condensed" cellpadding="1">
                <thead>
          <tr style="background-color: #e2dede">
            <th><b>Call</b></th>
            <th><b>Name</b></th>
            <th><b>Number</b></th>
            <th width="1%"></th>
          </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_REQUEST['gid']) && $_REQUEST['gid']!="") 
            {
              $gid = $_REQUEST['gid'];
              $sql = "SELECT * FROM group_contact gc INNER JOIN user u ON gc.userid=u.userid WHERE u.utype!='A' AND u.user_varified='Yes' AND gc.gid='$gid' ";
            }
            else
            {
                $sql = "SELECT * FROM user WHERE utype!='A' AND user_varified='Yes' AND userid!='".$_SESSION['id']."' ";
            }
              
              $result = mysql_query($sql,$conn);
              while($row = mysql_fetch_assoc($result))
              { ?>
                <tr style="padding:0px;">
                <td>
                  <?php
                       $sql = "SELECT * FROM contact_request WHERE (request_by='".$_SESSION['id']."' AND request_to='".$row['userid']."') OR (request_by='".$row['userid']."' AND request_to='".$_SESSION['id']."') ";
                      $rr = mysql_query($sql, $conn);
                      $cr = mysql_fetch_assoc($rr);
                      if ($cr['request_approve']==1 || get_user_type($_SESSION['id'])=='A' ) 
                      { ?>
                         <a href="tel:<?= $row['ucontact'] ?>"><i class="fa fa-phone" aria-hidden="true"></i> Call</a>
                    <?php  }
                      else
                      { ?>
                         <a href="#"><i class="fa fa-phone" aria-hidden="true"></i> Unavailable</a>
                    <?php  }
                    ?>
                 
                </td>
                <td><?= $row['ufname'] ?> <?= $row['ulname'] ?></td>
                <td id="userid<?=$row['userid']?>">
                    <?php
                      $sql = "SELECT * FROM contact_request WHERE (request_by='".$_SESSION['id']."' AND request_to='".$row['userid']."') OR (request_by='".$row['userid']."' AND request_to='".$_SESSION['id']."') ";
                      $rr = mysql_query($sql, $conn);
                      $cr = mysql_fetch_assoc($rr);
                      if ($cr['request_approve']==1 || get_user_type($_SESSION['id'])=='A') 
                      {
                        echo $row['ucontact'];
                      }
                      else if($cr['request_sent']==1 && $cr['request_approve']==0 && $cr['request_by']==$_SESSION['id'] && $cr['request_to']==$row['userid'])
                      {
                        ?><button class='btn btn-warning' style="height:25px;" onClick="cancel_request(<?=$row['userid']?>)">Cancel Request</button><?php
                      } 
                      else
                      {
                         ?><button class='btn btn-primary' style="height:25px;" onClick="send_request(<?=$row['userid']?>)">Send Request</button><?php
                      }

                    ?>


                  </td>
                <td ></td>
                </tr>
             <?php }

            ?>
          
        </tbody>
              </table>
              </div>
            </div>
          </div>
          </div>      
        </div>
    </section>
    <!-- /.content -->


<!-- Return to Top -->
<a href="" title="Add Group" data-toggle="modal" data-target="#add-new-events" id="return-to-top" class="btn btn-warning"><i class="fa fa-plus" ></i></a>


<!-- Modal -->
  <!-- Modal Add Category -->
<form action="save_group.php" method="post" onSubmit="ShowLoading()">
<div class="modal fade none-border" id="add-new-events">
 <div class="modal-dialog">
  <div class="modal-content">
   
   <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  <h4 class="modal-title"><strong>New</strong> Group</h4>
   </div>
   
   <div class="modal-body">

    <div class="form-group row">
          <label for="example-text-input" class="col-sm-4 col-form-label"> Group Name <label style="color: red">*</label></label>
          <div class="col-sm-8">
          <input class="form-control" type="text" placeholder="Enter group name" id="group" name="group" autocomplete="off" required>
          </div>
        </div>

        <div class="form-group row" id="par">
          <label for="example-tel-input" class="col-sm-4 col-form-label">Add Participants <label style="color: red">*</label></label>
          <div class="col-sm-8">
            <select class="form-control select2" multiple="multiple" data-placeholder="Choose Users" style="width: 100%" name="par[]">
            <?php
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
                while ($rss = mysql_fetch_assoc($result)) 
                {
                  
                  if(get_user_type($_SESSION['id'])=='A')
                  {
                      $uid = $rss['userid'];
                      $fname = $rss['ufname']; 
                      $lname = $rss['ulname']; 
                      echo '<option value="'.$uid.'">'."&nbsp;&nbsp;".$fname.' '.$lname.'</option>';
                  }
                  else
                  {
                      if ($rss['request_by']==$_SESSION['id']) 
                      {
                        echo '<option value="'.$rss['request_to'].'">'."&nbsp;&nbsp;".get_name($rss['request_to']).'</option>';
                      }
                      else
                      {
                          echo '<option value="'.$rss['request_by'].'">'."&nbsp;&nbsp;".get_name($rss['request_by']).'</option>';
                      }
                  }
                  
                }
              }
            ?>
            </select>
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
<!-- modal -->


<!-- Modal -->
  <!-- Modal Add Category -->
<form action="add_participants_to_group.php" method="post" onSubmit="ShowLoading()">

  <input type="hidden" id="group_id_value" name="group_id_value">

<div class="modal fade none-border" id="edit_group">
 <div class="modal-dialog">
  <div class="modal-content">
   
   <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  <h4 class="modal-title"><strong>Edit</strong> group</h4>
   </div>
   
   <div class="modal-body">

    <div class="form-group row">
          <label for="example-text-input" class="col-sm-4 col-form-label">Rename Group</label>
          <div class="col-sm-8">
          <input class="form-control" type="text" placeholder="Enter group name" id="group_name" name="group" autocomplete="off">
          </div>
        </div>

        <div class="form-group row" id="par">
          <label for="example-tel-input" class="col-sm-4 col-form-label">Add New Participants <label style="color: red">*</label></label>
          <div class="col-sm-8">
            <select id="dropdown_data" class="form-control select2" multiple="multiple" data-placeholder="Choose Users" style="width: 100%" name="par[]">
            </select>
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
<!-- modal -->


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
  <-- <script src="js/demo.js"></script> -->
  <script src="assets/vendor_plugins/DataTables-1.10.15/media/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript">
    $(function () {
    "use strict";
    $('#example1').DataTable({
      dom: 'Bfrtip',
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      buttons: [
      'copy', 'csv', 'excel', 'pdf', 'print'
    ]
    });
  }); // End of use strict
  </script>
  <script type="text/javascript">
    $(function () {
    "use strict";
    $('#example11').DataTable({
      dom: 'Bfrtip',
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      buttons: [
      'copy', 'csv', 'excel', 'pdf', 'print'
    ]
    });
  }); // End of use strict
  </script>



  <script type="text/javascript">
  function change_status(rem_id,uid,status)
  {
    $.post("getajax.php",{action:'change_status',rem_id:rem_id,uid:uid,status:status}, function(data){
    // $("#SpanCalendar").html(data);
    alert(data);
     });
  }
</script>


</body>
</html>


   <!-- dfsbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb -->
<button class="tst3 btn btn-success" style="display: none;"></button>
<button class="tst4 btn btn-danger" style="display: none;"></button>

<?php
if (isset($_GET['contact']) && $_GET['contact'] == "success")
{ ?>

  <script type="text/javascript">

    $(document).ready(function () {
      $.toast({
          heading: 'Group Added Successfully',
          position: 'top-right',
          loaderBg: '#ff6849',
          icon: 'success',
          hideAfter: 3500,
          stack: 6
      });

  });
  </script>

<?php }
else if(isset($_GET['contact']) && $_GET['contact'] == "fail")
{ ?>
    
  <script type="text/javascript">
   $(document).ready(function () {
        $.toast({
            heading: 'Unexpected Error..!',
            text: 'Please try again later',
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'error',
            hideAfter: 3500

        });

    });
  </script>
<?php  }

else if(isset($_GET['rem_delete']) && $_GET['rem_delete'] == "fail")
{ ?>
    
  <script type="text/javascript">
   $(document).ready(function () {
        $.toast({
            heading: 'Reminder discarded fail',
            text: 'Please try again later',
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'error',
            hideAfter: 3500

        });

    });
  </script>
<?php  }


else if (isset($_GET['rem_delete']) && $_GET['rem_delete'] == "success")
{ ?>

  <script type="text/javascript">

    $(document).ready(function () {
      $.toast({
          heading: 'Reminder Discarded Successfully',
          position: 'top-right',
          loaderBg: '#ff6849',
          icon: 'success',
          hideAfter: 3500,
          stack: 6
      });

  });
  </script>

<?php }

else if (isset($_GET['update_contact']) && $_GET['update_contact'] == "success")
{ ?>

  <script type="text/javascript">

    $(document).ready(function () {
      $.toast({
          heading: 'Contacts Updated Successfully',
          position: 'top-right',
          loaderBg: '#ff6849',
          icon: 'success',
          hideAfter: 3500,
          stack: 6
      });

  });
  </script>

<?php }


else if(isset($_GET['update_contact']) && $_GET['update_contact'] == "fail")
{ ?>
    
  <script type="text/javascript">
   $(document).ready(function () {
        $.toast({
            heading: 'Unexpected Error..!',
            text: 'Please try again later',
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'error',
            hideAfter: 3500

        });

    });
  </script>
<?php  }


else if (isset($_GET['user_delete']) && $_GET['user_delete'] == "success")
{ ?>

  <script type="text/javascript">

    $(document).ready(function () {
      $.toast({
          heading: 'Participant Deleted Successfully',
          position: 'top-right',
          loaderBg: '#ff6849',
          icon: 'success',
          hideAfter: 3500,
          stack: 6
      });

  });
  </script>

<?php }


else if(isset($_GET['user_delete']) && $_GET['user_delete'] == "fail")
{ ?>
    
  <script type="text/javascript">
   $(document).ready(function () {
        $.toast({
            heading: 'Unexpected Error..!',
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
<link rel="stylesheet" type="text/css" href="assets\vendor_components\jquery-toast-plugin-master\src\jquery.toast.css">
<script src="assets\vendor_components\jquery-toast-plugin-master\src\jquery.toast.js"></script>
<!-- dfsbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb -->

<script type="text/javascript" language="javascript">
function group_contact(gid)
{
 
  $.post("getajax.php",{action:'contact_list',gid:gid}, function(data){
    $("#ajax").html('');
    $("#ajax").html(data);
    $("#ID"+gid).addClass('act');
    
    var a = $("#hidden-val").val();
    $("#ID"+a).removeClass('act');
    $("#hidden-val").val(gid);

    $("#group_id_value").val(gid);
    var q = $("#group_id_value").val();

    if(q){
      $("#add").css("display", "inline-block");
      $("#delete").css("display", "inline-block");
      $("#act_id").css("display", "block");
    }
  });

  $.post("getajax.php",{action:'dropdown_data',gid:gid}, function(data){
    $("#dropdown_data").html(data);
  });

  $.post("getajax.php",{action:'group_name',gid:gid}, function(data){
    $("#group_name").val(data);
  });


}


function delete_contact_group(gid)
{
  swal({   
      title: "Are you sure?",   
      text: "You will not be able to recover this group back!",   
      type: "warning",   
      showCancelButton: true,   
      confirmButtonColor: "#DD6B55",   
      confirmButtonText: "Yes, delete it!",   
      closeOnConfirm: false 
  }, function(){  
    $.post("getajax.php",{action:'delete_group',gid:gid}, function(data)
    {
      swal("Deleted!", "Group has been deleted Successfully", "success");
      setTimeout(function(){location.reload()}, 2000);
    }); 
       
  });
}
</script>


<script type="text/javascript">
  function delete_contact(gid, userid)
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
      $.post("getajax.php",{action:'delete_user_from_contact',gid:gid, userid:userid}, function(data)
      {
        swal("Deleted!", "User has been deleted Successfully", "success");
      }); 
      setTimeout(refresh_count(gid), 500);
        setTimeout(group_contact(gid), 2000);
         
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
</script>


<?php
 // function get_name1($userid)
 //  {
 //    $sql = "SELECT * FROM user WHERE userid='".$userid."' ";
 //    $result = mysql_query($sql);
 //    $rr = mysql_fetch_assoc($result);
 //    return $rr['ufname'];
 //  }
