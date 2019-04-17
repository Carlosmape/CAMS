<?php
	require "../../includes/class/connection.php";
	require "../../includes/config.php";
	require "../../includes/sqlfunctions.php";
	if (isset($_SESSION['connection']) && !$_SESSION['connection']->timeout()) { //if you are connected
		$_SESSION['connection']->keepalive(); //refresh connection timeout
		$database = new Sqlconnection;//connect to database in order to extract users info
		if (isset($database)){
			if($database->deleteCategory(strip_tags($_POST['ID']))){
				echo "User deleted!";
			}
			else{
				echo "Cant delete user";
			}
		}else{
		  echo "Error CAMS could not connect to your DATABASE";
		}
		
	}
 ?>
