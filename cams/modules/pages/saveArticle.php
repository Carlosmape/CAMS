<?php
require "../../includes/class/connection.php";
require "../../includes/config.php";
require "../../includes/sqlfunctions.php";
	
	if (isset($_SESSION['connection']) && !$_SESSION['connection']->timeout()) { //if you are connected
		$_SESSION['connection']->keepalive(); //refresh connection timeout
		$database = new Sqlconnection;//connect to database in order to extract users info
		if (isset($database)){
			//save method
			if (isset($_POST['articleID'])){
				echo $database->savePage($_POST['articleID'],$_POST['articleTitle'],$_POST['articleType'],$_POST['articleCategory'],$_POST['articleDate'],mysqli_real_escape_string($database->connection, $_POST['articleText']), $_POST['articleImage'], $_POST['autorID']);
			}else{
				echo $database->savePage('',$_POST['articleTitle'],$_POST['articleType'],$_POST['articleCategory'],$_POST['articleDate'],mysqli_real_escape_string($database->connection, $_POST['articleText']) , $_POST['articleImage'],$_POST['autorID']);
			}
		}
	}
?>
