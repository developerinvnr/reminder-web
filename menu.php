<?php include("pushstate.php"); ?>
<ul class="sidebar-menu" data-widget="tree">
<?php
?>

  <li class="treeview
  <?php
    if($_SERVER['PHP_SELF']=='/home.php')
    { 
      echo 'active';
    } 
  ?>
  " onclick="FunUrl('home.php')">
    <a href="#">
      <i class="fa fa-home"></i> <span>Home</span>
    </a>
  </li>



  <?php if ($_SESSION['utype']=="A") 
  { ?>
  <li class="treeview
  <?php
    if($_SERVER['PHP_SELF']=='/users.php')
    { 
      echo 'active';
    } 
  ?>
  " onclick="FunUrl('users.php')">
    <a href="#">
      <i class="fa fa-users" aria-hidden="true"></i> <span>Users</span>
    </a>
  </li>
  <?php } ?>



  
  <li class="treeview
  <?php
    if($_SERVER['PHP_SELF']=='/calendar.php')
    { 
      echo 'active';
    } 
  ?>
  " onclick="FunUrl('calendar.php')">
    <a href="#">
      <i class="fa fa-calendar" aria-hidden="true"></i><span>My Calendar</span>
    </a>
  </li>



  <li class="treeview
  <?php
    if($_SERVER['PHP_SELF']=='/public_reminder.php')
    { 
      echo 'active';
    } 
  ?>
  " onclick="FunUrl('public_reminder.php')">
    <a href="#">
      <i class="fa fa-bell" aria-hidden="true"></i><span>Add Task</span>
    </a>
  </li>



  <li class="treeview
  <?php
    if($_SERVER['PHP_SELF']=='/my_note.php')
    { 
      echo 'active';
    } 
  ?>
  " onclick="FunUrl('my_note.php')">
    <a href="#">
      <i class="fa fa-sticky-note" aria-hidden="true"></i><span>My Note</span>
    </a>
  </li>



  <li class="treeview
  <?php
    if($_SERVER['PHP_SELF']=='/reports.php')
    { 
      echo 'active';
    } 
  ?>
  " onclick="FunUrl('reports.php')">
    <a href="#">
      <i class="fa fa-newspaper-o" aria-hidden="true"></i><span>Reports</span>
    </a>
  </li>



  <li class="treeview
  <?php
    if($_SERVER['PHP_SELF']=='/contact_list.php')
    { 
      echo 'active';
    } 
  ?>
  " onclick="FunUrl('contact_list.php')">
    <a href="#">
      <i class="fa fa-phone-square" aria-hidden="true"></i><span>Contact</span>
    </a>
  </li> 


  <li class="treeview
  <?php
    if($_SERVER['PHP_SELF']=='/notification.php')
    { 
      echo 'active';
    } 
  ?>
  " onclick="FunUrl('notification.php')">
    <a href="#">
      <i class="fa fa-bell" aria-hidden="true"></i><span>Notification</span>
    </a>
  </li> 


  <li>
    <a download href="<?php if($_SESSION['utype']=="A"){echo"manual/help_manual.pdf";}else{echo"help_manual.pdf";} ?>">
      <i class="fa fa-file-text" aria-hidden="true"></i><span>Help File</span>
    </a>
  </li> 



</ul>
    
<script type="text/javascript">
function FunUrl(v)
{
    window.location=v;
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