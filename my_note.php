<?php
    session_start();
    if (!isset($_SESSION['id']))
    {
        header('Location: index.php');
    }
  include "config.php";
  $uu = $_SESSION['id'];
?>
<?php
  if(isset($_POST['submit'])) 
  {
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $uid = $_SESSION['id'];
    $at = date('Y-m-d h:i:s');
    $mynote = "INSERT INTO my_note(title, des, created_by, created_at) VALUES ('$title', '$desc', '$uid', '$at')";
    $mynote_result = mysql_query($mynote, $conn);
    if ($mynote_result) 
    {
      header('Location: my_note.php?note=success');
    }
    else
    {
      header('Location: my_note.php?note=fail');
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
  <div class="content-wrapper">
    <section class="content-header">
      <!-- <div class="row">
      <a href="home.php"> < Back </a>
    </div> -->
      <!--<h2>Task List</h2>-->
      <ol class="breadcrumb">
        <span class="pull-left"><li class="breadcrumb-item"><a href="home.php">< Back</a></li></span>

        <span class="pull-right">
        <li class="breadcrumb-item"><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
        <li class="breadcrumb-item active">My Note</li>
      </span>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">


      <form name="reminder" action="my_note.php" method="post" onSubmit="ShowLoading()">
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <!--<h3 class="box-title">Add Notes Here</h3>-->

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <!-- <div class="row"> -->

            <div class="form-group row">
          <label for="example-text-input" class="col-sm-2 col-form-label">Notes: Title <label style="color: red">*</label></label>
          <div class="col-sm-10">
          <input class="form-control" type="text" placeholder="Enter Title" id="title" name="title" autocomplete="off" required>
          </div>
        </div>

        <div class="form-group row">
          <label for="example-search-input" class="col-sm-2 col-form-label">Description <label style="color: red">*</label></label>
          <div class="col-sm-10">
          <textarea rows="4" class="form-control" type="search" placeholder="Enter Description" id="desc" name="desc" autocomplete="off" required=""></textarea>
          </div>
        </div>

            <div class="col-md-12 text-right">
              <button type="submit" class="btn btn-primary" name="submit">Submit</button>
              <button type="Reset" class="btn btn-warning"><a href="">Reset</a></button>
              <button type="button" class="btn btn-danger"><a href="home.php">Cancel</a></button>

            </div>
            <!-- /.col -->
          <!-- </div> -->
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
      </form>

      <div class="row">
        <div class="col-12">
         <div class="box">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped table-responsive table-condensed" cellpadding="0" cellspacing="0">
                <thead>
          <tr style="background-color: #e2dede">
            <th style='text-align:center;font-size:12px;'><b>Action</b></th>
            <th style='text-align:center;font-size:12px;'><b>Title</b></th>
            <th style='text-align:center;font-size:12px;'><b>Description</b></th>
            <th style='text-align:center;font-size:12px;'><b>Created By</b></th>
            <th style='text-align:center;font-size:12px;'><b>Created At</b></th>
          </tr>
        </thead>
        <tbody>
          <?php
            $sql = "SELECT * FROM my_note INNER JOIN user ON my_note.created_by=user.userid  WHERE my_note.created_by=".$_SESSION['id']." ORDER BY my_note.id DESC";
            $result = mysql_query($sql,$conn);
            while($row = mysql_fetch_assoc($result))
            { ?>
                <tr>
                  <td style='text-align:center;font-size:12px;'>
                    <a href="my_note.php?noteid=<?= $row['id'] ?>">View</a> |
                    <a href="#" onClick="delete_note(<?=$row['id']?>)">Discard</a>
                  </td>
                  <td style='font-size:12px;'><?= $row['title'] ?></td>
                  <td style='font-size:12px;'><?= $row['des'] ?></td>
                  <td style='font-size:12px;'><?php echo $row['ufname']." ".$row['ulname']; ?></td>
                  <td style='font-size:12px;'><?= $row['created_at'] ?></td>
                </tr>
           <?php }

          ?>

        </tbody>
        <tfoot>
          <tr style="background-color: #e2dede">
            <th><b>Action</b></th>
            <th><b>Title</b></th>
            <th><b>Description</b></th>
            <th><b>Created By</b></th>
            <th><b>Created At</b></th>
          </tr>
        </tfoot>
              </table>
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
  function change_status(rem_id,uid,status)
  {
    $.post("getajax.php",{action:'change_status',rem_id:rem_id,uid:uid,status:status}, function(data){
    // $("#SpanCalendar").html(data);
    alert(data);
     });
  }
</script>



  <!--   date time picker -->
  <script src="js/jquery.datetimepicker.full.min.js"></script>
  <script type="text/javascript">
    jQuery('#from_date').datetimepicker({
      startDate:'+1971/05/01',
      format:'d.m.Y'
    });

    jQuery('#to_date').datetimepicker({
      startDate:'+1971/05/01',
      format:'d.m.Y'
    });
  </script>
<!--   date time picker -->

</body>
</html>

<!-- view modal view modal view modal view modal view modal view modal view modal view modal -->

<div class="modal fade bs-example-modal-lg none-border" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myLargeModalLabel">Task Calendar</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal form-element col-12" action="update_reminder.php" method="post" onSubmit="ShowLoading()">

          <?php
                $sql = "SELECT * FROM my_note WHERE id = ".$_REQUEST['noteid'];
                $result = mysql_query($sql,$conn);
                $row = mysql_fetch_assoc($result);
                $title = $row['title'];
                $des = $row['des'];
            ?>

          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Title</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" disabled value="<?= $title ?>">
            </div>
          </div>

          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Description</label>
            <div class="col-sm-9">
              <textarea  rows="3" class="form-control" name="description" disabled=""><?= $des ?></textarea>
            </div>
          </div>

      </div> <!-- modal bode -->
      <div class="modal-footer">
        <hr>
        <button type="button" class="btn btn-danger waves-effect text-right" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- /. viewmodal -->

<!-- view event modal -->
<a id="modal_view" data-toggle="modal" data-target=".bs-example-modal-lg" style="display: none;">dsvdsv</a>
  <?php
    if (isset($_REQUEST['id'])) 
    { ?>
          <script type="text/javascript">
            document.getElementById('modal_view').click();
          </script>
   <?php }
  ?>




  <!-- dfsbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb -->
<button class="tst3 btn btn-success" style="display: none;"></button>
<button class="tst4 btn btn-danger" style="display: none;"></button>

<?php
if(isset($_GET['note']) && $_GET['note'] == "fail")
{ ?>
    
  <script type="text/javascript">
   $(document).ready(function () {
        $.toast({
            heading: 'Unexpected error..!',
            text: 'Please try again later',
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'error',
            hideAfter: 3500

        });

    });
  </script>

<?php  }
if (isset($_GET['note']) && $_GET['note'] == "success")
{ ?>

  <script type="text/javascript">

    $(document).ready(function () {
      $.toast({
          heading: 'Note has been added successfully',
          position: 'top-right',
          loaderBg: '#ff6849',
          icon: 'success',
          hideAfter: 3500,
          stack: 6
      });

  });
  </script>
<?php } ?>



<?php 
if (isset($_GET['note_delete']) && $_GET['note_delete'] == "success")
{ ?>

  <script type="text/javascript">

    $(document).ready(function () {
      $.toast({
          heading: 'Note has been discarded',
          position: 'top-right',
          loaderBg: '#ff6849',
          icon: 'success',
          hideAfter: 3500,
          stack: 6
      });

  });
  </script>
<?php } ?>



<?php
if(isset($_GET['note_delete']) && $_GET['note_delete'] == "fail")
{ ?>
    
  <script type="text/javascript">
   $(document).ready(function () {
        $.toast({
            heading: 'Unexpected error..!',
            text: 'Please try again later',
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'error',
            hideAfter: 3500

        });

    });
  </script>

<?php  } ?>



















<link rel="stylesheet" type="text/css" href="assets\vendor_components\jquery-toast-plugin-master\src\jquery.toast.css">
<script src="assets\vendor_components\jquery-toast-plugin-master\src\jquery.toast.js"></script>
<!-- dfsbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb -->

 <!-- checking the status of reminder in reminder table -->
<?php
  $qq = "SELECT * FROM reminder r INNER JOIN reminder_participants rp ON r.rem_id=rp.rem_id";
  $rrqq = mysql_query($qq,$conn);
  while($row = mysql_fetch_assoc($rrqq))
  {
    if ($row['status']==1) 
    {
        $up="UPDATE reminder SET Status='Done' WHERE rem_id=".$row['rem_id'];
        $g = mysql_query($up,$conn);
    }
    else
    {
        $up="UPDATE reminder SET Status='Pending' WHERE rem_id=".$row['rem_id'];
        $g = mysql_query($up,$conn);
    }
  }
  ?>
 <!-- checking the status of reminder in reminder table -->



<!--  view my notes | view my notes | view my notes | view my notes | view my notes | view my notes -->



<div class="modal fade bs-example-modal-lg none-border" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myLargeModalLabel">Task Calendar</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal form-element col-12" action="update_reminder.php" method="post" onSubmit="ShowLoading()">

          <?php
                $sql = "SELECT * FROM reminder WHERE rem_id = ".$_REQUEST['id'];
                $result = mysql_query($sql,$conn);
                $row = mysql_fetch_assoc($result);
                $type = $row['type'];
                $title = $row['title'];
                $description = $row['description'];
                $priority = $row['priority'];
                $from_date = date('d-m-Y H:i',strtotime($row['from_date']));
                $to_date =  date('d-m-Y H:i',strtotime($row['to_date']));
                $Status = $row['Status'];
                $created_by = $row['created_by'];
                $rem_req = $row['rem_req'];
                $period = $row['period'];
                $start_date = date('d-m-Y H:i',strtotime($row['start_date']));
            ?>

          <input type="hidden" name="rem_id" value="<?=$_REQUEST['id']?>">
          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Type</label>
            <div class="col-sm-9">
              <input type="text" class="form-control disabled" disabled readonly value="<?php echo $type; ?>">
            </div>
          </div>

          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Title</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" disabled value="<?php echo $title; ?>">
            </div>
          </div>

          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">description</label>
            <div class="col-sm-9">
              
              <?php
                if ($Status=='Pending' && $created_by==$uu) 
                { ?>
                  <input type="text" class="form-control" name="description" value="<?php echo $description; ?>">
               <?php }
                else
                { ?>
                    <input type="text" class="form-control" disabled value="<?php echo $description; ?>">
               <?php }
              ?>

            </div>
          </div>

          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Priority</label>
            <div class="col-sm-9">
              <?php
                if ($Status=='Pending' && $created_by==$uu)
                { ?>
                  <select class="form-control" name="priority">
                    <option value="Low" <?php if($priority=="Low"){echo "selected";} ?>>Low</option>
                    <option value="KMedium" <?php if($priority=="KMedium"){echo "selected";} ?>>Medium</option>
                    <option value="High" <?php if($priority=="High"){echo "selected";} ?>>High</option>
                  </select>
               <?php }
               else
               { ?>
                  <select class="form-control" name="priority" disabled>
                    <option value="Low" <?php if($priority=="Low"){echo "selected";} ?>>Low</option>
                    <option value="KMedium" <?php if($priority=="KMedium"){echo "selected";} ?>>Medium</option>
                    <option value="High" <?php if($priority=="High"){echo "selected";} ?>>High</option>
                  </select>
              <?php } 
              ?>
              
            </div>
          </div>

          <input type="hidden" class="form-control" name="hidden_from_date" value="<?php echo $from_date  ?>">

          <input type="hidden" class="form-control" name="page_name" value="reports">

          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">From Date </label>
            <div class="col-sm-9">
              
              <?php
                if ($Status=='Pending' && $created_by==$uu && $from_date>=date('d-m-Y') ) 
                { ?>
                  <input type="text" class="form-control" name="f_date" id="f_date" value="<?php echo $from_date  ?>">
               <?php }
                else
                { ?>
                    <input type="text" class="form-control" disabled value="<?php echo $from_date  ?>">
               <?php }
              ?>

            </div>
          </div>

          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">To Date</label>
            <div class="col-sm-9">
              
              <?php
                if ($Status=='Pending' && $created_by==$uu && $to_date>=date('d-m-Y')) 
                { ?>
                  <input onChange="picker()" type="text" class="form-control disabled" name="t_date" id="t_date" value="<?php echo $to_date  ?>">
               <?php }
                else
                { ?>
                    <input type="text" class="form-control" disabled value="<?php echo $to_date  ?>">
               <?php }
              ?>
            </div>
          </div>



          <button style="display: none;" class="btn btn-primary sweet-1" onClick="_gaq.push(['_trackEvent', 'example', 'try', 'sweet-1']);">Try It</button>
        <script type="text/javascript">
          function picker()
          {
              var date_ini = $('#f_date').val();
              var date_end = $('#t_date').val();
              if (date_ini > date_end) 
              {
                  swal({
                    title: "Warning..!",
                    text: "Invalid To Date! Please select To date greater than From Date",
                    type: "warning"
                  });
                  $('#t_date').val('');
                  return false;
              }

          }
          function picker2()
          {
              var date_ini = $('#f_date').val();
              var start_date = $('#start_date').val();
              if (date_ini <= start_date) 
              {
                  swal({
                    title: "Warning..!",
                    text: "Invalid Start Date! Please select Start Date Less than From Date",
                    type: "warning"
                  });
                  $('#start_date').val('');
                  return false;
              }
          }
        </script>


          <?php
                if ($Status=='Pending' && $created_by==$uu && $rem_req==1 && $start_date>=date('d-m-Y')) 
                { ?>
                  <div class="form-group row">
                    <label for="inputName" class="col-sm-3 control-label">Start Date </label>
                    <div class="col-sm-9">
                      <input onChange="picker2()" type="text" class="form-control" name="start_date" id="start_date" value="<?php echo $start_date  ?>">
                    </div>
                  </div>
               <?php }
          ?>

          <?php
                if ($Status=='Pending' && $created_by==$uu && $rem_req==1 && $from_date>=date('d-m-Y')) 
                { ?>
                  <div class="form-group row">
                    <label for="inputName" class="col-sm-3 control-label">Time Periods </label>
                    <div class="col-sm-9">
                      <select class="form-control select2" style="width: 100%;" name="period">
                        <option value="">Select</option>
                        <option value="24" <?php if($period==24){echo "selected";} ?> >Onces a day</option>
                        <option value="12" <?php if($period==12){echo "selected";} ?> >Twice a Day</option>
                      </select>
                    </div>
                  </div>
               <?php }
          ?>


          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Overall Status</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" disabled value="<?php echo $Status ;  ?>">

            </div>
          </div>

          <?php
                $sql = "SELECT * FROM reminder_participants WHERE  userid=".$_SESSION['id']." AND rem_id = ".$_REQUEST['id'];
                $result = mysql_query($sql,$conn);
                if (mysql_num_rows($result)>0) 
                {
                  $row = mysql_fetch_assoc($result);
                  $status = $row['status']; ?>
                  
                  <div class="form-group row">
                    <label for="inputName" class="col-sm-3 control-label">My Status</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="my_status" onChange="change_status('<?php echo $_REQUEST['id']; ?>', '<?php echo $_SESSION['id']; ?>', this.value)">
                        <option value="Done" <?php if($status=='1'){echo "selected";} ?> ><b>Done</b></option>
                        <option value="Pending" <?php if($status==0){echo "selected";} ?>><b>Pending</b></option>
                      </select>
                    </div>
                  </div>
              <?php  }
            ?>

          

          <?php
            $sql = "SELECT * FROM user WHERE userid = ".$created_by;
            $result = mysql_query($sql,$conn);
            $row = mysql_fetch_assoc($result);
            $fname = $row['ufname'];
            $lname = $row['ulname'];
          ?>

          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Created By </label>
            <div class="col-sm-9">
              <input type="text" class="form-control" disabled value="<?= $fname." ".$lname; ?>">
            </div>
          </div>

          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Participants </label>
            <div class="col-sm-9">
              <select class="form-control select2" multiple="multiple" data-placeholder="Choose" style="width: 100%" name="" disabled="disabled">
            <?php
              $sql = "SELECT * FROM reminder_participants rp INNER JOIN reminder r ON rp.rem_id = r.rem_id INNER JOIN user u ON rp.userid = u.userid WHERE r.rem_id =".$_REQUEST['id'];
              echo $sql;
              $result = mysql_query($sql,$conn);
              if (mysql_num_rows($result) > 0)
              {
                while ($row = mysql_fetch_assoc($result)) 
                {
                  $fname = $row['ufname']; 
                  $lname = $row['ulname']; 
                  echo '<option selected>'."&nbsp;&nbsp;".$fname.' '.$lname.'</option>';
                }
              }
            ?>
            </select>
            </div>
          </div>


          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Tasks</label>
            <div class="col-sm-9">
              <select class="form-control select2" multiple="multiple" data-placeholder="Choose Tasks" style="width: 100%" name="" disabled="disabled">
            <?php
              $sql = "SELECT * FROM reminder_task WHERE rem_id =".$_REQUEST['id'];
              $result = mysql_query($sql,$conn);
              if (mysql_num_rows($result) > 0)
              {
                while ($row = mysql_fetch_assoc($result)) 
                {
                  $task = $row['task'];
                  echo '<option selected>'.$task.'</option>';
                }
              }
            ?>
            </select>
            </div>
          </div>

      </div> <!-- modal bode -->
      <div class="modal-footer">
        <hr>
        <?php
          if ($Status=='Pending' && $created_by==$_SESSION['id']) 
          {
            $i= $_REQUEST['id']; ?>
            <button type='submit' class='btn btn-info waves-effect text-right'>Submit</button>
            <a href="delete_reminder2.php?rem_id=<?php echo $_REQUEST['id']; ?>" onClick="return confirm('Are you sure?')" class='btn btn-warning waves-effect text-right'>Discard reminder</a>
       <?php   }
        ?>
        
        <button type="button" class="btn btn-danger waves-effect text-right" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- /. viewmodal -->








<a id="modal_view" data-toggle="modal" data-target=".bs-example-modal-lg" style="display: none;">dsvdsv</a>
  <?php
    if (isset($_REQUEST['noteid'])) 
    { ?>
      <script type="text/javascript">
        document.getElementById('modal_view').click();
      </script>
   <?php }
  ?>

<!--  view my notes | view my notes | view my notes | view my notes | view my notes | view my notes -->





<script type="text/javascript">
  function delete_note(id)
  {
    swal({   
      title: "Are you sure?",   
      text: "You will not be able to recover this note back!",   
      type: "warning",   
      showCancelButton: true,   
      confirmButtonColor: "#DD6B55",   
      confirmButtonText: "Yes, delete it!",   
      closeOnConfirm: false 
  }, function(){  
    window.location="delete_note.php?delete_noteid="+id;
       
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


<!-- LOADING IMAGE -->
<div id="loading"></div>
<style type="text/css">
.page    { display: none; padding: 0 0.5em; }
.page h1 { font-size: 2em; line-height: 1em; margin-top: 1.1em; font-weight: bold; }
.page p  { font-size: 1.5em; line-height: 1.275em; margin-top: 0.15em; }

#loading {
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  z-index: 100;
  width: 100vw;
  height: 100vh;
  background-color: rgba(192, 192, 192, 0.5);
  background-image: url("loader.gif");
  background-repeat: no-repeat;
  background-position: center;
}
</style>
<script type="text/javascript">
 function onReady(callback) {
  var intervalId = window.setInterval(function() {
    if (document.getElementsByTagName('body')[0] !== undefined) {
      window.clearInterval(intervalId);
      callback.call(this);
    }
  }, 500);
}

function setVisible(selector, visible) {
  document.querySelector(selector).style.display = visible ? 'block' : 'none';
}

onReady(function() {
  setVisible('body', true);
  setVisible('#loading', false);
});
</script>
<!-- LOADING IMAGE -->