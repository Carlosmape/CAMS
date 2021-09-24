<?php
	require "../../includes/class/connection.php";
	require "../../includes/config.php";
	require "../../includes/sqlfunctions.php";
	if (isset($_SESSION['connection']) && !$_SESSION['connection']->timeout() && !$_SESSION['connection']->isAdmin()) { //if you are connected
		$_SESSION['connection']->keepalive(); //refresh connection timeout
		$database = new Sqlconnection;//connect to database in order to extract roles info
		if (isset($database)){
			if($database->editRole($_POST['editID'],strip_tags($_POST['editRole']),strip_tags($_POST['editMail']), strip_tags($_POST['editPass']), strip_tags($_POST['editType']))){
				echo "Role modified!";
			}
			else{
				echo "Cant modify role";
			}
		}else{
		  echo "Error CAMS could not connect to your DATABASE";
		}
		
	}
 ?>
