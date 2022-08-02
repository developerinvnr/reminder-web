<?php include('common_function.php'); ?>
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
<title><?php include("tital.php"); ?></title>
<link rel="stylesheet" href="assets/vendor_components/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/vendor_components/bootstrap/dist/css/bootstrap-extend.css">
<link rel="stylesheet" href="assets/vendor_components/font-awesome/css/font-awesome.min.css">
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
    <section class="content-header" style="margin-top: -20px">
      <ol class="breadcrumb">
        <span class="pull-left"><li class="breadcrumb-item"><a href=""> < Back </a></li></span>
        <span class="pull-right">
        <li class="breadcrumb-item"><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
        <li class="breadcrumb-item active">Add Reminder</li>
        </span>
      </ol>
    </section>

<section class="content" style="margin-top: -15px">
      <div class="box box-default">
        <div class="box-body">
          <div class="row">
            <div class="col-12">
      <form id="formn" name="formn" name="reminder" action="public_reminder_logic.php" method="post" onsubmit="return valid(this)">
        
        <div class="form-group row" style="margin-top: -10px;">
          <label for="example-email-input" class="col-2 col-form-label">Type</label>
          <div class="col-10">
            <div class="radio" style="display: inline;">
              <input name="r_type" type="radio" id="Personal" value="Personal"  class="radio-col-yellow">
              <label for="Personal">Personal</label>                    
            </div>
            <div class="radio" style="display: inline;">
            &nbsp;&nbsp;&nbsp;<input name="r_type" type="radio" id="Public" value="Public" class="radio-col-yellow" checked>
            <label for="Public">Public</label>   
            </div>
          </div>
        </div>  

        <div class="form-group row" style="margin-top: -15px;">
				  <label for="example-text-input" class="col-2 col-form-label">Title<span style="color: red">*</span></label>
				  <div class="col-10">
					<input class="form-control" type="text" placeholder="Enter title" id="title" name="title" autocomplete="off" required autofocus>
				  </div>
				</div>

      <!-- <div class="container-fluid"> -->
        <!-- <div class="row">
          <div class="col-2">Title<label style="color: red">*</label></div>
          <div class="col-10">
            <input class="form-control" type="text" id="title" name="title" autocomplete="off" required autofocus>
          </div>
        </div> -->
        <!-- </div> -->
        
        <!-- <div class="row">
          <div class="col-2">Desc<label style="color: red">*</label></div>
          <div class="col-10">
            <input class="form-control" type="search" placeholder="Enter Description" id="desc" name="desc" autocomplete="off" required>
          </div>
        </div> -->


				<div class="form-group row" style="margin-top: -10px;">
				  <label for="example-search-input" class="col-2 col-form-label">Desc<span style="color: red">*</span></label>
				  <div class="col-10">
					<input class="form-control" type="search" placeholder="Enter Description" id="desc" name="desc" autocomplete="off" required>
				  </div>
				</div>


        <div class="form-group row" style="margin-top: -10px;">
          <label for="example-datetime-local-input" class="col-2 col-form-label">From<span style="color: red">*</span></label>
          <div class="col-10">
          <input class="form-control" name="from_date" id="from_date" autocomplete="off" required placeholder="From" value="<?=date('d.m.Y H:i:s')?>">
          </div>
        <!-- </div> -->

        <!-- <div class="form-group row" style="margin-top: -10px;"> -->
          <!-- <label for="example-datetime-local-input" class="col-2 col-form-label">To</label> -->
          <!-- <div class="col-4">
          <input type="text" class="form-control" name="to_date" id="to_date" autocomplete="off" required placeholder="To">
          </div> -->
        </div>


        <div class="form-group row" style="margin-top: -10px;">
          <label for="example-datetime-local-input" class="col-2 col-form-label">To<span style="color: red">*</span></label>
          <!-- <div class="col-4">
          <input class="form-control" name="from_date" id="from_date" autocomplete="off" required placeholder="From">
          </div> -->
        <!-- </div> -->

        <!-- <div class="form-group row" style="margin-top: -10px;"> -->
          <!-- <label for="example-datetime-local-input" class="col-2 col-form-label">To</label> -->
          <div class="col-10">
          <input type="text" class="form-control" name="to_date" id="to_date" autocomplete="off" required placeholder="To" value="<?=date('d.m.Y H:i:s', strtotime("+5 minutes"))?>">
          </div>
        </div>







      <div class="form-group row" id="gp" >
          <label for="example-tel-input" class="col-2 col-form-label">Group<span style="color: red">*</span></label>
          <div class="col-10">
            <select id="grp" class="form-control select2" data-placeholder="Choose Group" style="width: 100%" name="grp[]" onchange="group()">
              <option value="">Choose</option>
            <?php
              $sql = "SELECT * FROM group_table WHERE created_by=".$_SESSION['id'];
              $result = mysql_query($sql,$conn);
              if (mysql_num_rows($result) > 0)
              {
                while ($row = mysql_fetch_assoc($result)) 
                {
                  $gname = $row['gname'];
                  $gid = $row['gid'];
                  ?>
                  <option value="<?= $gid ?>"><?= $gname ?></option>
               <?php }
              }
            ?>
            </select>
          </div>
          <!-- <div class="col-sm-1 col-lg-1">
          <button onclick="group()" type="button" class="btn btn-lg btn-default text-left"><i class="fa fa-plus" ></i> Add </button>
          </div> -->
        </div>

        <script type="text/javascript">
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

        <div class="form-group row" id="par"  style="margin-top: -10px;">
        <!-- <div class="form-group row" id="par"> -->
          <label for="example-tel-input" class="col-2 col-form-label">Users<span style="color: red">*</span></label>
          <div class="col-10">
            <select id="part" class="form-control select2" multiple="multiple" data-placeholder="Choose Users" style="width: 100%" name="par[]" >
            <?php
              // $sql = "SELECT * FROM user WHERE user_varified='Yes' ";
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
                echo '<option value="'.$_SESSION['id'].'">'."&nbsp;&nbsp;".get_name($_SESSION['id']).'</option>';
                while ($row = mysql_fetch_assoc($result)) 
                {
                  if(get_user_type($_SESSION['id'])=='A')
                  {
                      $uid = $row['userid'];
                      $fname = $row['ufname']; 
                      $lname = $row['ulname']; 
                      echo '<option value="'.$uid.'">'."&nbsp;&nbsp;".$fname.' '.$lname.'</option>';
                  }
                  else
                  {
                      if ($row['request_by']==$_SESSION['id']) 
                      {
                        echo '<option value="'.$row['request_to'].'">'."&nbsp;&nbsp;".get_name($row['request_to']).'</option>';
                      }
                      else
                      {
                          echo '<option value="'.$row['request_by'].'">'."&nbsp;&nbsp;".get_name($row['request_by']).'</option>';
                      }
                  }
                }
              }
            ?>
            </select>
          </div>
        </div>

  
