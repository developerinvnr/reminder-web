<?php include('common_function.php'); ?>



<?php
    include "config.php";
    session_start();
    $uu = $_SESSION['id'];
    if (!isset($_SESSION['id']))
    {
        header('Location: index.php');
    }
    if (isset($_POST['rate_n_close']) && $_POST['rate_n_close']!="" ) 
    {
      $update = "UPDATE reminder SET activity='D' WHERE rem_id='".$_POST['close_rem_id']."' ";
      $rrr = mysql_query($update,$conn);
      if ($rrr) 
      {
        echo "<script>window.location='reports.php?rem_delete=success';</script>";
      } 
    }
    elseif (isset($_GET['delete_rem_id']) && $_GET['delete_rem_id']!="" ) 
    {
      $update = "UPDATE reminder SET activity='De' WHERE rem_id='".$_GET['delete_rem_id']."' ";
      $rrr = mysql_query($update,$conn);
      if ($rrr) 
      {
        echo "<script>window.location='reports.php?delete_rem=success';</script>";
      } 
    }
    elseif (isset($_POST['forward_rem'])) 
    {
      // echo "<script>alert('hello')</script>";
      $aa = "INSERT INTO forward_rem(rem_id, froward_by) VALUES('".$_POST['rem_id']."', '".$_SESSION['id']."')";
      $res= mysql_query($aa, $conn);
      $last_key = mysql_insert_id($conn);
      if($res) 
      {
        foreach ($_POST['forward_parti'] as $key) 
        {
          $a = "INSERT INTO forward_user(rm_id, userid) VALUES('".$last_key."', '".$key."')";
          mysql_query($a, $conn);

          $b = "INSERT INTO reminder_participants(rem_id, userid, forwarded) VALUES('".$_POST['rem_id']."', '".$key."', '1')";
          mysql_query($b, $conn);
        }
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

  <style type="text/css">
  

.result-container{
  width: 82px; height: 18px;
  position: relative;
  background-color: #ccc;
  border: #ccc 1px solid;
  margin:auto;
}
.rate-stars{
  width: 82px; height: 18px;
  background: url(rate-stars.png) no-repeat;
  position: absolute;
}
.rate-bg{
  height: 18px;
  background-color: #ffbe10;
  position: absolute;
}


  .rate
  {
  width:400px; 
  height: 40px;
  border:#e9e9e9 1px solid;
  background-color:  #f6f6f6;
  /*margin:60px auto;*/
  margin-top:2px;
  }
  .rate .rate-btn{
  width: 45px; height:40px;
  float: left;
  background: url(rate-btn.png) no-repeat center center;
  cursor: pointer;
  margin-top: -1px;
  }
  .rate .rate-btn:hover, .rate  .rate-btn-hover, .rate  .rate-btn-active{
    background: url(rate-btn-hover.png) no-repeat center center;
    width: 45px; height:40px;
  }



@media screen and (max-width: 480px){
  .rate{
    width:280px; 
    height: 40px;
    border:#e9e9e9 1px solid;
    background-color:  #f6f6f6;
    margin-bottom:0px;
  }
  .rate .rate-btn{
    width: 28px; height:30px;
    float: left;
    background: url(rate-btn.png) no-repeat center center;
    cursor: pointer;
    margin-top: 5px;
    }
  .rate .rate-btn:hover, .rate  .rate-btn-hover, .rate  .rate-btn-active{
    background: url(rate-btn-hover.png) no-repeat center center;
    width: 28px; height:30px;
  }


}

  blockquote:not(:first-child) 
  {
      margin-top:30px;
  }
  blockquote{
  display:block;
  /*background: #fff;*/
  padding: 3px 3px 3px 3px;
  margin: 0 0 -27px;
  position: relative;
  
  /*Font*/
  font-family: Georgia, serif;
  font-size: 14px;
  line-height: 1.2;
  color: #666;

  /*Box Shadow - (Optional)*/
  -moz-box-shadow: 2px 2px 15px #ccc;
  -webkit-box-shadow: 2px 2px 15px #ccc;
  box-shadow: 2px 2px 15px #ccc;

  /*Borders - (Optional)*/
  border-left-style: solid;
  border-left-width: 0px;
  border-right-style: solid;
  border-right-width: 0px;    
}


blockquote a{
  text-decoration: none;
  background: #eee;
  cursor: pointer;
  padding: 0 3px;
  color: #c76c0c;
}

blockquote a:hover{
 color: #666;
}

blockquote em{
  font-style: italic;
}

  /*Default Color Palette*/
blockquote.default{ 
  border-left-color: #656d77;
  border-right-color: #434a53;  
}

blockquote.white{ 
  border-left-color: #FFFFFF;
  border-right-color: #FFFFFF;  
}

/*Grapefruit Color Palette*/
blockquote.grapefruit{
  border-left-color: #ed5565;
  border-right-color: #da4453;
}

/*Bittersweet Color Palette*/
blockquote.bittersweet{
  border-left-color: #fc6d58;
  border-right-color: #e95546;
}

/*Sunflower Color Palette*/
blockquote.sunflower{
  border-left-color: #ffcd69;
  border-right-color: #f6ba59;
}

/*Grass Color Palette*/
blockquote.grass{
  border-left-color: #9fd477;
  border-right-color: #8bc163;
}

/*Mint Color Palette*/
blockquote.mint{
  border-left-color: #46cfb0;
  border-right-color: #34bc9d;
}

/*Aqua Color Palette*/
blockquote.aqua{
  border-left-color: #4fc2e5;
  border-right-color: #3bb0d6;
}

/*Blue Jeans Color Palette*/
blockquote.bluejeans{
  border-left-color: #5e9de6;
  border-right-color: #4b8ad6;
}

/*Lavander Color Palette*/
blockquote.lavander{
  border-left-color: #ad93e6;
  border-right-color: #977bd5;
}

/*Pinkrose Color Palette*/
blockquote.pinkrose{
  border-left-color: #ed87bd;
  border-right-color: #d870a9;
}

/*Light Color Palette*/
blockquote.light{
  border-left-color: #f5f7fa;
  border-right-color: #e6e9ed;
}

/*Gray Color Palette*/
blockquote.gray{
  border-left-color: #ccd1d8;
  border-right-color: #aab2bc;
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

            <div class="col-md-2">
              <div class="form-group">
                <label style="font-size:12px;">(Reports) From Date</label>
                <input class="form-control" name="from_date" id="from_date" autocomplete="off" placeholder="Enter From Date" value="<?php if(isset($_REQUEST['from_date']) && $_REQUEST['from_date'] !=''){echo date("d-m-Y",strtotime($_REQUEST['from_date']));} ?>">
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <label style="font-size:12px;">To Date</label>
                <input class="form-control" name="to_date" id="to_date" autocomplete="off" placeholder="Enter To Date" value="<?php if(isset($_REQUEST['to_date']) && $_REQUEST['to_date']!=''){echo date("d-m-Y",strtotime($_REQUEST['to_date']));}?>">
              </div>
            </div>

            <div class="col-md-2">
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
              <div class="col-md-2">
              <div class="form-group">
                <label style="font-size:12px;">Participants</label>
                <select class="form-control select2" style="width: 100%;" name="par">
                  <option value="">Select</option>
                  <?php
                      $sql = "SELECT * FROM user WHERE usts='A' ";
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



           <?php if ($_SESSION['utype']=="A") 
            { ?>
              <div class="col-md-2">
              <div class="form-group">
                <label style="font-size:12px;">Status</label>
                <select class="form-control select2" style="width: 100%;" name="statusfilter">
                  <option value="">Select</option>
                  <option value="Done" <?php if(isset($_REQUEST['statusfilter']) && $_REQUEST['statusfilter']=='Done'){echo 'selected'; }?> > Done</option>
                  <option value="Pending" <?php if(isset($_REQUEST['statusfilter']) && $_REQUEST['statusfilter']=='Pending'){echo 'selected'; }?> >Pending</option>
                  
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
            <th style='text-align:center;font-size:12px;'><b>Priority</b></th>
            <th style='text-align:center;font-size:12px;'><b>From</b></th>
            <th style='text-align:center;font-size:12px;'><b>To</b></th>
            <th style='text-align:center;font-size:12px;'><b>Creater</b></th>
            <th style='text-align:center;font-size:12px;'><b>Participants</b></th>
            <th style='text-align:center;font-size:12px;'><b>Status</b></th>
            <th style='text-align:center;font-size:12px;'><b>Rating</b></th>
          </tr>
        </thead>
        <tbody>
          <?php 

            // $from_date = date('Y-m-d', strtotime($_REQUEST['from_date']));
            // $to_date = date('Y-m-d', strtotime($_REQUEST['to_date']));
            // $priority = $_REQUEST['priority'];
            // if (isset($_REQUEST['to_date']) && $_REQUEST['to_date']!=""){$to_date = date('Y-m-d', strtotime($_REQUEST['to_date']));}else{$to_date = date('Y-m-d');}

            $timestamp = time();
            $date = strtotime("-7 day", $timestamp);
            $seven_days =  date('Y-m-d', $date);

            if (isset($_REQUEST['from_date']) && $_REQUEST['from_date']!="" || isset($_REQUEST['to_date']) && $_REQUEST['to_date']!=""){$date_range = "date(r.from_date) BETWEEN '".date('Y-m-d', strtotime($_REQUEST['from_date']))."' AND '".date('Y-m-d', strtotime($_REQUEST['to_date']))."'";}else{$date_range = "1=1";}


            if (isset($_REQUEST['priority']) && $_REQUEST['priority']!=""){$priority = "priority='".$_REQUEST['priority']."'";}else{$priority = '1=1';}

            if (isset($_REQUEST['statusfilter']) && $_REQUEST['statusfilter']!=""){

              if($_REQUEST['statusfilter']=="Done"){
                $statusfilter = "r.Status='Done' and rp.status=1 and rp.status!=0";
              }else{
                $statusfilter = "(r.Status='Done' or r.Status='Pending') and rp.status=0";
              }

            }else{$statusfilter = '1=1';}

            if (isset($_REQUEST['par']) && $_REQUEST['par']!=""){$par = "(rp.userid='".$_REQUEST['par']."' || r.created_by='".$_REQUEST['par']."')";}else{$par = "(rp.userid='".$_SESSION['id']."' || r.created_by='".$_SESSION['id']."')"; }


           $sql = "SELECT * from reminder r INNER JOIN reminder_participants rp ON r.rem_id=rp.rem_id WHERE $priority AND $statusfilter AND $date_range AND $par AND r.activity!='De' GROUP BY r.rem_id order by r.Status DESC, r.from_date desc  ";

//INNER JOIN rating rat ON rat.rem_id=r.rem_id and rat.userid=rp.userid

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

              

              // if (!isset($_REQUEST['par']))
              // {
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
              // }
              
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

              echo "<td style='text-align:center;font-size:12px;'>";
 
 if($_SESSION['utype']=="A"){ $srat = mysql_query("SELECT AVG(rate) as vrate FROM rating WHERE rem_id=".$row['rem_id'],$conn); }else{ $srat = mysql_query("SELECT rate as vrate FROM rating WHERE rem_id=".$row['rem_id']." AND userid=".$_SESSION['id'],$conn); }
 $rrat = mysql_fetch_assoc($srat);
 
              $rate=(int)$rrat['vrate'];
              $i=1;

              while ( $i<= 5) {
                if($i<=$rate){
                  ?><img src="rate-btn-hover.png" style="width:17px;display: inline-block;float:left;margin-left: -5px;" /><?php
                }else{
                  ?><img src="rate-btn.png" style="width:17px;display: inline-block;float:left;margin-left: -5px;" /><?php

                }
                $i++;
              }

              echo "</td>";

              echo "</tr>";
            }
          ?>

        </tbody>
        <tfoot>
          <tr style="background-color: #e2dede">
            <th style='text-align:center;font-size:12px;'><b></b></th>
            <th style='text-align:center;font-size:12px;'><b>Type</b></th>
            <th style='text-align:center;font-size:12px;'><b>Title</b></th>
            <th style='text-align:center;font-size:12px;'><b>Priority</b></th>
            <th style='text-align:center;font-size:12px;'><b>From</b></th>
            <th style='text-align:center;font-size:12px;'><b>To</b></th>
            <th style='text-align:center;font-size:12px;'><b>Creater</b></th>
            <th style='text-align:center;font-size:12px;'><b>Participants</b></th>
            <th style='text-align:center;font-size:12px;'><b>Status</b></th>
            <th style='text-align:center;font-size:12px;'><b>Rating</b></th>
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
          
          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Reply</label>
            <div class="col-sm-9">
             <?php
              $sql = mysql_query("SELECT * FROM reminder_participants rp INNER JOIN reminder r ON rp.rem_id = r.rem_id INNER JOIN user u ON rp.userid = u.userid WHERE r.rem_id =".$_REQUEST['id'],$conn);
              while ($row = mysql_fetch_assoc($sql)) 
                { 
                  echo '<font color="#00C100">'.$row['ufname'].' '.$row['ulname'].':</font>&nbsp;'.$row['comment'].'<br>'; 
                }
            ?>
            </div>
          </div>

          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Rating Given For Task</label>
            <div class="col-sm-9">
              <?php
              // $sql = "SELECT * from reminder r INNER JOIN reminder_participants rp ON r.rem_id=rp.rem_id INNER JOIN rating rat ON rat.rem_id=r.rem_id and rat.userid=rp.userid WHERE $priority AND $date_range AND $par AND r.activity!='De' GROUP BY r.rem_id order by r.Status DESC, r.from_date desc  ";




              $sql = "SELECT * FROM reminder_participants rp INNER JOIN reminder r ON rp.rem_id = r.rem_id INNER JOIN user u ON rp.userid = u.userid INNER JOIN rating rat ON rat.rem_id=r.rem_id and rat.userid=rp.userid WHERE r.rem_id =".$_REQUEST['id'];
              
              $result = mysql_query($sql,$conn);
              
              while ($row = mysql_fetch_assoc($result)){
                   
                  ?>
                  <span style="float:left;"><?=$row['ufname'].' '.$row['ulname'].'&emsp;'?></span>
                  <?php
                 
                  $rate=(int)$row['rate'];
                  $i=1;

                  while ( $i<= 5) {
                    if($i<=$rate){
                      ?><img src="rate-btn-hover.png" style="width:22px;display: inline-block;float:left;margin-left: -5px;" /><?php
                    }else{
                      ?><img src="rate-btn.png" style="width:22px;display: inline-block;float:left;margin-left: -5px;" /><?php

                    }
                    $i++;
                  }

                  echo '&emsp;Remark<input value="'.$row['remark'].'" readonly />';

                  if($row['userid']==$_SESSION['id']){
                    $reopen=1; //this variable is also being used in bottom near close button
                  }

                  if($rate<=3 && isset($reopen) && $reopen==1){
                    ?>
                    &emsp;
                    <button type="button" class="btn btn-sm btn-warning waves-effect text-right" onClick="reOpenTask('<?=$_REQUEST['id']?>','<?=$row['userid']?>',this)">Re-Open Task</button>
                    <?php


                  }

                  echo '<br>';


                  
              }
                
              

              






              
              ?>
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
                <img class="rounded" src="<?php if($profile_pic==""){echo'images/user.jpg';}else{echo $profile_pic;} ?>" alt="User Image">
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
            
       <?php   }
       if($Status=='Done' && $created_by==$_SESSION['id'])
       { ?>
          <a href="reports.php?close_id=<?=$_REQUEST['id']?>" class='btn btn-warning waves-effect text-right'>Give Rating</a>
     <?php  }

     if($created_by==$_SESSION['id'])
       { ?>
          <a href="reports.php?delete_rem_id=<?=$_REQUEST['id']?>" class='btn btn-warning waves-effect text-right'>Delete Reminder</a>
     <?php  }
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
        <?php
        if(isset($reopen) && $reopen==1){
          ?>
          &emsp;
          <button type="button" class="btn btn-sm btn-warning waves-effect text-right" onClick="reOpenTask('<?=$_REQUEST['id']?>','<?=$row['userid']?>',this)">Re-Open Task</button>
          <?php

        }
        ?>
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


else if (isset($_GET['rem_delete']) && $_GET['rem_delete'] == "successs")
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
else if (isset($_GET['delete_rem']) && $_GET['delete_rem'] == "success")
{ ?>

  <script type="text/javascript">

    $(document).ready(function () {
      $.toast({
          heading: 'Reminder Deleted Successfully',
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


<!-- for show hide start date and time period based on rem_req -->
<script type="text/javascript">
function show1(){document.getElementById('more_detail').style.display = 'block'; }
function show2(){document.getElementById('more_detail').style.display ='none';}
</script>
<!-- for show hide start date and time period based on rem_req -->


<!-- Trigger the modal with a button -->
<button id="close" type="button" style="display: none;"  data-toggle="modal" data-target="#a"></button>

<!-- Modal -->
<div id="a" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form action="reports.php" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Give Ratings to user</h4>
      </div>
      <div class="modal-body">
        
        <p>

          <?php
            $user = "SELECT * FROM reminder r INNER JOIN reminder_participants pr ON r.rem_id=pr.rem_id WHERE r.rem_id=".$_REQUEST['close_id'];
            $ur = mysql_query($user, $conn);
            while($fr = mysql_fetch_assoc($ur))
            { ?>
              <input type="hidden" name="close_rem_id" value="<?= $_REQUEST['close_id'] ?>">
              <?php $post_id = $_REQUEST['close_id']; ?>
              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-3">
                    <?php
                    $rate = get_rate($fr['userid'], $_REQUEST['close_id']);
                    $rate= intval($rate);

                     ?> 

                  </div>
                    <div class="col-md-7">
                      
                      <div class="rate">
                            <!-- <div class="col-md-4 pull-left"> -->
                            <!-- </div> -->
                            <div class="col-md-12">
                              <span style="float: left; margin: 5px 8px 0px -5px; width: 100px;margin-top: 10px;"><?= get_name($fr['userid']) ?></span>
                              <div id="<?=$fr['userid']?>-1" class="btn-1 rate-btn <?php if($rate>=1 && $rate!=0){echo "rate-btn-active";} ?>"></div>
                            <div id="<?=$fr['userid']?>-2" class="btn-2 rate-btn <?php if($rate>=2 && $rate!=0){echo "rate-btn-active";} ?>"></div>
                            <div id="<?=$fr['userid']?>-3" class="btn-3 rate-btn <?php if($rate>=3 && $rate!=0){echo "rate-btn-active";} ?>"></div>
                            <div id="<?=$fr['userid']?>-4" class="btn-4 rate-btn <?php if($rate>=4 && $rate!=0){echo "rate-btn-active";} ?>"></div>
                            <div id="<?=$fr['userid']?>-5" class="btn-5 rate-btn <?php if($rate>=5 && $rate!=0){echo "rate-btn-active";} ?>"></div>


                            </div>
                            
                      </div>
                    </div>
                </div>
              </div>

           <?php } ?>
        </p>
        
      </div>
      <div class="box-result">
       <?php
          $query = mysql_query("SELECT * FROM rating"); 
              while($data = mysql_fetch_assoc($query))
              {
                    $rate_db[] = $data;
                    $sum_rates[] = $data['rate'];
                }
                if(@count($rate_db)){
                    $rate_times = count($rate_db);
                    $sum_rates = array_sum($sum_rates);
                    $rate_value = $sum_rates/$rate_times;
                    $rate_bg = (($rate_value)/5)*100;
                }else{
                    $rate_times = 0;
                    $rate_value = 0;
                    $rate_bg = 0;
                }
        ?> 
    </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-warning" name="rate_n_close" value="ss">Save & Close Reminder</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </form>
    </div>

  </div>
</div>

<?php
    if (isset($_REQUEST['close_id']) && $_REQUEST['close_id']!="") 
    { ?>
          <script type="text/javascript">
            document.getElementById('close').click();
          </script>
   <?php }
  ?>
<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
  <script>

    function act_star(id)
    {
      var s=id.split("-");
    var uid=s[0];
    var c=s[1];
   $('#'+id).removeClass('rate-btn-hover');
      for (var i = c; i >= 0; i--) {
   $('#'+uid+'-'+i).addClass('rate-btn-hover');
       };
       for (var i = c; i <= 5; i++) {
   $('#'+uid+'-'+i).removeClass('rate-btn-hover');
       };
    }


$(function(){ 

$('.rate').hover(function(){
// $(this).css("background-color","red");
});

$( ".rate" ).mouseout(function() {
// $(this).css("background-color","green");
$('.rate div').removeClass('rate-btn-hover');
});
  $('.rate-btn').hover(function(){
    var id = $(this).attr("id");
    var s=id.split("-");
    var uid=s[0];
    var c=s[1];
    $('#'+id).removeClass('rate-btn-hover');

    for (var i = c; i >= 0; i--) {
      $('#'+uid+'-'+i).addClass('rate-btn-hover');
    }
    for (var i = c; i <= 5; i++) {
      $('#'+uid+'-'+i).removeClass('rate-btn-hover');
    }
  });        




    $('.rate-btn').click(function(){    
      var id = $(this).attr("id");
      // act_star(id);

    var s=id.split("-");
    var uid=s[0];
    var c=s[1];



   var dataRate = 'act=rate&userid='+uid+'&post_id=<?php echo $post_id; ?>&rate='+c; //
   $('#'+id).removeClass('rate-btn-active');
      for (var i = c; i >= 0; i--) {
        $('#'+uid+'-'+i).addClass('rate-btn-active');
        $('#'+uid+'-'+i).addClass('rate-btn-hover');
      }
      for (var i = c; i <=5; i++) {
        $('#'+uid+'-'+i).removeClass('rate-btn-active');
        $('#'+uid+'-'+i).removeClass('rate-btn-hover');
      }

$(this).addClass('rate-btn-active');



   $.ajax({
      type : "POST",
      url : "ajax.php",
      data: dataRate,
      success:function(d){}
    });
  });
});
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


<!-- dfsbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb -->
<button class="tst3 btn btn-success" style="display: none;"></button>
<button class="tst4 btn btn-danger" style="display: none;"></button>

<?php
if (isset($_GET['update']) && $_GET['update'] == "success")
{ ?>
  <script type="text/javascript">

    $(document).ready(function () {
      $.toast({
          heading: 'Password reset Successfully',
          text: '<?php echo "Welcome"." ".$fname." ".$ulname;?>',
          position: 'top-right',
          loaderBg: '#ff6849',
          icon: 'success',
          hideAfter: 3500,
          stack: 6
      });

  });
  </script>

<?php }

if (isset($_GET['pass_update']) && $_GET['pass_update'] == "success")
{ ?>
  <script type="text/javascript">

    $(document).ready(function () {
      $.toast({
          heading: 'Reminder Updated Successfully',
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



if (isset($_GET['status']) && $_GET['status']!="") 
  { ?>
  <script type="text/javascript">

    $(document).ready(function () {
      $.toast({
          heading: 'Status changed Successfully',
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
else if(isset($_GET['update']) && $_GET['update'] == "fail")
{ ?>
    
  <script type="text/javascript">
   $(document).ready(function () {
        $.toast({
            heading: 'Password update fail',
            text: 'Please reset password immediatly',
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'error',
            hideAfter: 3500

        });

    });
  </script>

<?php  }

else if(isset($_GET['pass_update']) && $_GET['pass_update'] == "fail")
{ ?>
  <script type="text/javascript">
   $(document).ready(function () {
        $.toast({
            heading: 'Reminder updation failed',
            text: 'Please reset password immediatly',
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
            heading: 'Reminder close fail',
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
          heading: 'Reminder close Successfully',
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
  function reOpenTask(remid,uid,th){

    if(confirm("Are you sure to Re-Open the task?")){


      $.post("ajax.php",{act:'reOpenTask',uid:uid, remid:remid}, function(data){

          if(data.includes("saved")){

            $(th).hide();

            $.toast({
                heading: 'Task Reopend Successfully',
                text: 'You can see updated reminder on calendar',
                position: 'top-right',
                loaderBg: '#ff6849',
                icon: 'success',
                hideAfter: 3500,
                stack: 6
            });
          }
      });
    }
  }
</script>