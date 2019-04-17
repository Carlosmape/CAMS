<?php
	require "../../includes/class/Connection.php";
	require "../../includes/config.php";
	require "../../includes/sqlfunctions.php";
	if (isset($_SESSION['connection']) && !$_SESSION['connection']->timeout() && !$_SESSION['connection']->isAdmin()) { //if you are connected
		$_SESSION['connection']->keepalive(); //refresh connection timeout
		$database = new Sqlconnection;//connect to database in order to extract users info
		if (isset($database)){
			if($database->editUser($_POST['editID'],strip_tags($_POST['editUser']),strip_tags($_POST['editMail']), strip_tags($_POST['editPass']), strip_tags($_POST['editType']))){
				echo "User modified!";
			}
			else{
				echo "Cant modify user";
			}
		}else{
		  echo "Error CAMS could not connect to your DATABASE";
		}
		
	}
 ?>
