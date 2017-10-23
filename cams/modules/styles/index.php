<?php
require "../../includes/class/connection.php";
require "../../includes/config.php";
//require "../../includes/sqlfunctions.php";
 
	if (isset($_SESSION['connection']) && !$_SESSION['connection']->timeout() && $_SESSION['connection']->isAdmin()) { //if you are connected
		$_SESSION['connection']->keepalive(); //refresh connection timeout
		$filename="../../../blog/css/custom.css";
		$file = fopen($filename, "r+");
		if (!$file) {
			echo('Cant open blog/css/custom.css');
		}
		else {
			$text = "";
			while(! feof($file))
			{
				$text .= fgets($file);
			}
			echo '<h1 class="page-header">CSS custom style</h1>';?>
				<form id="styles" class="row" action="" method="post">
					<div class="form-group col-md-12">
						<textarea id="editorStyles" style="height: 600px;width: 100%;"><?php echo $text; ?></textarea>
					</div>
					<div class="form-group">
						<input class="btn btn-info form-control" type="button" id="stylesSave" name="stylesSave" value="Save">
					</div>
				</form>
				<script src="modules/styles/functions.js"></script>
				<script src="includes/js/bootstrap.js"></script>		
			<?php 
			fclose($file);
		}
	}
?>
