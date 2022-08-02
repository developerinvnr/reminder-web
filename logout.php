<?php
	session_start();
	unset($_SESSION['id']);
	unset($_COOKIE["c_id"]);
	echo $_COOKIE["c_id"];
	setcookie('c_id', null, -1, '/');
	session_destroy();
	header('Location: index.php');
?>