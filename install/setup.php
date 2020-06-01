<?php
//CAMS BY Camape
//INSTALLATION SCRIPT.
ini_set('display_errors',1);
error_reporting(E_ALL);

require 'saveConfig.php';
require 'dbConfig.php';
require 'dbData.php';
require 'removeInstallFiles.php';

if (isset($_POST['setup'])){
	$configSaved = false;
	$dbCreated = false;
	$tablesCreated = false;
	$firstDataInserted = false;

	//FIRST OF ALL SAVE CONFIG.PHP TO SAVE YOUR SITE CONFIG
	echo ('Saving configuration to config.php');
	$configSaved = SaveConfig();
	//SECOND PIT 
	//CREATE TABLES TO ADMINISTRATE CAMS
	$connection = new mysqli($_POST['Host'], $_POST['User'], $_POST['Password']);
	$result = CreateDatabase($connection);
	$tablesCreated = CreateTablesStructures($connection);
    if (!$connection) {
	echo "Error CAMS: Unable to connect to MySQL. Debugging errno: ".mysqli_connect_errno()."Debugging error: ".mysqli_connect_error();
    }else{
	if (CreateDefAdminUser($connection) && CreateSampleArticle($connection)){	
		require_once "../cams/includes/config.php";
		?>
			<!DOCTYPE html>
			<html lang="en">
			<head>
				<meta charset="utf-8">
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
				<meta name="description" content="This page guides you throught CAMS setup and configuration">
				<meta name="author" content="Camape">
				<title>CAMS installation page</title>

				<!-- Bootstrap core CSS -->
				<link href="../cams/includes/css/bootstrap.min.css" rel="stylesheet">

				<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
				<!--[if lt IE 9]>
				<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
				<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
				<![endif]-->
				</head>

				<body>

					<div class="container">
						<div class="header clearfix">
							<h3 class="text-muted">Simple and flexible</h3>
						</div>

						<div class="jumbotron alert alert-success" role="alert">
						<h1>CAMS <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span></h1>
						<p class="lead">Good! installation done.</p>
						<p class="lead">You can login with "admin" as user and password. We recomend you to create a new user and era admin one.</p>
						<p class="lead">Go <a href="../cams">login page</a></p>
						</div>
										
						<footer class="footer">
						<p>&copy; 2017 Camape</p>
						</footer>
					</div> <!-- /container -->
				  </body>
				</html>
				<?php 
		
		//FINAL STEP
		//TIME TO REMOVE INSTALLATION FILES IN ORDER TO KEEP SYSTEM SECURITY
		RemoveInstallationFiles();
		}else{
			throw new Exception("Error CAMS: Could not create initial user admin try go /cams/ and login using admin, admin",1);
		}
	}
}else{
	throw new Exception("Error CAMS: Could create or check your database ".$_POST['Databasename'].". ".$result,1);
}
?>
