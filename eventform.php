<!DOCTYPE html>
<html>
<head>
  <title></title>
    <link rel="icon" href="images/favicon.png">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title><?php include("tital.php"); ?></title>
<link rel="stylesheet" href="assets/vendor_components/bootstrap/dist/css/bootstrap.css">
<link rel="stylesheet" href="assets/vendor_components/bootstrap/dist/css/bootstrap-extend.css">
<link rel="stylesheet" href="assets/vendor_components/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="css/master_style.css">
<link rel="stylesheet" href="css/jquery.datetimepicker.css">  
<link rel="stylesheet" href="assets/vendor_components/font-awesome/css/font-awesome.css">
<link rel="stylesheet" href="assets/vendor_components/Ionicons/css/ionicons.css">
<link rel="stylesheet" href="css/master_style.css">
<link rel="stylesheet" href="css/skins/_all-skins.css">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
<body>
  <div class="modal none-border" id="my-event">
 <div class="modal-dialog">
  <div class="modal-content">
  
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title"><strong>Add Event</strong></h4>
   </div>
   <div class="modal-body"></div>
   <div class="modal-footer">
    <button type="button" class="btn btn-white waves-effect" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-success save-event waves-effect waves-light">Create event</button>
    <button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Delete</button>
   </div>
   
  </div>
 </div>
</div>

<!-- Modal Add Category -->
<div class="modal fade none-border" id="add-new-events">
 <div class="modal-dialog">
  <div class="modal-content">
   
   <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  <h4 class="modal-title"><strong>Add</strong> Reminder</h4>
   </div>
   
   <div class="modal-body">
   <form>

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
          <label for="example-email-input" class="col-sm-4 col-form-label">Reminder Require <label style="color: red">*</label></label>
          <div class="col-sm-8">
            <div class="radio" style="display: inline;">
              <input name="r_require" type="radio" id="Yes" value="1" class="radio-col-yellow">
              <label for="Yes">Yes</label>                    
            </div>
            <div class="radio" style="display: inline;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="r_require" type="radio" id="No" value="0" class="radio-col-yellow">
            <label for="No">No</label>   
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
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="r_priority" type="radio" id="Medium" value="Medium" class="radio-col-yellow">
            <label for="Medium">Medium</label>   
            </div>
            <div class="radio" style="display: inline;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="r_priority" type="radio" id="High" value="High" class="radio-col-yellow">
            <label for="High">High</label>   
            </div>
          </div>
        </div>

        <div class="form-group row">
          <label for="example-datetime-local-input" class="col-sm-4 col-form-label">Start Date <label style="color: red">*</label></label>
          <div class="col-sm-8">
          <input class="form-control" name="from_date" id="from_date" autocomplete="off" required>
          </div>
        </div>

        <div class="form-group row">
          <label for="example-datetime-local-input" class="col-sm-4 col-form-label">End Date <label style="color: red">*</label></label>
          <div class="col-sm-8">
          <input class="form-control" name="to_date" id="to_date" autocomplete="off" required> 
          </div>
        </div>

        <div class="form-group row" id="par" style="display: none;">
          <label for="example-tel-input" class="col-sm-4 col-form-label">Participants <label style="color: red">*</label></label>
          <div class="col-sm-8">
            <select class="form-control select2" multiple="multiple" data-placeholder="Choose Users" style="width: 100%" name="par[]">
            <?php
              require("config.php");
              $sql = "SELECT * FROM user";
              $result = mysql_query($sql,$conn);
              if (mysql_num_rows($result) > 0)
              {
                while ($row = mysql_fetch_assoc($result)) 
                {
                  $uid = $row['userid'];
                  $fname = $row['ufname']; 
                  $lname = $row['ulname']; 
                  echo '<option value="'.$uid.'">'."&nbsp;&nbsp;".$fname.' '.$lname.'</option>';
                }
              }
            ?>
            </select>
          </div>
        </div>
   </form>
   </div>
   
   <div class="modal-footer">
  <button type="button" class="btn btn-danger waves-effect waves-light save-category" data-dismiss="modal">Save</button>
  <button type="button" class="btn btn-white waves-effect" data-dismiss="modal">Close</button>
   </div>
   
  </div>
 </div>
</div>

<!-- end of modal -->


  <script src="assets/vendor_components/jquery/dist/jquery.min.js"></script>
  <script src="assets/vendor_components/popper/dist/popper.min.js"></script>
  <script src="assets/vendor_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="assets/vendor_components/select2/dist/js/select2.full.js"></script>
  <script src="js/pages/advanced-form-element.js"></script>
  <script src="assets/vendor_components/fastclick/lib/fastclick.js"></script>
  <script src="js/template.js"></script>
  <script src="js/demo.js"></script>

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
</body>
</html>





  