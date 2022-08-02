<?php
include('common_function.php'); 
include "config.php";
session_start();
$uu = $_SESSION['id'];
$sid = $_SESSION['id'];
?>
<div class="modal fade bs-example-modal-lg none-border" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">

  <?php
      $sql         = "SELECT * FROM reminder WHERE rem_id= ".$_REQUEST['id'];
      $result      = mysql_query($sql,$conn);
      $row         = mysql_fetch_assoc($result);
      $type        = $row['type'];
      $title       = $row['title'];
      $description = $row['description'];
      $priority    = $row['priority'];
      $from_date   = date('d-m-Y H:i',strtotime($row['from_date']));
      $to_date     = date('d-m-Y H:i',strtotime($row['to_date']));
      $Status      = $row['Status'];
      $created_by  = $row['created_by'];
      $rem_req     = $row['rem_req'];
      $period      = $row['period'];
      $start_date  = date('d-m-Y H:i',strtotime($row['start_date']));
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
              <input name="require" type="radio" id="Yes1" value="1" class="radio-col-yellow" onclick="show3()">
              <label for="Yes1">Yes</label>                    
            </div>
            <div class="radio" style="display: inline;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="require" type="radio" id="No1" value="0" class="radio-col-yellow" onclick="show4()" checked="">
            <label for="No1">No</label>   
            </div>
            </div>
          </div>

          <!-- HERE START HIDDEN DIV -->

          <div id="more_detail" style="display: none;">



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






              <?php
          $sql = "SELECT * FROM reminder_participants WHERE rem_id =".$_REQUEST['id']." AND userid='$sid' ";
          $result = mysql_query($sql,$conn);
          if (mysql_num_rows($result) > 0)
          {
            $row = mysql_fetch_assoc($result);
             ?>
             <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label"><b>My Task Status</b></label>
            <div class="col-sm-9">
                <input type="text" class="form-control" disabled value="<?php if($row['status']==0){echo"Pending";}else{echo"Done";} ?>">
                </div>
          </div>
           <?php 
          }
        ?>
            


          <div class="form-group row">
            <label for="inputName" class="col-sm-3 control-label">Type</label>
            <div class="col-sm-9">
              <input type="text" class="form-control disabled" disabled readonly value="<?php echo $type; ?>">
            </div>
          </div>



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

          </div>






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

       <?php   }
       if($Status=='Done' && $created_by==$_SESSION['id'])
       { ?>
          <a href="calendar.php?close_id=<?=$_REQUEST['id']?>" class='btn btn-warning waves-effect text-right'>Give Rating</a>
     <?php  }
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