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
				$database->saveArticle($_POST['articleID'],$_POST['articleTitle'],$_POST['articleCategory'],$_POST['articleDate'],mysqli_real_escape_string($database->connection, $_POST['articleText']), $_POST['articleImage'], $_POST['autorID']);
				$database->logRecord("EDIT",$_SESSION['connection']->userid,$_POST['articleID'],"ARTICLES");
			}else{
				$database->saveArticle('',$_POST['articleTitle'],$_POST['articleCategory'],$_POST['articleDate'],mysqli_real_escape_string($database->connection, $_POST['articleText']) , $_POST['articleImage'],$_POST['autorID']);
				$row = $database->getLastArticleID();
				$article = mysqli_fetch_array($row);
				$atabase->logRecord("NEW",$_SESSION['connection']->userid,$article['ID'],"ARTICLES");

			}							
		}
	}
?>
