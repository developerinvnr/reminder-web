
<header class="main-header">
 <!-- Logo -->
 <a href="home.php" class="logo">
  <!-- mini logo for sidebar mini 50x50 pixels -->
  <span class="logo-mini"><img src="images/minimal.png" alt=""></span>
  <!-- logo for regular state and mobile devices -->
  <span class="logo-lg"><b>Reminder </b><i class="fa fa-bell-o" aria-hidden="true"></i></span>
 </a>
	
 <!-- Header Navbar-->
 <nav class="navbar navbar-static-top">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
  <span class="sr-only">Toggle navigation</span>
  </a>
      
	  <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
		
		  <!-- User Account Open -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <?php
                include "config.php";
                $sql1 = "SELECT * FROM user WHERE userid =".$_SESSION['id'];
                $result1 = mysql_query($sql1,$conn);
                $row = mysql_fetch_assoc($result1);
                echo $row['ufname']." ".$row['ulname'];
              ?>
            </a>
            <ul class="dropdown-menu scale-up" style="background-color:#0070DF;">
              <!-- User image -->
			  
              <li class="user-header">
			    <!-- <img src="images/user.jpg" class="float-left rounded-circle" alt="User Image"> -->


          <?php
    $sql = "SELECT * FROM user WHERE profile_pic!='' AND userid=".$_SESSION['id'];
    $result = mysql_query($sql,$conn);
    if (mysql_num_rows($result)>0) 
    { 
      $row = mysql_fetch_assoc($result);
      ?>
      <img id="cdpimg" class="float-left rounded-circle" src="<?= $row['profile_pic'] ?>" alt="User profile picture" />
  <?php  }
    else
    { ?>
        <img id="cdpimg" class="float-left rounded-circle" src="images/user.jpg" alt="User profile picture"/>
  <?php  }

  ?>

                <p>
                  <?php
                    echo $_SESSION['ufname']." ".$_SESSION['ulname'];
                  ?>
                  <small class="mb-5">
                    <?php
                      echo $_SESSION['uemail'];
                    ?>
                  </small>
                  <a href="#" class="btn btn-danger btn-sm" style="display: inline;" onclick="FunUrl2('profile.php')"><i class="ion ion-person"></i> Profile</a>

                  <a style="display: inline;" href="logout.php" class="btn btn-sm btn-danger"><i class="ion ion-power"></i> Log Out</a>
                </p>
              </li>
            </ul>
          </li>
		  <!-- User Account Close -->
	
        </ul>
      </div>
    </nav>
  </header>
  
  <script type="text/javascript">
function FunUrl2(v)
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