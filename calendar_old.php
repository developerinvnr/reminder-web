<?php
    session_start();
    if (!isset($_SESSION['id']))
    {
        header('Location: index.php');
    }    
    include "config.php";
    $sid = $_SESSION['id'];
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
<style>
.fontH 
{
  font-family:Times New Roman;
  font-size:16px;
}
.font 
{
  font-family:Times New Roman;
  font-size:13px;
}
.calendar 
{ color:black;
  margin-left:0px;
  width:100%;
  border:0px solid #CDCDCD; 
}
.weekday 
{ 
  text-align:center;
  width:14%;
  height:30px;
  border:1px solid #CCCCCC;
  font-style:oblique;
  font-family:Arial;
  font-weight:bold;
  font-size:10px;
  background-color:#FFFF9F;
  color:#000000; 
 }
.monthday 
{ 
  text-align:center;
  width:14%;
  height:30px;
  font-family:Arial;
  font-size:12px;
  background-color:#E3BD4A;
  border:hidden;
  cursor:pointer;
  color:#004080; 
}
.day 
{
  border:1px solid #CCCCCC;
  width:14%;
  vertical-align:top;
  font-family:Arial;
  font-size:10px;
  height:60px;
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

  <div class="content-wrapper">

    <section class="content-header" style="margin-top: -20px;">
      <!-- <div class="row">
      <a href="home.php"> < Back </a>
    </div> -->
      <!-- <h3>My Calendar</h3> -->
      <ol class="breadcrumb">
        <span class="pull-left"><li class="breadcrumb-item"><a href="home.php">< Back</a></li></span>

        <span class="pull-right">
        <li class="breadcrumb-item"><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
        <li class="breadcrumb-item active">My Calendar</li>
      </span>
      </ol>
    </section>


    <section class="content" style="margin-top: -15px;">
   <div class="row">
    <div class="col-5">
        <a data-toggle="modal" role="dialog" data-target="#add-new-events" class="btn btn-lg btn-orange btn-block margin-top-10"><i class="ti-plus"></i> Add New Reminder</a>
      </div>

      <div class="col-lg-9 col-md-12">
          <div class="box box-primary">
            <div class="box-body no-padding">
              <div id="calendar">

                    <?php
                    $uid = $_SESSION['id'];
                      if ($_SESSION['utype']=="A") 
                    {
                        $sql = "SELECT Status, from_date as f, to_date as t, DATE_FORMAT(from_date, '%Y-%m-%d') as i,DATE_FORMAT(to_date, '%Y-%m-%d') as j, priority, title, description, rem_id FROM reminder WHERE activity='A' ORDER BY priority ASC";
                    }
                    else
                    {
                        $sql = "SELECT r.Status, r.from_date as f, r.to_date as t, DATE_FORMAT(r.from_date, '%Y-%m-%d') as i,DATE_FORMAT(r.to_date, '%Y-%m-%d') as j, r.priority, r.title, r.description, r.rem_id FROM reminder r INNER JOIN reminder_participants rp ON r.rem_id=rp.rem_id WHERE (r.created_by='$uid' OR rp.userid='$uid') AND r.activity='A' ORDER BY r.priority ASC";
                    }
                      $array = array();
                      $result = mysql_query($sql,$conn);
                      while($row = mysql_fetch_assoc($result))
                      {
                        // echo $row['i'];
                        // echo $row['j'];
                         $from_date = date_create($row['f']);
                         $to_date = date_create($row['t']);
                        // echo $to_date = $row['j'];
                         $diff=date_diff($to_date,$from_date);
                         $date_diff = $diff->format("%a");
                         // $date_diff +=1;
                         $array[] =$row;
                         for ($i=1; $i <=$date_diff ; $i++) 
                         { 
                            $cdate = date('Y-m-d', strtotime($row['f']. ' + '.$i.' days'));
                            $push = array();
                            $push['Status'] = $row['Status']; 
                            $push['f'] = $row['f']; 
                            $push['t'] = $row['t']; 
                            $push['i'] = $cdate; 
                            $push['j'] = $row['j']; 
                            $push['priority'] = $row['priority']; 
                            $push['title'] = $row['title']; 
                            $push['description'] = $row['description']; 
                            $push['rem_id'] = $row['rem_id']; 
                             $array[] =$push;
                            
                         }
                      }
                      
                    ?>
        

                        <!-- calenderrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr -->
                        <?php $m=date("m"); $y=date("Y"); 
                        $mkdate = mktime(0,0,0, $m, 1, $y); $FDay = date('w',$mkdate); $pwkDay = date('w',$mkdate);
                        $days = date('t',$mkdate); $day ='01'; $showBtn=1;  ?>  
                        <table class="calendar" cellpadding="2" cellspacing="0" border="0">
                         <tr>
                          <td colspan="3" valign="top" style="width:100%;">
                           <span id="SpanCalendar">
                            <table style="width:100%;" cellspacing="0">
                        <tr>
                          <td class="monthday" colspan="2"><span onClick="FunMonth('P',<?php echo $m.','.$y;?>)"><u>Prev</u> << </span></td>
                          <td class="monthday" colspan="3"><?php echo date("F Y"); ?></td>
                          <td class="monthday" colspan="2"><span onClick="FunMonth('N',<?php echo $m.','.$y;?>)"> >> <u>Next</u></span></td>
                        </tr>
                          
                        <tr>
                         <td class="weekday">SUN</td><td class="weekday">MON</td><td class="weekday">TUE</td>
                         <td class="weekday">WED</td><td class="weekday">THU</td><td class="weekday">FRI</td>
                         <td class="weekday">SAT</td>
                        </tr>
                        <tr>
                        <?php $weeks = '1'; $loopCount ='1'; 
                        while($loopCount<=$FDay){ ?><td class="day">&nbsp;</td><?php $loopCount++; } $FDay++;
                        while($day<=$days)
                        { //While-Open ?>

                              <td class="day" style="background-color:<?php 
                              if(date("w",strtotime(date($y."-".$m."-".$day)))==0 && in_array(date($y."-".$m."-".$day), array_column($array, 'i')))
                              {
                                  $from_date = array_column($array, 'i');
                                  $to_date = array_column($array, 'j');
                                  $current_date = date($y."-".$m."-".$day);
                                   $ind = array_search(date($y."-".$m."-".$day), array_column($array, 'i'));
                                  
                                   if($array[$ind]['priority']=="Low")
                                   {
                                      if ($array[$ind]['Status']=="Done") 
                                      {
                                        echo '#FFFFFF; color:#C0C0C0;';
                                      }
                                      else
                                      {
                                        echo '#ffe9ba; color:#000000;';
                                      }
                                   }
                                   else if($array[$ind]['priority']=="High")
                                   {
                                    
                                      if ($array[$ind]['Status']=="Done") 
                                      {
                                        echo '#FFFFFF; color:#C0C0C0;';
                                      }
                                      else
                                      {
                                        echo '#ff9d99; color:#000000;';
                                      }
                                   }
                                   else if($array[$ind]['priority']=="KMedium")
                                   {
                                      if ($array[$ind]['Status']=="Done") 
                                      {
                                        echo '#FFFFFF; color:#C0C0C0;';
                                      }
                                      else
                                      {
                                        echo '#f2b0f1; color:#000000;';
                                      }
                                   }
                                   else
                                   {
                                      echo '#aff7c2';
                                   }
                              } 
                              else if(date($y."-".$m."-".$day)==date("Y-m-d")){echo '#abd8f4';}
//                                 array_search(date($y."-".$m."-".$day), array_column($array, 'i'));
                               else if (in_array(date($y."-".$m."-".$day), array_column($array, 'i'))) 
                                 {
                                  
                                   $ind = array_search(date($y."-".$m."-".$day), array_column($array, 'i'));
                                   if($array[$ind]['priority']=="Low")
                                   {
                                    
                                      if ($array[$ind]['Status']=="Done") 
                                      {
                                        echo '#FFFFFF; color:#C0C0C0;';
                                      }
                                      else
                                      {
                                        echo '#ffe9ba; color:#000000;';
                                      }
                                   }
                                   else if($array[$ind]['priority']=="High")
                                   {
                                    
                                      if ($array[$ind]['Status']=="Done") 
                                      {
                                        echo '#FFFFFF; color:#C0C0C0;';
                                      }
                                      else
                                      {
                                        echo '#ff9d99; color:#000000;';
                                      }
                                   }
                                   else if($array[$ind]['priority']=="KMedium")
                                   {
                                    if ($array[$ind]['Status']=="Done") 
                                    {
                                      echo '#FFFFFF; color:#C0C0C0;';
                                    }
                                    else
                                    {
                                      echo '#f2b0f1; color:#000000;';
                                    }
                                   }
                                 }
                                 
                                else
                                {
                                  
                                  if (date("w",strtotime(date($y."-".$m."-".$day)))==0) 
                                  {
                                    echo '#aff7c2';
                                  }
                                  else
                                  {
                                    echo '#FFFFFF';
                                  }
                                }                                
                                ?>;">
                                <?php
                                 // $lday=sprintf('%02d',$day);
                                echo $day;
                                $ind = array_search(date($y."-".$m."-".$day), array_column($array, 'i'));
                                 if($day>0 && in_array(date($y."-".$m."-".$day), array_column($array, 'i')))
                                 {
                                  if ($array[$ind]['Status']=="Done") 
                                    {
                                      echo "<a href='calendar.php?id=".$array[$ind]['rem_id']."'>";
                                      // $result = substr($array[$ind]['description'], 0, 5);
                                      echo "<br><b style='color:#C0C0C0'>&nbsp;&nbsp;&nbsp;Title: ".$array[$ind]['title']."</b>";
                                      echo "<br><b style='color:#C0C0C0'>&nbsp;&nbsp;&nbsp;Desc: ".substr($array[$ind]['description'], 0, 5)."</b>";
                                      echo "</a>";
                                    }
                                    else
                                    {
                                      echo "<a href='calendar.php?id=".$array[$ind]['rem_id']."'>";
                                      // $result = substr($array[$ind]['description'], 0, 5);
                                      echo "<br><b>&nbsp;&nbsp;&nbsp;Title: ".$array[$ind]['title']."</b>";
                                      echo "<br><b>&nbsp;&nbsp;&nbsp;Desc: ".substr($array[$ind]['description'], 0, 5)."</b>";
                                      echo "</a>";
                                    }
                                    
                                 }
                                 else
                                 {
                                      echo '';
                                 }
                                
                                ?>
                              </td> 

                        <?php 
                        if($FDay == '7'){echo '</tr><tr>'; $FDay='0'; $weeks++;} $day++; $day=sprintf('%02d',$day); $FDay++; 
                        } //While-Close ?>
                            
                        <?php $dim=$weeks*7; $lastdays=$dim-($days+$pwkDay); $lc=1; 
                              while($lc<=$lastdays){ ?><td class="day">&nbsp;</td><?php $lc++; } ?>
                        </tr>

                          </table>
                           </span>
                          </td>
                         </tr>
                        </table>
                        <!-- /. calenderrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr -->

              </div>
            </div><!-- /.box-body -->
          </div><!-- /. box -->
        </div><!-- /.col-2 col-2 col-2 Close  -->
    
        <!-- /.col-1 col-1 col-1 Open  -->
          <div class="col-lg-3 col-md-12">
            <div class="box box-solid">
              <div class="box-header with-border"><h4 class="box-title">Events</h4></div>
              <div class="box-body">
              <!-- the events -->
              <div id="external-events" >
                <div class="external-event text-aqua dot-outline" data-class="bg-aqua"><i class="fa fa-hand-o-right"></i>Today</div>      
                <div class="external-event text-green dot-outline" data-class="bg-green"><i class="fa fa-hand-o-right"></i>Sunday</div>
                <div class="external-event text-red dot-outline" data-class="bg-red"><i class="fa fa-hand-o-right"></i>High Priority</div>
                <div class="external-event text-purple dot-outline" data-class="bg-purple"><i class="fa fa-hand-o-right"></i>Medium Priority</div>
                <div class="external-event text-yellow dot-outline" data-class="bg-yellow"><i class="fa fa-hand-o-right"></i>Low Priority</div>
              </div>
              <!-- <div class="event-fc-bt"><a data-toggle="modal" role="dialog" data-target="#add-new-events" class="btn btn-lg btn-orange btn-block margin-top-10"><i class="ti-plus"></i> Add New Reminder</a></div> -->
              </div><!-- /.box-body -->
            </div><!-- /. box -->
          </div>
        <!-- /.col-1 col-1 col-1 Close  -->
      </div><!-- /.row Close  -->     
  </section>
    <!-- Main content Close -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <?php include("footer.php"); ?>
  </footer>
  
  <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
  
</div>
<!-- ./wrapper -->
    
<script src="assets/vendor_components/jquery/dist/jquery.js"></script>
<script src="assets/vendor_components/popper/dist/popper.min.js"></script>
<script src="assets/vendor_components/bootstrap/dist/js/bootstrap.js"></script> 
<script src="assets/vendor_components/select2/dist/js/select2.full.js"></script>
<script src="js/pages/advanced-form-element.js"></script> 
<!-- <script src="assets/vendor_components/jquery-slimscroll/jquery.slimscroll.js"></script> -->
<!-- <script src="assets/vendor_components/fastclick/lib/fastclick.js"></script> -->
<script src="js/template.js"></script>
<!-- <script src="assets/vendor_components/moment/moment.js"></script> -->
<script type="text/javascript" language="javascript">
function FunMonth(v,m,y)
{
 $.post("getajax.php",{action:'getcalendar',v:v,m:m,y:y}, function(data){
 $("#SpanCalendar").html(data); });
}
</script>

</body>
</html>



<!-- Modal Add Category -->
<form action="add_reminder_from_calendar_page.php" method="post" onsubmit="ShowLoading()">
<div class="modal fade none-border" id="add-new-events">
 <div class="modal-dialog">
  <div class="modal-content">
   
   <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  <h4 class="modal-title"><strong>Add</strong> Reminder</h4>
   </div>
   
   <div class="modal-body">
   

   <div class="form-group row">
      <label for="example-email-input" class="col-sm-4 col-form-label">Reminder Type <label style="color: red">*</label></label>
      <div class="col-sm-8">
        <div class="radio" style="display: inline;">
          <input name="r_type" type="radio" id="Personal" value="Personal" checked="" class="radio-col-yellow">
          <label for="Personal">Personal</label>                    
        </div>
        <div class="radio" style="display: inline;">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="r_type" type="radio" id="Public" value="Public" class="radio-col-yellow">
        <label for="Public">Public</label>   
        </div>
      </div>
    </div> 

    <div class="form-group row">
          <label for="example-text-input" class="col-sm-4 col-form-label">Title <label style="color: red">*</label></label>
          <div class="col-sm-8">
          <input class="form-control" type="text" placeholder="Enter title" id="title" name="title" autocomplete="off" required>
          </div>
        </div>

        <div class="form-group row">
          <label for="example-search-input" class="col-sm-4 col-form-label">Description <label style="color: red">*</label></label>
          <div class="col-sm-8">
          <input class="form-control" type="search" placeholder="Enter Description" id="desc" name="desc" autocomplete="off" required>
          </div>
        </div>

        <div class="form-group row">
          <label for="example-search-input" class="col-sm-4 col-form-label">Location <label style="color: red">*</label></label>
          <div class="col-sm-8">
          <input class="form-control" type="search" placeholder="Enter Location" id="location" name="location" autocomplete="off" required>
          </div>
        </div>

        <div class="form-group row">
          <label for="example-datetime-local-input" class="col-sm-4 col-form-label">From Date <label style="color: red">*</label></label>
          <div class="col-sm-8">
          <input class="form-control" name="from_date" id="from_date" autocomplete="off" required placeholder="Reminder Start Date">
          </div>
        </div>

        <div class="form-group row">
          <label for="example-datetime-local-input" class="col-sm-4 col-form-label">End Date <label style="color: red">*</label></label>
          <div class="col-sm-8">
          <input class="form-control" name="to_date" id="to_date" autocomplete="off" required placeholder="Reminder End Date" onchange="picker1()"> 
          </div>
        </div>


        <button style="display: none;" class="btn btn-primary sweet-1" onclick="_gaq.push(['_trackEvent', 'example', 'try', 'sweet-1']);">Try It</button>
        <script type="text/javascript">
          function picker1()
          {
              var date_ini = $('#from_date').val();
              var date_end = $('#to_date').val();
              if (date_ini > date_end) 
              {
                  swal({
                    title: "Warning..!",
                    text: "Invalid To Date! Please select To date greater than From Date",
                    type: "warning"
                  });
                  $('#to_date').val('');
                  return false;
              }

          }
          function picker11()
          {
              var date_ini = $('#from_date').val();
              var start_date = $('#start_date').val();
              if (date_ini < start_date) 
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
          <label for="example-email-input" class="col-sm-4 col-form-label">Reminder Require<label style="color: red">*</label></label>
          <div class="col-sm-8">
            <div class="radio" style="display: inline;">
              <input name="r_require" type="radio" id="Yes" value="1" class="radio-col-yellow" onclick="show1()">
              <label for="Yes">Yes</label>                    
            </div>
            <div class="radio" style="display: inline;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="r_require" type="radio" id="No" value="0" class="radio-col-yellow" onclick="show2()">
            <label for="No">No</label>   
            </div>
          </div>
        </div>

        <div id="rr" style="display: none;">
        <div class="form-group row">
          <label for="example-datetime-local-input" class="col-sm-4 col-form-label">Start Date<label style="color: red">*</label></label>
          <div class="col-sm-8">
          <input class="form-control" name="start_date" id="start_date" autocomplete="off" placeholder="Reminder Alert Start Date" onchange="picker11()">
          </div>
        </div>

        <div class="form-group row">
          <label for="example-datetime-local-input" class="col-sm-4 col-form-label">Time Periods<label style="color: red">*</label></label>
          <div class="col-sm-8">
            <select class="form-control select2" style="width: 100%;" name="period">
              <option value="">Select</option>
              <option value="24">Onces a day</option>
              <option value="12" >Twice a Day</option>
            </select>
          </div>
        </div>
        </div>

        <div class="form-group row">
          <label for="example-email-input" class="col-sm-4 col-form-label">Reminder Priority <label style="color: red">*</label></label>
          <div class="col-sm-8">
            <div class="radio" style="display: inline;">
              <input name="r_priority" type="radio" id="Low" value="Low" class="radio-col-yellow">
              <label for="Low">Low</label>                    
            </div>
            <div class="radio" style="display: inline;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="r_priority" type="radio" id="Medium" value="KMedium" class="radio-col-yellow">
            <label for="Medium">Medium</label>   
            </div>
            <div class="radio" style="display: inline;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="r_priority" type="radio" id="High" value="High" class="radio-col-yellow">
            <label for="High">High</label>   
            </div>
          </div>
        </div>


        <div class="form-group row" id="gp" style="display: none;">
          <label for="example-tel-input" class="col-sm-4 col-form-label">Select Groups <label style="color: red">*</label></label>
          <div class="col-sm-6 col-lg-6">
            <select id="grp" class="form-control select2" data-placeholder="Choose Groups" style="width: 100%" name="grp[]">
            <?php
              $sql = "SELECT * FROM group_table";
              $result = mysql_query($sql,$conn);
              if (mysql_num_rows($result) > 0)
              {
                while ($row = mysql_fetch_assoc($result)) 
                {
                  $gname = $row['gname'];
                  $gid = $row['gid'];
                  ?>
                  <option value="<?= $gid ?>"><?= $gname ?></option>';
               <?php }
              }
            ?>
            </select>
          </div>
          <div class="col-sm-2 col-lg-2">
          <button onclick="group()" type="button" class="btn btn-lg btn-default text-left"><i class="fa fa-plus" ></i> Add </button>
          </div>
        </div>

        <script type="text/javascript">
          var chech_array = ["AAA", "BBB"];


          function group()
          {
            var aa = $('#grp').val();
            aa = aa.toString();
            var lastIndex = aa.lastIndexOf(",");
            var s1 = aa.substring(0, lastIndex); //after this s1="Text1, Text2, Text"
            var s2 = aa.substring(lastIndex + 1); //after this s2="true"

              var q = $('#part').val();
              
              if (q=="") 
              {
                q=0;
              }
              q=q.toString();
              // alert(q);

              $.post("getajax.php",{action:'contact_group',gid:s2, user:q}, function(data){
              $("#part").append(data);
              // alert(data);

  });
          }
        </script>

        <!--  -->

        <div class="form-group row" id="par" style="display: none;">
        <!-- <div class="form-group row" id="par"> -->
          <label for="example-tel-input" class="col-sm-4 col-form-label">Participants <label style="color: red">*</label></label>
          <div class="col-sm-8">
            <select id="part" class="form-control select2" multiple="multiple" data-placeholder="Choose Users" style="width: 100%" name="par[]" >
            <?php
              $sql = "SELECT * FROM user WHERE user_varified='Yes' ";
              $result = mysql_query($sql,$conn);
              if (mysql_num_rows($result) > 0)
              {
                while ($row = mysql_fetch_assoc($result)) 
                {
                  $uid = $row['userid'];
                  $fname = $row['ufname']; 
                  $lname = $row['ulname']; ?>
                  <option value="<?= $uid ?>"><?= $fname ?> <?= $lname ?></option>';
               <?php }
              }
            ?>
            </select>
          </div>
        </div>

        <div id="field">
          <div id="field0">
            <div class="form-group row">
              <label  for="example-search-input" class="col-sm-4 col-form-label">Add Task</label>
              <div class="col-md-8">
                <input id="action_id" name="action_id[]" type="text" placeholder="enter task here" class="form-control input-md">
              </div>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-4">
            <button type="button" id="add-more" name="add-more" class="btn btn-primary">Add Sub Task</button>
          </div>
        </div>


<script type="text/javascript">
  $(document).ready(function () 
  {
    var next = 0;
    $("#add-more").click(function(e)
    {
      e.preventDefault();
      var addto = "#field" + next;
      var addRemove = "#field" + (next);
      next = next + 1;
      var newIn = 
      ' <div id="field'+ next +'" name="field'+ next +'"><div class="form-group row"><div class="col-md-12"> <input id="action_id" name="action_id[]" type="text" placeholder="enter sub task here" class="form-control input-md"> </div></div></div>';
      var newInput = $(newIn);
      var removeBtn = '<button id="remove' + (next - 1) + '" class="btn btn-danger remove-me col-md-1">X</button></div><div id="field">';
      var removeButton = $(removeBtn);
      $(addto).after(newInput);
      $(addRemove).after(removeButton);
      $("#field" + next).attr('data-source',$(addto).attr('data-source'));
      $("#count").val(next);  

      $('.remove-me').click(function(e)
      {
        e.preventDefault();
        var fieldNum = this.id.charAt(this.id.length-1);
        var fieldID = "#field" + fieldNum;
        $(this).remove();
        $(fieldID).remove();
      });
    });

  }); 
</script>

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
        <form class="form-horizontal form-element col-12" action="update_reminder.php" method="post" onsubmit="ShowLoading()">


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
                if ($Status=='Pending' && $created_by==$_SESSION['id']) 
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

          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Priority</label>
            <div class="col-sm-9">
              <?php
              if ($Status=='Pending' && $created_by==$_SESSION['id']) 
              { ?>
                  <select class="form-control" name="priority" disabled id="user_prior">
                    <option value="Low" <?php if($priority=="Low"){echo "selected";} ?>>Low</option>
                    <option value="KMedium" <?php if($priority=="KMedium"){echo "selected";} ?>>Medium</option>
                    <option value="High" <?php if($priority=="High"){echo "selected";} ?>>High</option>
                  </select>
             <?php }
             else
             { ?>
                <input type="text" class="form-control" disabled value="<?php echo $priority; ?>">
            <?php }
              ?>
              
            </div>
          </div>


          <input type="hidden" class="form-control" name="hidden_start_date" value="<?php echo $start_date  ?>">
          <input type="hidden" class="form-control" name="hidden_from_date" value="<?php echo $from_date  ?>">
          <input type="hidden" class="form-control" name="hidden_end_date" value="<?php echo $to_date  ?>">
          <input type="hidden" class="form-control" name="page_name" value="calendar">

          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">From Date </label>
            <div class="col-sm-9">
              
              <?php
                if ($Status=='Pending' && $created_by==$uu && $from_date>=date('d-m-Y') ) 
                { ?>
                  <input disabled onchange="picker()" type="text" class="form-control" name="f_date" id="f_date" value="<?php echo $from_date  ?>">
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
                  <input disabled onchange="picker()" type="text" class="form-control disabled" name="t_date" id="t_date" value="<?php echo $to_date  ?>">
               <?php }
                else
                { ?>
                    <input type="text" class="form-control" disabled value="<?php echo $to_date  ?>">
               <?php }
              ?>
            </div>
          </div>


          <button style="display: none;" class="btn btn-primary sweet-1" onclick="_gaq.push(['_trackEvent', 'example', 'try', 'sweet-1']);">Try It</button>
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
              var start_date = $('#start_date2').val();
              if (date_ini <= start_date) 
              {
                  swal({
                    title: "Warning..!",
                    text: "Invalid Start Date! Please select Start Date Less than From Date",
                    type: "warning"
                  });
                  $('#start_date2').val('');
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
                      <input onchange="picker2()" disabled type="text" class="form-control" name="start_date5" id="start_date2" value="<?=$start_date?>">
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
            <label for="inputName" class="col-sm-3 control-label">Overall Task Status </label>
            <div class="col-sm-9">
              <input type="text" class="form-control" disabled value="<?php echo $Status ;  ?>">

            </div>
          </div>


          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label"><b>My Task Status</b></label>
            <div class="col-sm-9">

              <?php
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
            <label for="inputName" class="col-sm-3 control-label">Participants </label>
            <div class="col-sm-9">
              <select class="form-control select2" multiple="multiple" data-placeholder="Choose Participants" style="width: 100%" name="parti[]" disabled id="usr_parti">
            <?php
              $sql = "SELECT * FROM reminder_participants rp INNER JOIN reminder r ON rp.rem_id = r.rem_id INNER JOIN user u ON rp.userid = u.userid WHERE r.rem_id =".$_REQUEST['id'];
              $result = mysql_query($sql,$conn);
              if (mysql_num_rows($result) > 0)
              {
                while ($row = mysql_fetch_assoc($result)) 
                {
                  $fname = $row['ufname']; 
                  $lname = $row['ulname']; 
                  echo '<option value="'.$uid.'" selected>'."&nbsp;&nbsp;".$fname.' '.$lname.'</option>';
                }
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
                <span class="description">Shared publicly - <?= $created_at ?></span>
              </div>
              <!-- /.user-block -->
              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
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
                <h6>No Comments Yet</h6>
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
          window.location="delete_reminder1.php?page=calendar&rem_id="+id;
             
        });
        }  
      </script>
      
      <div class="modal-footer">
        <hr>
        <?php
          if ($Status=='Pending' && $created_by==$_SESSION['id']) 
          {
            $i= $_REQUEST['id']; ?>
            <!-- <button type='submit' class='btn btn-info waves-effect text-right'>Update Reminder</button> -->

            <button type='button' class='btn btn-info waves-effect text-right' id="show_save_button">Edit Reminder</button>
            <button style="display: none;" type='submit' class='btn btn-info waves-effect text-right' id="save_button">Save Reminder</button>


            <a href="#" onclick="discard_reminder(<?= $_REQUEST['id']; ?>)" class='btn btn-warning waves-effect text-right'>Discard reminder</a>
       <?php   }
        ?>
        
        <?php
          $sql = "SELECT * FROM reminder_participants WHERE rem_id =".$_REQUEST['id']." AND userid='$sid' ";
          $result = mysql_query($sql,$conn);
          if (mysql_num_rows($result) > 0)
          {
            $row = mysql_fetch_assoc($result);
            if ($row['status']==0) 
            { ?>
                <a href="calendar.php?rem_id=<?=$_REQUEST['id']?>&userid=<?=$sid?>" class="btn btn-info waves-effect text-right">Update My status</a>
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
<script type="text/javascript">
  $("input[name='r_type']:radio")
    .change(function() 
    {
      $("#par").toggle($(this).val() == "Public");
    });

  $("input[name='r_type']:radio").change(function() 
    {
        $("#gp").toggle($(this).val() == "Public");
    });


</script>

<!--   date time picker -->
  <script src="js/jquery.datetimepicker.full.min.js"></script>
  <script type="text/javascript">

    $(function () {
      $('#from_date').datetimepicker({ minDate: new Date() }); 
    });

    $(function () {
      $('#to_date').datetimepicker({ minDate: new Date() }); 
    });

    $(function () {
      $('#start_date').datetimepicker({ minDate: new Date() }); 
    });

    $(function () {
      $('#f_date').datetimepicker({ minDate: new Date() }); 
    });

    $(function () {
      $('#t_date').datetimepicker({ minDate: new Date() }); 
    });

    $(function () {
      $('#start_date2').datetimepicker({ minDate: new Date() }); 
    });

    jQuery('#from_date').datetimepicker({
      startDate:'+1971/05/01',
      format:'d.m.Y H:i'
    });

    jQuery('#to_date').datetimepicker({
      startDate:'+1971/05/01',
      format:'d.m.Y H:i'
    });

    jQuery('#start_date').datetimepicker({
      startDate:'+1971/05/01',
      format:'d.m.Y H:i'
    });

    jQuery('#f_date').datetimepicker({
      startDate:'+1971/05/01',
      format:'d.m.Y H:i'
    });

    jQuery('#t_date').datetimepicker({
      startDate:'+1971/05/01',
      format:'d.m.Y H:i'
    });

    jQuery('#start_date2').datetimepicker({
      startDate:'+1971/05/01',
      format:'d.m.Y H:i'
    });
  </script>
<!--   date time picker -->

   <!-- dfsbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb -->
<button class="tst3 btn btn-success" style="display: none;"></button>
<button class="tst4 btn btn-danger" style="display: none;"></button>
<?php
if (isset($_GET['reminder']) && $_GET['reminder'] == "success")
{ ?>

  <script type="text/javascript">

    $(document).ready(function () {
      $.toast({
          heading: 'Reminder Added Successfully',
          text: 'you can see added reminder on calendar',
          position: 'top-right',
          loaderBg: '#ff6849',
          icon: 'success',
          hideAfter: 3500,
          stack: 6
      });

  });
  </script>

<?php }
else if(isset($_GET['reminder']) && $_GET['reminder'] == "fail")
{ ?>
    
  <script type="text/javascript">
   $(document).ready(function () {
        $.toast({
            heading: 'Reminder fail',
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

else if (isset($_GET['status']) && $_GET['status'] == "success")
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

else if(isset($_GET['status']) && $_GET['status'] == "fail")
{ ?>
    
  <script type="text/javascript">
   $(document).ready(function () {
        $.toast({
            heading: 'Status Updation fail',
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

<!-- for show hide start date and time period based on rem_req -->
<script type="text/javascript">
  function show1(){document.getElementById('rr').style.display = 'block'; }
function show2(){document.getElementById('rr').style.display ='none';}
</script>
<!-- for show hide start date and time period based on rem_req -->






<!-- Modal change task status for particular user -->
<a data-toggle="modal" data-target=".update_task_status" id="aaa" style="display: none;"> update task</a>
<form action="update_user_status.php" method="post" onsubmit="ShowLoading()">
<div class="modal fade none-border update_task_status" id="update_task_status">
 <div class="modal-dialog">
  <div class="modal-content">
   
   <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  <h4 class="modal-title"><strong>Update task Reminder</strong> </h4>
   </div>
   
   <div class="modal-body">

    <?php
      $sql = "SELECT * FROM reminder r INNER JOIN reminder_participants rp ON r.rem_id=rp.rem_id WHERE rp.userid=".$sid." AND r.rem_id = ".$_REQUEST['rem_id'];
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
            <input type="hidden" name="page_name" value="calendar">
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
         $('#start_date2').removeAttr("disabled");
         $('#user_tp').removeAttr("disabled");
         $('#user_desc').focus();
    });
});
</script>