<script type="text/javascript">
  function show3(){document.getElementById('aaa').style.display = 'block'; }
function show4(){document.getElementById('aaa').style.display ='none';}
</script>

        <div class="form-group row" style="margin-top: -10px;">
          <label for="example-email-input" class="col-5 col-form-label">More Options</label>
          <div class="col-7">
            <div class="radio" style="display: inline;">
              <input name="r_require" type="radio" id="Yes" value="1" class="radio-col-yellow" onclick="show3()" checked>
              <label for="Yes">Yes</label>                    
            </div>
            <div class="radio" style="display: inline;">
            &nbsp;<input name="r_require" type="radio" id="No" value="0" class="radio-col-yellow" onclick="show4()" checked>
            <label for="No">No</label>   
            </div>
          </div>
        </div>


<div id="aaa" style="display: none;">

        
        <button style="display: none;" class="btn btn-primary sweet-1" onclick="_gaq.push(['_trackEvent', 'example', 'try', 'sweet-1']);">Try It</button>

				<div class="form-group row" style="margin-top: -10px;">
				  <label for="example-email-input" class="col-5 col-form-label">Reminder Require</label>
				  <div class="col-7">
            <div class="radio" style="display: inline;">
              <input name="q" type="radio" id="Yes11" value="1" class="radio-col-yellow" onclick="show1()" checked>
              <label for="Yes11">Yes</label>                    
            </div>
            <div class="radio" style="display: inline;">
            &nbsp;<input name="q" type="radio" id="No11" value="0" class="radio-col-yellow" onclick="show2()">
            <label for="No11">No</label>   
            </div>
				  </div>
				</div>

        <div id="rr">
        <div class="form-group row" style="margin-top: -10px;">
          <label for="example-datetime-local-input" class="col-2 col-form-label">Start Date</label>
          <div class="col-10">
          <input class="form-control" name="start_date" id="start_date" autocomplete="off" placeholder="Reminder Alert Start Date" value="<?=date('d.m.Y H:i:s', strtotime("+5 minutes"))?>">
          </div>
        </div>

        <div class="form-group row" style="margin-top: -10px;">
          <label for="example-datetime-local-input" class="col-2 col-form-label">Interval</label>
          <div class="col-10">
            <select class="form-control select2" style="width: 100%;" name="period">
              <option value="">Select</option>
              <option value="24">Onces a day</option>
              <option value="12" >Twice a Day</option>
              <option value="8" selected>thrice a Day</option>
            </select>
          </div>
        </div>
        </div>

        <div class="form-group row" style="margin-top: -15px;">
          <label for="example-email-input" class="col-2 col-form-label">Priority</label>
          <div class="col-10">
            <div class="radio" style="display: inline;">
              <input name="r_priority" type="radio" id="Low" value="Low" class="radio-col-yellow">
              <label for="Low">Low</label>                    
            </div>
            <div class="radio" style="display: inline;">
            <input name="r_priority" type="radio" id="Medium" value="KMedium" class="radio-col-yellow">
            <label for="Medium">Medium</label>   
            </div>
            <div class="radio" style="display: inline;">
            <input name="r_priority" checked type="radio" id="High" value="High" class="radio-col-yellow">
            <label for="High">High</label>   
            </div>
          </div>
        </div>

        

        

        <div class="form-group row" style="margin-top: -10px;">
          <label for="example-search-input" class="col-2 col-form-label">Location</label>
          <div class="col-10">
          <input class="form-control" type="search" placeholder="Enter Location" id="location" name="location" autocomplete="off">
          </div>
        </div>

        <div id="field" style="margin-top: -10px;">
          <div id="field0">
            <div class="form-group row">
              <label  for="example-search-input" class="col-2 col-form-label">Add Task</label>
              <div class="col-10">
                <input id="action_id" name="action_id[]" type="text" placeholder="enter task here" class="form-control input-md">
              </div>
            </div>
          </div>
        </div>
    
        <div class="form-group">
          <div class="col-md-4">
            <button id="add-more" name="add-more" class="btn btn-primary">Add Sub Task</button>
          </div>
        </div>

        </div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
      ' <div id="field'+ next +'" name="field'+ next +'"><div class="form-group row"><div class="col-12"> <input id="action_id" name="action_id[]" type="text" placeholder="enter sub task here" class="form-control input-md"> </div></div></div>';
      var newInput = $(newIn);
      var removeBtn = '<button id="remove' + (next - 1) + '" class="btn btn-danger remove-me col-5">Remove</button></div><div id="field">';
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

				  <script type="text/javascript">
              function aa()
              {
                  picker(); picker2();
              }    
          </script>
            </div><!-- /.col -->
          </div><!-- /.row -->
          <hr>
          <div class="row">
            <div class="col-lg-12 col-xs-12">
                <center>
                  <button type="submit" class="btn btn-primary load_button">Submit</button>
                  <button type="Reset" class="btn btn-warning"><a href="">Reset</a></button>
                  <a href="home.php" class="btn btn-danger">Cancel</a>
                </center>
            </div>
          </div>
          </form>
        </div><!-- /.box-body -->
      </div><!-- /.box -->  
    </section>
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

