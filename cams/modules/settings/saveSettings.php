<?php 
require "../../includes/class/connection.php";
require "../../includes/config.php";
require "../../includes/sqlfunctions.php";
if (isset($_SESSION['connection']) && !$_SESSION['connection']->timeout()) { //if you are connected
		$_SESSION['connection']->keepalive(); //refresh connection timeout
	if (isset($_POST)){
		$filename="../../includes/config.php";
		$file = fopen($filename, "r+");
		if (!$file) {
			echo('Cant open includes/config.php');
		}
		else {
			$settings = "";
			while(! feof($file))
			{
				$settings .= fgets($file);
			}
			//Output a line of the file until the end is reached
			$searchF  = array( //WILL SEARCH THAT PATTERNS IN CONFIG.PHP IN ORDER TO EDIT
				"/TITLE','.*'/",
				"/HOST','.*'/",
				"/DBHOST','.*'/",
				"/DBUSER','.*'/",
				"/DBNAME','.*'/",
				"/DBPASS','.*'/",
				"/FACEBOOK','.*'/",
				"/LANGUAGE','.*'/",
				"/GANALYTICSID','.*'/",
				"/DESCRIPTION','.*'/"
			);
			$replaceW = array(
			"TITLE','".$_POST['Title']."'",
			"HOST','".$_POST['Domain']."'",
			"DBHOST','".$_POST['Host']."'",
			"DBUSER','".$_POST['User']."'",
			"DBNAME','".$_POST['Databasename']."'", 
			"DBPASS','".$_POST['Password']."'",
			"FACEBOOK','".$_POST['Facebook']."'",
			"LANGUAGE','".$_POST['Language']."'",
			"GANALYTICSID','".$_POST['Ganalyticsid']."'",
			"DESCRIPTION','".$_POST['Description']."'");
			
			$settings = preg_replace($searchF, $replaceW, $settings);

			//ftruncate($file ,0); //truncate the file to size 0 before saving anything
			
			//var_dump(file_put_contents($filename,$settings));
			//var_dump($settings);
			fclose($file);
			$file = fopen($filename, "w");
			if (!$file) {
				echo('Cant open includes/config.php');
			}else{
				if (fwrite($file, $settings) === FALSE) {
        echo '<div class="container-fluid"><div class="alert alert-warning alert-dismissible col-md-12" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Error!</strong> Can not write stettings
						</div></div>';
			}else{
			echo '<div class="container-fluid"><div class="alert alert-success alert-dismissible col-md-12" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Saved!</strong> Your settings have been saved!
						</div></div>';
			}
			}
			fclose($file);
			//now you will redirect to /cams/
		}
	}
}
?>
