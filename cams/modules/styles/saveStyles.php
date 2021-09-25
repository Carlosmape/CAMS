<?php 
require "../../includes/class/connection.php";
require "../../includes/config.php";
require "../../includes/sqlfunctions.php";
if (isset($_SESSION['connection']) && !$_SESSION['connection']->timeout()) { //if you are connected
	$_SESSION['connection']->keepalive(); //refresh connection timeout
	if (isset($_POST['content'])){
		$filename="../../../blog/css/custom.css";
		$file = fopen($filename, "w");
		if (!$file) {
			echo '<strong>Error!</strong> Can not open '.$filename;
		}else{
			if (fwrite($file, $_POST['content']) === FALSE) {
				echo '<strong>Error!</strong> Can not write styles to '.$filename;
			}else{
				echo '<strong>Saved!</strong> Your blog custom.css style has been saved.';
			}
		}
		fclose($file);
	}else{
		echo '<strong>Error!</strong> Data not recived';	
	}
}else{
	echo '<strong>Error!</strong> Can not check your user, please, logut.';
}
?>
