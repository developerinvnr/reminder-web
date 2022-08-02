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
      <!--<h5>Reports</h2>-->
      <ol class="breadcrumb">
        <span class="pull-left"><li class="breadcrumb-item"><a href="home.php">< Back</a></li></span>

        <span class="pull-right">
        <li class="breadcrumb-item"><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
        <li class="breadcrumb-item active">Reports</li>
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

            <div class="col-md-3">
              <div class="form-group">
                <label style="font-size:12px;">(Reports) From Date</label>
                <input class="form-control" name="from_date" id="from_date" autocomplete="off" placeholder="Enter From Date" value="<?php if(isset($_REQUEST['from_date']) && $_REQUEST['from_date'] !=''){echo date("d-m-Y",strtotime($_REQUEST['from_date']));} ?>">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label style="font-size:12px;">To Date</label>
                <input class="form-control" name="to_date" id="to_date" autocomplete="off" placeholder="Enter To Date" value="<?php if(isset($_REQUEST['to_date']) && $_REQUEST['to_date']!=''){echo date("d-m-Y",strtotime($_REQUEST['to_date']));}?>">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label style="font-size:12px;">Priority</label>
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
                <label style="font-size:12px;">Participants</label>
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
        <div class="col-12">
         <div class="box ">
            <!--<div class="box-header">
            </div>-->
            <!-- /.box-header -->
            <div class="box-body ">
              <table id="example1" class="table table-bordered table-striped table-condensed table-responsive" width="100%"  cellpadding="0" cellspacing="0">
                <thead>
          <tr style="background-color: #e2dede">
            <th style='text-align:center;font-size:12px;'><b></b></th>
            <th style='text-align:center;font-size:12px;'><b>Type</b></th>
            <th style='text-align:center;font-size:12px;'><b>Title</b></th>
           <!-- <th style='text-align:center;font-size:12px;'><b>Location</b></th>-->
           <!--<th style='text-align:center;font-size:12px;'><b>Rem_Req</b></th>-->
            <th style='text-align:center;font-size:12px;'><b>Priority</b></th>
            <th style='text-align:center;font-size:12px;'><b>From</b></th>
            <th style='text-align:center;font-size:12px;'><b>To</b></th>
            <th style='text-align:center;font-size:12px;'><b>Creater</b></th>
            <?php 
              if (!isset($_REQUEST['par'])) 
              { ?>
                <th style='text-align:center;font-size:12px;'><b>Participants</b></th>
            <?php }
            ?>
            <!--<th style='text-align:center;font-size:12px;'><b>Activity</b></th>-->
            <th style='text-align:center;font-size:12px;'><b>Status</b></th>

          </tr>
        </thead>
        <tbody>
          <?php 

            if (isset($_REQUEST['from_date']) && $_REQUEST['from_date']!='' && isset($_REQUEST['to_date']) && $_REQUEST['to_date']!='' && isset($_REQUEST['priority']) && $_REQUEST['priority']!='') 
            {
                $from_date = date('Y-m-d', strtotime($_REQUEST['from_date']));
                $to_date = date('Y-m-d', strtotime($_REQUEST['to_date']));
                $priority = $_REQUEST['priority'];
                if ($_SESSION['utype']=="A")
                {
                    $sql = "SELECT * FROM reminder WHERE priority='$priority' AND  date(from_date) BETWEEN '$from_date' AND '$to_date' AND activity='A'  order by from_date desc";
                }
                else
                {
                    $sql = "SELECT * FROM reminder WHERE priority='$priority' AND  date(from_date) BETWEEN '$from_date' AND '$to_date' AND activity='A' AND created_by=".$_SESSION['id']." order by from_date desc";
                }
                
            }
            else if (isset($_REQUEST['from_date']) && $_REQUEST['from_date']!='' && isset($_REQUEST['to_date']) && $_REQUEST['to_date']!='') 
            {
                $from_date = date('Y-m-d', strtotime($_REQUEST['from_date']));
                $to_date = date('Y-m-d', strtotime($_REQUEST['to_date']));
                if ($_SESSION['utype']=="A")
                {
                    $sql = "SELECT * FROM reminder WHERE date(from_date) BETWEEN '$from_date' AND '$to_date' AND activity='A' order by from_date desc";
                }
                else
                {
                    $sql = "SELECT * FROM reminder WHERE date(from_date) BETWEEN '$from_date' AND '$to_date' AND activity='A' AND created_by=".$_SESSION['id']." order by from_date desc";
                }
                
            }
            else if (isset($_REQUEST['priority']) && $_REQUEST['priority']!='') 
            {
                $priority = $_REQUEST['priority'];
                if ($_SESSION['utype']=="A")
                {
                    $sql = "SELECT * FROM reminder WHERE priority='$priority' AND activity='A' order by from_date desc";
                }
                else
                {
                    $sql = "SELECT * FROM reminder WHERE priority='$priority' AND activity='A' AND created_by=".$_SESSION['id']." order by from_date desc";
                }
            }
            else if (isset($_REQUEST['from_date']) && $_REQUEST['from_date']!='' && isset($_REQUEST['to_date']) && $_REQUEST['to_date']!='' && isset($_REQUEST['priority']) && $_REQUEST['priority']!='' && isset($_REQUEST['par']) && $_REQUEST['par']!='' && $_SESSION['utype']=="A") 
            {
                $from_date = date('Y-m-d', strtotime($_REQUEST['from_date']));
                $to_date = date('Y-m-d', strtotime($_REQUEST['to_date']));
                $priority = $_REQUEST['priority'];
                $par = $_REQUEST['par'];
                $sql = "SELECT * FROM `reminder_participants` INNER JOIN `reminder` ON reminder_participants.rem_id = reminder.rem_id WHERE reminder_participants.userid=$par order by from_date desc";
            }
            else if (isset($_REQUEST['par']) && $_REQUEST['par']!='' && $_SESSION['utype']=="A") 
            {
                $par = $_REQUEST['par'];
                $sql = "SELECT * FROM `reminder_participants` INNER JOIN `reminder` ON reminder_participants.rem_id = reminder.rem_id WHERE reminder_participants.userid=$par AND reminder.activity='A' order by from_date desc";
            }
            else
            {
              if ($_SESSION['utype']=="A")
                {
                    $sql = "SELECT * FROM reminder where activity='A' order by from_date desc";
                }
                else
                {
                    $sql = "SELECT * from reminder r INNER JOIN reminder_participants rp ON r.rem_id=rp.rem_id WHERE (r.created_by='".$_SESSION['id']."' || rp.userid='".$_SESSION['id']."' ) AND r.activity='A' GROUP BY r.rem_id order by from_date desc";
                }
                
            }

            $result = mysql_query($sql,$conn);
            while($row = mysql_fetch_assoc($result))
            {
              echo "<tr>";
            ?>
            <?php
            $r=$row['rem_id'];
              echo "<td style='text-align:center;font-size:12px;'><a href='reports.php?id=$r' title='View Reminder Detail' href=''><img src='images/view.png'></a></td>";
              echo "<td style='font-size:12px;'>".$row['type']."</td>";
              echo "<td style='font-size:12px;'>".$row['title']."</td>";
              /*echo "<td style='font-size:12px;'>".$row['location']."</td>";*/
              /*if ($row['rem_req']==1) {echo "<td style='text-align:center;font-size:12px;'>Yes</td>";}else{echo "<td style='text-align:center;font-size:12px;'>No</td>";}*/
              if ($row['priority']=="KMedium"){echo "<td style='text-align:center;font-size:12px;'>Medium</td>";}else{echo "<td style='text-align:center;font-size:12px;'>".$row['priority']."</td>";}
              echo "<td style='text-align:center;font-size:12px;'>".date('d-m-Y', strtotime($row['from_date']))."</td>"; 
              echo "<td style='text-align:center;font-size:12px;'>".date('d-m-Y', strtotime($row['to_date']))."</td>";
              
              $sql1 = "SELECT * FROM user WHERE userid =".$row['created_by'];
              $result1 = mysql_query($sql1,$conn);
              $row1 = mysql_fetch_assoc($result1);
              echo "<td style='font-size:12px;'>".$row1['ufname']." ".$row1['ulname']."</td>";

              

              if (!isset($_REQUEST['par']))
              {
                $sql2 = "SELECT user.ufname, user.ulname, reminder_participants.status as rps from user INNER JOIN reminder_participants ON reminder_participants.userid=user.userid AND reminder_participants.rem_id=".$row['rem_id'];
                $result2 = mysql_query($sql2,$conn);
                echo "<td style='font-size:12px;'>";
                if (mysql_num_rows($result2)>0)
                {
                  while($row2 = mysql_fetch_assoc($result2))
                  {
                    if ($row2['rps']==1) 
                    {
                        // echo "<a href='' style='color:green'>".$row2['ufname']." ".$row2['ulname']."</a><span style='color:blue'> | </span>";
                        echo "<span style='color:green'>".$row2['ufname']." ".$row2['ulname']."</span><span style='color:blue'> | </span>";
                    }
                    else
                    {
                        //echo "<a href='' style='color:red'>".$row2['ufname']." ".$row2['ulname']."</a><span style='color:blue'> | </span>";
                        echo "<span style='color:red'>".$row2['ufname']." ".$row2['ulname']."</span><span style='color:blue'> | </span>";

                    }
                    
                  }
                }
                else
                {
                  echo "NONE";
                }
                
                echo "</td>";
              }
              
              /*echo "<td style='text-align:center;font-size:12px;'>".$row['activity']."</td>";*/
              $aaa = "SELECT * FROM reminder_participants WHERE rem_id='".$row['rem_id']."' AND status=0 ";
              $aaa_res = mysql_query($aaa, $conn);
              if (mysql_num_rows($aaa_res)>0) 
              {
                  echo "<td style='text-align:center;font-size:12px;'><span class=' badge bg-red'>Pending<span></td>";
              }
              else
              {
                  echo "<td style='text-align:center;font-size:12px;'><span class=' badge bg-green'>Done<span></td>";
              }
              echo "</tr>";
            }
          ?>
        </tbody>
        <tfoot>
          <tr style="background-color: #e2dede">
            <th style='text-align:center;font-size:12px;'><b></b></th>
            <th style='text-align:center;font-size:12px;'><b>Type</b></th>
            <th style='text-align:center;font-size:12px;'><b>Title</b></th>
            <!--<th style='text-align:center;font-size:12px;'><b>Location</b></th>-->
            <!--<th style='text-align:center;font-size:12px;'><b>Rem_Req</b></th>-->
            <th style='text-align:center;font-size:12px;'><b>Priority</b></th>
            <th style='text-align:center;font-size:12px;'><b>From</b></th>
            <th style='text-align:center;font-size:12px;'><b>To</b></th>
            <th style='text-align:center;font-size:12px;'><b>Creater</b></th>
            <?php 
              if (!isset($_REQUEST['par'])) 
              { ?>
                <th style='text-align:center;font-size:12px;'><b>Participants</b></th>
            <?php }
            ?>
            <!--<th style='text-align:center;font-size:12px;'><b>Activity</b></th>-->
            <th style='text-align:center;font-size:12px;'><b>Status</b></th>
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
  <-- <script src="js/demo.js"></script> -->
  <script src="assets/vendor_plugins/DataTables-1.10.15/media/js/jquery.dataTables.min.js"></script>
  <script src="js/pages/data-table.js"></script>







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
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myLargeModalLabel">Reminder Task (<?=$title?>)</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal form-element col-12" action="update_reminder.php" method="post" onSubmit="ShowLoading()">

          

          <input type="hidden" name="rem_id" value="<?=$_REQUEST['id']?>">
          

          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Title</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" disabled value="<?php echo $title; ?>">
            </div>
          </div>

          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Description</label>
            <div class="col-sm-9">
              
              <?php
                if ($Status=='Pending' && $created_by==$uu) 
                { ?>
                  <input disabled id="user_desc" type="text" class="form-control" name="description" value="<?php echo $description; ?>">
               <?php }
                else
                { ?>
                    <input type="text" class="form-control" disabled value="<?php echo $description; ?>">
               <?php }
              ?>

            </div>
          </div>

          

          <input type="hidden" class="form-control" name="hidden_from_date" value="<?php echo $from_date  ?>">
          <input type="hidden" class="form-control" name="hidden_end_date" value="<?php echo $to_date  ?>">
          <input type="hidden" class="form-control" name="page_name" value="reports">

          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">From Date </label>
            <div class="col-sm-9">
              
              <?php
                if ($Status=='Pending' && $created_by==$uu && $from_date>=date('d-m-Y') ) 
                { ?>
                  <input disabled type="text" class="form-control" name="f_date" id="f_date" value="<?php echo $from_date  ?>">
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
                  <input disabled onChange="picker()" type="text" class="form-control disabled" name="t_date" id="t_date" value="<?php echo $to_date  ?>">
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


          
          

            <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label"><b>My Task Status</b></label>
            <div class="col-sm-9">
              <?php $sid = $_SESSION['id'];
          $sql = "SELECT * FROM reminder_participants WHERE rem_id =".$_REQUEST['id']." AND userid='$sid' ";
          $result = mysql_query($sql,$conn);
          if (mysql_num_rows($result) > 0)
          {
            $row = mysql_fetch_assoc($result);
             ?>
                <input type="text" class="form-control" disabled value="<?php if($row['status']==0){echo"Pending";}else{echo"Done";} ?>">
           <?php 
          }
        ?>
            </div>
          </div>


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
            <label for="inputName" class="col-sm-3 control-label">More Details</label>
            <div class="col-sm-9">
              <div class="radio" style="display: inline;">
              <input name="r_require" type="radio" id="Yes" value="1" class="radio-col-yellow" onClick="show1()">
              <label for="Yes">Yes</label>                    
            </div>
            <div class="radio" style="display: inline;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="r_require" type="radio" id="No" value="0" class="radio-col-yellow" onClick="show2()" checked="">
            <label for="No">No</label>   
            </div>
            </div>
          </div>
          

          <div id="more_detail" style="display: none;">
            <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Type</label>
            <div class="col-sm-9">
              <input type="text" class="form-control disabled" disabled readonly value="<?php echo $type; ?>">
            </div>
          </div>


<div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Priority</label>
            <div class="col-sm-9">
              <?php
                if ($Status=='Pending' && $created_by==$uu)
                { ?>
                  <select class="form-control" name="priority" disabled id="user_prior">
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




<?php
                if ($Status=='Pending' && $created_by==$uu && $rem_req==1 && $start_date>=date('d-m-Y')) 
                { ?>
                  <div class="form-group row">
                    <label for="inputName" class="col-sm-3 control-label">Start Date </label>
                    <div class="col-sm-9">
                      <input disabled onChange="picker2()" type="text" class="form-control" name="start_date5" id="start_date" value="<?php echo $start_date  ?>">
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
                      <select disabled id="user_tp" class="form-control select2" style="width: 100%;" name="period">
                        <option value="">Select</option>
                        <option value="24" <?php if($period==24){echo "selected";} ?> >Onces a day</option>
                        <option value="12" <?php if($period==12){echo "selected";} ?> >Twice a Day</option>
                      </select>
                    </div>
                  </div>
               <?php }
          ?>


          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Overall Task Status</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" disabled value="<?php echo $Status ;  ?>">

            </div>
          </div>

            <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Participants </label>
            <div class="col-sm-9">
              <select class="form-control select2" multiple="multiple" data-placeholder="Choose" style="width: 100%" name="parti[]" disabled id="usr_parti">
            <?php
              $sql = "SELECT * FROM reminder_participants rp INNER JOIN reminder r ON rp.rem_id = r.rem_id INNER JOIN user u ON rp.userid = u.userid WHERE r.rem_id =".$_REQUEST['id'];
              echo $sql;
              $arr = array();
              $result = mysql_query($sql,$conn);
              if (mysql_num_rows($result) > 0)
              {
                while ($row = mysql_fetch_assoc($result)) 
                {
                  $userid = $row['userid']; 
                  $fname = $row['ufname']; 
                  $lname = $row['ulname']; 
                  echo '<option value="'.$row['userid'].'" selected>'."&nbsp;&nbsp;".$fname.' '.$lname.'</option>';
                  array_push($arr, $userid);
                }
                $arr_list = implode(', ', $arr);
              }

              $sql11 = "SELECT * FROM user WHERE userid NOT IN ('".$arr_list."') ";
              $result11 = mysql_query($sql11,$conn);
              if (mysql_num_rows($result11) > 0)
              {
                while ($row11 = mysql_fetch_assoc($result11)) 
                {
                  $fname = $row11['ufname']; 
                  $lname = $row11['ulname']; 
                  echo '<option value="'.$row11['userid'].'">'."&nbsp;&nbsp;".$fname.' '.$lname.'</option>';
                }
              }
            ?>
            </select>
            </div>
          </div>


            <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Tasks</label>
            <div class="col-sm-9">
              <select class="form-control select2" multiple="multiple" data-placeholder="No Task" style="width: 100%" name="" disabled="disabled">
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

          </div><!-- more detail div -->












           <?php
            if ( $created_by==$_SESSION['id'])  { ?> 
              
          
          
          <div class="form-group row">
            <label for="inputName" class="col-sm-12 control-label">User Comments for this task</label>


            <?php
              $sql = "SELECT * FROM reminder r INNER JOIN reminder_participants rp ON r.rem_id=rp.rem_id WHERE rp.userid=".$_SESSION['id']." AND r.rem_id = ".$_REQUEST['id'];
              $result = mysql_query($sql,$conn);
              $row = mysql_fetch_assoc($result);
              $title = $row['title'];
              $description = $row['description'];
              $comment = $row['comment'];
              $status = $row['status'];
              $created_at = date('d-M-Y h:i A', strtotime($row['created_at']));

              $pic = "SELECT * FROM user WHERE userid=".$_SESSION['id'];
              $pic_result = mysql_query($pic,$conn);
              $pic_row = mysql_fetch_assoc($pic_result);
              $pic_row['profile_pic'];
            ?>

            <div class="col-xl-12 col-lg-12">
          <!-- Box Comment -->
          <div class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
                <img class="rounded" src="<?=$pic_row['profile_pic']?>" alt="User Image">
                <span class="username"><a href="#"><?= $_SESSION['ufname']." ".$_SESSION['ulname'] ?></a></span>
                <span class="description">Shared publicly - <?= $from_date ?></span>
              </div>
              <!-- /.user-block -->
              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <!-- /.box-body -->
            <div class="box-footer box-comments">
  
              <!-- /.box-comment -->
                <?php
                $sql = "SELECT * FROM reminder_participants  r INNER JOIN user u ON r.userid=u.userid WHERE r.rem_id = ".$_REQUEST['id'];
                $result = mysql_query($sql,$conn);
                if (mysql_num_rows($result)>0) 
                {
                
                while($row = mysql_fetch_assoc($result))
                {
                    $ufname = $row['ufname'];
                    $ulname = $row['ulname'];
                    $profile_pic = $row['profile_pic'];
                    $created_at = date('d-M-Y h:i A', strtotime($row['created_at']));
                    $comment = $row['comment'];
                    if ($comment!="") {
                      # code...
                    
                    ?>

                    <div class='box-comment'>
                    <img class='rounded' src='<?php if($profile_pic==""){echo'images/user.jpg';}else{echo $profile_pic;} ?>' alt='User Image'>
                    <div class='comment-text'>
                    <span class='username'><?=$ufname." ".$ulname ?><span class='text-muted pull-right'><?=$created_at?></span></span>
                    <?=$comment?>
                    </div>
                    </div>


                    <?php }
                }
              }
              else
              { ?>

                <div class='box-comment'>
                <div class='comment-text'>
                <h1>No Comments Yet</h1>
                </div>
                </div>

            <?php  }
                
              ?>
                
              <!-- /.box-comment -->
            </div>
          </div>
          <!-- /.box -->
        </div><!-- /.column -->






          </div><!-- /.row -->

            <?php } ?>







      </div> <!-- modal bode -->

      <script type="text/javascript">
        function discard_reminder(id)
        {
          swal({   
            title: "Are you sure?",   
            text: "You will not be able to open this reminder back!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes, delete it!",   
            closeOnConfirm: false 
        }, function(){  
          window.location="delete_reminder1.php?page=reports&rem_id="+id;
             
        });
        }  
      </script>
      <div class="modal-footer">
        <hr>
        <?php
          if ($Status=='Pending' && $created_by==$_SESSION['id']) 
          {
            $i= $_REQUEST['id']; ?>
            <!-- <button type='submit' class='btn btn-info waves-effect text-right'>Submit</button> -->
            <button type='button' class='btn btn-info waves-effect text-right' id="show_save_button">Edit Reminder</button>
            <button style="display: none;" type='submit' class='btn btn-info waves-effect text-right' id="save_button">Save Reminder</button>
            <a href="#" onClick="discard_reminder(<?= $_REQUEST['id']; ?>)" class='btn btn-warning waves-effect text-right'>Discard reminder</a>
       <?php   }
        ?>
        
        <?php
          $sql = "SELECT * FROM reminder_participants WHERE rem_id =".$_REQUEST['id']." AND userid=".$_SESSION['id']." ";
          $result = mysql_query($sql,$conn);
          if (mysql_num_rows($result) > 0)
          {
            $row = mysql_fetch_assoc($result);
            if ($row['status']==0) 
            { ?>
                <a href="reports.php?rem_id=<?=$_REQUEST['id']?>&userid=<?=$_SESSION['id']?>" class="btn btn-info waves-effect text-right">Update My status </a>
           <?php }
            
          }
        ?>




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



 <!-- checking the status of reminder in reminder table -->
<?php
  /*$qq = "SELECT * FROM reminder r INNER JOIN reminder_participants rp ON r.rem_id=rp.rem_id";
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
  }*/
  ?>
 <!-- checking the status of reminder in reminder table -->

<!--   date time picker -->
  <script src="js/jquery.datetimepicker.full.min.js"></script>
  <script type="text/javascript">

    $(function () {
      $('#f_date').datetimepicker({ minDate: new Date() }); 
    });

    $(function () {
      $('#t_date').datetimepicker({ minDate: new Date() }); 
    });

    $(function () {
      $('#start_date').datetimepicker({ minDate: new Date() }); 
    });

    jQuery('#f_date').datetimepicker({
      startDate:'+1971/05/01',
      format:'d.m.Y H:i'
    });

    jQuery('#t_date').datetimepicker({
      startDate:'+1971/05/01',
      format:'d.m.Y H:i'
    });

    jQuery('#start_date').datetimepicker({
      startDate:'+1971/05/01',
      format:'d.m.Y H:i'
    });
  </script>
<!--   date time picker -->

   <!-- dfsbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb -->
<button class="tst3 btn btn-success" style="display: none;"></button>
<button class="tst4 btn btn-danger" style="display: none;"></button>

<?php
if (isset($_GET['update']) && $_GET['update'] == "success")
{ ?>

  <script type="text/javascript">

    $(document).ready(function () {
      $.toast({
          heading: 'Reminder Updated Successfully',
          position: 'top-right',
          loaderBg: '#ff6849',
          icon: 'success',
          hideAfter: 3500,
          stack: 6
      });

  });
  </script>

<?php }
if (isset($_GET['status']) && $_GET['status'] == "success")
{ ?>

  <script type="text/javascript">

    $(document).ready(function () {
      $.toast({
          heading: 'Status Updated Successfully',
          position: 'top-right',
          loaderBg: '#ff6849',
          icon: 'success',
          hideAfter: 3500,
          stack: 6
      });

  });
  </script>

<?php }

else if(isset($_GET['update']) && $_GET['update'] == "fail")
{ ?>
    
  <script type="text/javascript">
   $(document).ready(function () {
        $.toast({
            heading: 'Reminder Updation fail',
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
?>
<link rel="stylesheet" type="text/css" href="assets\vendor_components\jquery-toast-plugin-master\src\jquery.toast.css">
<script src="assets\vendor_components\jquery-toast-plugin-master\src\jquery.toast.js"></script>
<!-- dfsbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb -->








<!-- Modal change task status for particular user -->
<a data-toggle="modal" data-target=".update_task_status" id="aaa" style="display: none;"> update task</a>
<form action="update_user_status.php" method="post" onSubmit="ShowLoading()">
<div class="modal fade none-border update_task_status" id="update_task_status">
 <div class="modal-dialog">
  <div class="modal-content">
   
   <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  <h4 class="modal-title"><strong>Update task Reminder</strong> </h4>
   </div>
   
   <div class="modal-body">

    <?php
      $sql = "SELECT * FROM reminder r INNER JOIN reminder_participants rp ON r.rem_id=rp.rem_id WHERE rp.userid=".$_SESSION['id']." AND r.rem_id = ".$_REQUEST['rem_id'];
      $result = mysql_query($sql,$conn);
      $row = mysql_fetch_assoc($result);
      $title = $row['title'];
      $description = $row['description'];
      $comment = $row['comment'];
      $status = $row['status'];
    ?>

    <div class="form-group row">
          <label for="example-text-input" class="col-sm-4 col-form-label">Title</label>
          <div class="col-sm-8">
          <input class="form-control" type="text" placeholder="Enter title" id="title" name="title" autocomplete="off" required disabled="" value="<?=$title?>">
          </div>
        </div>

        <div class="form-group row">
          <label for="example-search-input" class="col-sm-4 col-form-label">Description</label>
          <div class="col-sm-8">
          <input class="form-control" type="search" placeholder="Enter Description" id="desc" name="desc" autocomplete="off" required disabled="" value="<?=$description?>">
          </div>
        </div>

        <div class="form-group row">
          <label for="example-search-input" class="col-sm-4 col-form-label">Status</label>
          <div class="col-sm-8">
          <!-- <input class="form-control" type="search" placeholder="Enter Description" id="desc" name="desc" autocomplete="off" required disabled="" value="<?=$description?>"> -->
          <select class="form-control" name="status">
            <option value="0" <?php if ($status==0){echo "selected";} ?>>Pending</option>
            <option value="1" <?php if ($status==1){echo "selected";} ?>>Done</option>
          </select>
          </div>
        </div>

        <div class="form-group row">
          <label for="example-search-input" class="col-sm-4 col-form-label">Comment <label style="color: red">*</label></label>
          <div class="col-sm-8">
            <input type="hidden" name="page_name" value="reports">
            <input type="hidden" name="rem_id" value="<?=$_REQUEST['rem_id']?>">
          <textarea name="comment" class="form-control" placeholder="enter task comment" rows="5" required=""><?=$comment?></textarea>


          </div>
        </div>

   </div>
   
   <div class="modal-footer">
    <hr>
  <button type="submit" class="btn btn-info waves-effect waves-light save-category">Update Status</button>
  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
   </div>
   
  </div>
 </div>
</div>
</form>


<?php
    if (isset($_REQUEST['rem_id']) && $_REQUEST['rem_id']!="" && isset($_REQUEST['userid']) && $_REQUEST['userid']!="") 
    { echo $_REQUEST['userid'];
    echo $_REQUEST['rem_id']; ?>
          <script type="text/javascript">
            document.getElementById('aaa').click();
          </script>
   <?php }
  ?>

<!-- Modal change task status for particular user -->



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

<script>
jQuery(document).ready(function(){
    jQuery('#show_save_button').click(function(event) 
    {        
         jQuery('#save_button').show();
         jQuery('#show_save_button').hide();
         $('#user_desc').removeAttr("disabled");
         $('#usr_parti').removeAttr("disabled");
         $('#user_prior').removeAttr("disabled");
         $('#f_date').removeAttr("disabled");
         $('#t_date').removeAttr("disabled");
         $('#start_date').removeAttr("disabled");
         $('#user_tp').removeAttr("disabled");
         $('#user_desc').focus();
    });
});
</script>

<!-- for show hide start date and time period based on rem_req -->
<script type="text/javascript">
function show1(){document.getElementById('more_detail').style.display = 'block'; }
function show2(){document.getElementById('more_detail').style.display ='none';}
</script>
<!-- for show hide start date and time period based on rem_req -->