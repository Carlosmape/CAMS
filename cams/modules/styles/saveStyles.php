<?php 
require "../../includes/connection.php";
require "../../includes/config.php";
require "../../includes/sqlfunctions.php";
if (isset($_SESSION['connection']) && !$_SESSION['connection']->timeout()) { //if you are connected
		$_SESSION['connection']->keepalive(); //refresh connection timeout
	if (isset($_POST['content'])){
		$filename="../../../blog/css/custom.css";
		$file = fopen($filename, "w");
		if (!$file) {
			echo '<div class="container-fluid"><div class="alert alert-warning alert-dismissible col-md-12" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Error!</strong> Can not open '.$filename.'
						</div></div>';
		}else{
			if (fwrite($file, $_POST['content']) === FALSE) {
        echo '<div class="container-fluid"><div class="alert alert-warning alert-dismissible col-md-12" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Error!</strong> Can not write styles to '.$filename.'
						</div></div>';
			}else{
			echo '<div class="container-fluid"><div class="alert alert-success alert-dismissible col-md-12" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Saved!</strong> Your blog custom.css style has been saved.
						</div></div>';
			}
		}
		fclose($file);
	}else{
	echo '<div class="container-fluid"><div class="alert alert-warning alert-dismissible col-md-12" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Error!</strong> Data not recived
						</div></div>';}
}else{
	echo '<div class="container-fluid"><div class="alert alert-warning alert-dismissible col-md-12" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Error!</strong> Can not check your user, please, logut.
						</div></div>';
	}
?>
