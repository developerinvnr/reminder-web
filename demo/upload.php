<?php
session_start();
$sid = $_SESSION['id'];
if(isset($_POST["image"]))
{
	include('config.php');
	$data = $_POST["image"];
	$imageName = "profile_pics/".$sid.'.png';
	$sql = "UPDATE user SET profile_pic='$imageName' WHERE userid='$sid' ";
	$result = mysql_query($sql,$conn);
	if ($result)
	{
		$image_array_1 = explode(";", $data);
		$image_array_2 = explode(",", $image_array_1[1]);
		$data = base64_decode($image_array_2[1]);
		file_put_contents($imageName, $data);
		echo '<img src="'.$imageName.'" class="img-thumbnail" />';
	}
}

?>