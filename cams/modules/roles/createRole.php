<?php
	require "../../includes/class/connection.php";
	require "../../includes/config.php";
	require "../../includes/sqlfunctions.php";
	if (isset($_SESSION['connection']) && !$_SESSION['connection']->timeout() && $_SESSION['connection']->isAdmin()) { //if you are connected
		$_SESSION['connection']->keepalive(); //refresh connection timeout
		$database = new Sqlconnection;//connect to database in order to extract roles info
		if (isset($database)){
			var_dump($_POST);
			/*if($database->addRole(strip_tags($_POST['Name']), strip_tags($_POST['Description']))){
				echo "Role added!";
			}
			else{
				echo "Cant create role";
			}*/
		}else{
		  echo "Error CAMS could not connect to your DATABASE";
		}
		
	}
 ?>
