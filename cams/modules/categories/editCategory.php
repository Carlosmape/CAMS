<?php
	require "../../includes/class/Connection.php";
	require "../../includes/config.php";
	require "../../includes/sqlfunctions.php";
	if (isset($_SESSION['connection']) && !$_SESSION['connection']->timeout()) { //if you are connected
		$_SESSION['connection']->keepalive(); //refresh connection timeout
		$database = new Sqlconnection;//connect to database in order to extract users info
		if (isset($database)){
			if($database->editCategory(strip_tags($_POST['editID']), strip_tags($_POST['editTitle']), strip_tags($_POST['editParent']))){
				echo "User edited!";
			}
			else{
				echo "Cant edit user";
			}
		}else{
		  echo "Error CAMS could not connect to your DATABASE";
		}
		
	}
 ?>
