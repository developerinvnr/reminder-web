<?php
    session_start();
    if (!isset($_SESSION['id']))
    {
        header('Location: index.php');
    }    
    include "config.php";
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $gender = $_POST['gender'];
   $dob = date('Y-m-d', strtotime($_POST['dob']));
    $ann_date = date('Y-m-d', strtotime($_POST['ann_date']));
    $m_status = $_POST['m_status'];
    $address = $_POST['address'];
    $sql = "UPDATE user SET address = '$address' ,ufname = '$fname', ulname = '$lname', ucontact = '$mobile', uemail = '$email', udob = '$dob', ugender = '$gender', marital_status = '$m_status', Anniversary = '$ann_date' WHERE userid = ".$_SESSION['id'];
	$result = mysql_query($sql,$conn);
	if ($result)
	{
		header('Location: profile.php?update_profile=success');
	}
	else
	{
		header('Location: profile.php?update_profile=fail');
	}


?>