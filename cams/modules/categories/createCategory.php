<?php
	require "../../includes/class/connection.php";
	require "../../includes/config.php";
	require "../../includes/sqlfunctions.php";
	if (isset($_SESSION['connection']) && !$_SESSION['connection']->timeout()) { //if you are connected
		$_SESSION['connection']->keepalive(); //refresh connection timeout
		$database = new Sqlconnection;//connect to database in order to extract users info
		if (isset($database)){
			if($database->addCategory(strip_tags($_POST['Title']), strip_tags($_POST['categoryParent']))){
				echo "User added!";
			}
			else{
				echo "Cant create user";
			}
		}else{
		  echo "Error CAMS could not connect to your DATABASE";
		}
		
	}
 ?>
