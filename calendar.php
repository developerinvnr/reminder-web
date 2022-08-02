<?php include('common_function.php'); ?>
<?php
    session_start();
    if (!isset($_SESSION['id']))
    {
        header('Location: index.php');
    }    
    include "config.php";
    $sid = $_SESSION['id'];
    $uu = $_SESSION['id'];
    if (isset($_POST['rate_n_close']) && $_POST['rate_n_close']!="" ) 
    {
      $update = "UPDATE reminder SET activity='D' WHERE rem_id='".$_POST['close_rem_id']."' ";
      $rrr = mysql_query($update,$conn);
      if ($rrr) 
      {
        echo "<script>window.location='reports.php?rem_delete=success';</script>";
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




function getColor($status,$priority){
  
     if($priority=="Low"){
        if ($status=="Done"){
          echo '#FFFFFF; color:#C0C0C0;';
        }else{
          echo '#ffe9ba; color:#000000;';
        }
     }else if($priority=="High"){
        if($status=="Done"){
          echo '#FFFFFF; color:green;border:1px solid green;';
        }else{
          echo '#D91E18; color:#fff;';
        }
     }else if($priority=="KMedium"){
        if($status=="Done"){
          echo '#FFFFFF; color:#C0C0C0;';
        }else{
          echo '#ff9f5b; color:#000;';
        }
     }else{ echo '#aff7c2'; }

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


    <section class="content" >
   
     
   
   <div class="row" >
      <div class="col-5">
        <a data-toggle="modal" role="dialog" data-target="#add-new-events" class="btn btn-lg btn-orange btn-block margin-top-10" style="color:white;font-weight: bold;"><i class="fa fa-plus" aria-hidden="true"></i> Add New Reminder</a>
      </div>

      <div class="col-lg-9 col-md-12">
          <div class="box box-primary">
            <div class="box-body no-padding table-responsive">
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
                                <td class="monthday" colspan="2"><span onClick="FunMonth('P',<?php echo $m.','.$y;?>)"><u class="btn btn-secondary"  style="font-weight: bold !important;"><< Prev</u> </span></td>
                                <td class="monthday" colspan="3" id="calMonth"><?php echo date("F Y"); ?></td>
                                <td class="monthday" colspan="2"><span onClick="FunMonth('N',<?php echo $m.','.$y;?>)">  <u class="btn btn-secondary" style="font-weight: bold !important;">Next >></u></span></td>
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

                              <td class="day" 

                                <?php if(date($y."-".$m."-".$day)==date("Y-m-d")){?> style="background-color: #abd8f4;"<?php } ?> 
                              >
                                <?php
                                 
                                echo '<b style="font-size:14px;font-weight:bold;color:#2E3131;">'.$day.'</b>';

                                $allRemDates=array_column($array, 'i');

                                $thisTdDate=date($y."-".$m."-".$day);

                                $thisTDRems = array();


                                foreach ($allRemDates as $key => $value) {
                                  if($allRemDates[$key]==$thisTdDate){
                                    $thisTDRems[$key]=$value;
                                  }
                                }



                                foreach ($thisTDRems as $key => $value) {
                                  
                                      echo "
                                      <a href='javascript:void(0)' onclick='showmodel(".$array[$key]['rem_id'].")'>";
                                          echo '
                                          <div 
                                            style="font-family: Calibri;font-size:11px;padding:1px;border-radius:4px;border:1px solid #c1c1c1; margin-bottom:4px;background-color:';
                                            echo getColor($array[$key]['Status'],$array[$key]['priority']); 
                                            echo ';"
                                          >';
                                          
                                              if ($array[$key]['Status']=="Done"){
                                                ?>
                                                <i class="fa fa-check-circle" aria-hidden="true" style="color:green;font-size:14px;"></i>
                                                <?php
                                              }
                                              echo "<b>".$array[$key]['title']."</b>";
                                          
                                          echo "
                                          </div>";
                                      echo "
                                      </a>";
                                    
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
                <div class="external-event dot-outline" data-class="bg-aqua" style="background-color:#abd8f4 !important; "><i class="fa fa-hand-o-right"></i>Today</div>   

                <!-- <div class="external-event text-green dot-outline" data-class="bg-green"><i class="fa fa-hand-o-right"></i>Sunday</div> -->

                <div class="external-event bg-red dot-outline" data-class="bg-red"><i class="fa fa-hand-o-right"></i>High Priority</div>
                <div class="external-event  dot-outline" data-class="bg-purple" style="background-color:#ff9f5b !important; "><i class="fa fa-hand-o-right"></i>Medium Priority</div>
                <div class="external-event dot-outline" data-class="bg-yellow" style="background-color:#ffe9ba !important; "><i class="fa fa-hand-o-right"></i>Low Priority</div>

                <div class="external-event dot-outline" data-class="bg-yellow" style="border:2px solid green;color:green;"><i class="fa fa-check-circle" aria-hidden="true" style="color: green;font-size: 16px;"></i>Done</div>
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

  var img = document.createElement('img');
        img.src = 'loader.gif';

        $("#calMonth").html(img);

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

<span id="showModalSpan">
  



</span>

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

<!-- for show hide start date and time period based on rem_req -->
<script type="text/javascript">
  function show3(){document.getElementById('more_detail').style.display = 'block'; }
function show4(){document.getElementById('more_detail').style.display ='none';}
</script>
<!-- for show hide start date and time period based on rem_req -->


<!-- Trigger the modal with a button -->
<button id="close" type="button" style="display: none;"  data-toggle="modal" data-target="#a"></button>

<!-- Modal -->
<div id="a" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form action="calendar.php" method="post">
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
  function showmodel(remid){

    $.post("modalAjax.php",{action:'showmodal',id:remid}, function(data){
      $("#showModalSpan").html(data); 
      document.getElementById('modal_view').click();
    });

  }
</script>