<!--   date time picker -->
  <script src="js/jquery.datetimepicker.full.min.js"></script>
  <script type="text/javascript">
  var d = new Date();
var strDate = d.getFullYear() + "/" + (d.getMonth()+1) + "/" + d.getDate();

    $(function () {
      $('#from_date').datetimepicker({ minDate: new Date() }); 
    });

    $(function () {
      $('#to_date').datetimepicker({ minDate: new Date() }); 
    });

    $(function () {
      $('#start_date').datetimepicker({ minDate: new Date() }); 
    });

    jQuery('#from_date').datetimepicker({
      format:'d.m.Y H:i:s',
      defaultDate : new Date()
    });

    jQuery('#to_date').datetimepicker({
      format:'d.m.Y H:i:s',
      defaultDate : new Date()
    });

    jQuery('#start_date').datetimepicker({
      format:'d.m.Y H:i:s'
    });
  </script>
<!--   date time picker -->

<script type="text/javascript">
  $("input[name='r_type']:radio").change(function() 
  {
      $("#par").toggle($(this).val() == "Public");
  });

  $("input[name='r_type']:radio").change(function() 
  {
      $("#gp").toggle($(this).val() == "Public");
  });



s


</script>



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
<link rel="stylesheet" type="text/css" href="assets\vendor_components\jquery-toast-plugin-master\src\jquery.toast.css">
<script src="assets\vendor_components\jquery-toast-plugin-master\src\jquery.toast.js"></script>
<!-- dfsbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb -->

