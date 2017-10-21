<?php
require "../../includes/connection.php";
require "../../includes/config.php";
require "../../includes/sqlfunctions.php";
	
	if (isset($_SESSION['connection']) && !$_SESSION['connection']->timeout()) { //if you are connected
		$_SESSION['connection']->keepalive(); //refresh connection timeout
		$database = new Sqlconnection;//connect to database in order to extract users info
		if (isset($database)){
			//save method
			if (isset($_POST['ID'])){
				echo $database->deleteArticle($_POST['ID']);
			}
		}
	}
?>
