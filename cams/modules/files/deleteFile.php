<?php
require "../../includes/class/connection.php";
require "../../includes/config.php";
 
	if (isset($_SESSION['connection']) && !$_SESSION['connection']->timeout()) { //if you are connected
		$_SESSION['connection']->keepalive(); //refresh connection timeout
		if (isset($_POST['ID'])){
			$target_dir = "../../../blog/uploads/";
			echo "Will delete ".$target_dir.$_POST['ID'];
			if (file_exists($target_dir.$_POST['ID'])) {
				unlink($target_dir.$_POST['ID']);
			} else {
				echo "File not exist!";
			}
		}
		
	}
?>