<!-- for show hide start date and time period based on rem_req -->
<script type="text/javascript">
  function show1(){document.getElementById('rr').style.display = 'block'; }
function show2(){document.getElementById('rr').style.display ='none';}
</script>
<!-- for show hide start date and time period based on rem_req -->

</body>
</html>


  <div id="blackpreloader" style="display:none;position: fixed;height: 100vh;width: 100%;background-color:rgb(0, 0, 0,0.5);top:0px;z-index: 99;">
      <img src="loader.gif">
  </div>

<script type="text/javascript">
  function uploadimg(){
  document.getElementById("blackpreloader").style.display="block";
  document.getElementById("formn").submit();
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


<script type="text/javascript">
function valid(formn)
{


              if($("#Yes").is(':checked')) 
              {
                $('#start_date').attr('required', true);
                $('.period').attr('required', true);
              } 
              else 
              {
                $('#start_date').removeAttr('required');
                $('.period').removeAttr('required');
              }
              var from_date = new Date($('#from_date').val());
              var to_date = new Date($('#to_date').val());
              var start_date = new Date($('#start_date').val());
              // var date_ini = $('#from_date').val();
              // var date_end = $('#to_date').val();
              if (from_date > to_date) 
              {
                  swal({
                    title: "Warning..!",
                    text: "Invalid To Date! Please select To date greater than From Date",
                    type: "warning"
                  });
                  $('#to_date').val('');
                  setTimeout(function(){$('#to_date').datetimepicker('hide');}, 120);
                  return false;
              }
              
              // var date_ini = $('#from_date').val();
              // var start_date = $('#start_date').val();
              else if (from_date <= start_date) 
              {
                  swal({
                    title: "Warning..!",
                    text: "Invalid Start Date! Please select Start Date Less than From Date",
                    type: "warning"
                  });
                  $('#start_date').val('');
                  setTimeout(function(){$('#start_date').datetimepicker('hide');}, 120);
                  return false;
              }


              else if($("#Public").is(':checked')) 
              {

               var selectedParticipants= parseInt($("select[name='par[]'] option:selected").length);

               if(selectedParticipants<1){
                alert("In Public Task, Selection of atleat 1 Participant is necessary!");
                return false;
               }
                
              } 



              
}
</script>