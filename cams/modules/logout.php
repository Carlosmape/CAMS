<?php 
	require "../includes/class/connection.php";
	require "../includes/config.php";
	require "../includes/sqlfunctions.php";
	session_destroy(); //you want to log out so $_SESSION will be destroyed
	header("Location: ".HOST); //and then redirect to your home page
	exit;
?>
