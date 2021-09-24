<?php
	require "../../includes/class/connection.php";
	require "../../includes/config.php";
	require "../../includes/sqlfunctions.php";
	if (isset($_SESSION['connection']) && !$_SESSION['connection']->timeout() && $_SESSION['connection']->isAdmin()) { //if you are connected
		$_SESSION['connection']->keepalive(); //refresh connection timeout
		$database = new Sqlconnection;//connect to database in order to extract roles info
		if (isset($database)){
			if($database->deleteRole($_POST['ID'])){
				echo "Role deleted!";
			}
			else{
				echo "Cant delete role Error:".mysqli_error($database->connection);
			}
		}else{
		  echo "Error CAMS could not connect to your DATABASE";
		}
		
	}
 ?>
