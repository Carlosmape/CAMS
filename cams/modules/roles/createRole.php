<?php
	require "../../includes/class/connection.php";
	require "../../includes/config.php";
	require "../../includes/sqlfunctions.php";
	if (isset($_SESSION['connection']) && !$_SESSION['connection']->timeout() && $_SESSION['connection']->isAdmin()) { //if you are connected
		$_SESSION['connection']->keepalive(); //refresh connection timeout
		$database = new Sqlconnection;//connect to database in order to extract roles info
		if (isset($database)){
			if($database->addRole(strip_tags($_POST['Name']), strip_tags($_POST['Description']))){
				echo "Role added!";
				$role = $database->getRole($_POST['Name']);
				var_dump($role);
				//Assign given permissions
				foreach($_POST['Permission'] as $permission){
					$database->addPermissionToRole($role['ID'], $permission);
				}
			}
			else{
				echo "Cant create role";
			}
		}else{
		  echo "Error CAMS could not connect to your DATABASE";
		}
		
	}
 ?>
