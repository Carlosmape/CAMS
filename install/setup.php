<?php
//CAMS BY Camape
//INSTALLATION SCRIPT.
ini_set('display_errors',1);
error_reporting(E_ALL);

if (isset($_POST['setup'])){
	//
	//FIRST OF ALL SAVE CONFIG.PHP TO SAVE YOUR SITE CONFIG
	//
	
	echo ('Saving configuration to config.php');
	$filename="../cams/includes/config.php";
	$file = fopen($filename, "r+");
	if (!$file) {
		echo('Cant open cams/includes/config.php to read');
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
			echo('Cant open cams/includes/config.php to save it');
		}else{
			if(fwrite($file, $settings))
				echo 'Config saved on cams/includes/config.php';
		}
		fclose($file);
		//now you will redirect to /cams/
	}
	
	//
	//SECOND PIT 
	//CREATE TABLES TO ADMINISTRATE CAMS
	//
	$connection = new mysqli($_POST['Host'], $_POST['User'], $_POST['Password']);
    if (!$connection) {
      echo "Error CAMS: Unable to connect to MySQL. Debugging errno: ".mysqli_connect_errno()."Debugging error: ".mysqli_connect_error();
    }else{
		if ($result = mysqli_query($connection, "CREATE DATABASE IF NOT EXISTS `".$_POST['Databasename']."`;")){
			if($result = $connection->select_db($_POST['Databasename'])){
				if(mysqli_query($connection,
					"CREATE TABLE IF NOT EXISTS USERS(
					`ID` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
					`USER` VARCHAR(32),
					`MAIL` VARCHAR(32),
					`PASSWORD` VARCHAR(64),
					`TYPE` INT(11),
					UNIQUE (`USER`,`MAIL`),
					CHECK (TYPE BETWEEN 0 AND 1));") 
				&& mysqli_query($connection,
					"CREATE TABLE IF NOT EXISTS `CATEGORIES`(
					`ID` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
					`PARENTID` INT(11),
					`TITLE` VARCHAR(32) UNIQUE,
					CHECK (ID > 0));") 
				&& mysqli_query($connection,
					"CREATE TABLE IF NOT EXISTS `ARTICLES`(
					`ID` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
					`TITLE` VARCHAR(96) UNIQUE,
					`TYPE` INT(11),
					`CATEGORIES` INT(11),
					`DATE` DATE,
					`CONTENT`	TEXT,
					`IMAGEHEADER` TEXT,
					`AUTOR` INT(11),
					CHECK (TYPE BETWEEN 0 AND 2));")){
					echo "Tables created.";
					if (mysqli_query($connection,
						"INSERT INTO USERS (`USER`,`MAIL`,`PASSWORD`, `TYPE`)
						VALUES ('admin','example@mail.com','e3afed0047b08059d0fada10f400c1e5','0');") &&
						mysqli_query($connection,"INSERT INTO ARTICLES (`TITLE`, `TYPE`, `CATEGORIES`, `DATE`, `CONTENT`, `IMAGEHEADER`)
						VALUES ('Lorem ipsum dolor','1','0','".date("Y-m-d")."','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.','http://www.highreshdwallpapers.com/wp-content/uploads/2012/10/Lorem-Ipsum-Wallpaper.jpg');"))
					{	
						?>
						<?php 
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
						//
						//FINAL STEP
						//TIME TO REMOVE INSTALLATION FILES IN ORDER TO KEEP SYSTEM SECURITY
						//
						unlink("index.php");
						unlink("setup.php");
						rmdir("../install");
					}else{
						throw new Exception("Error CAMS: Could not create initial user admin try go /cams/ and login using admin, admin",1);
					}

				}else{
					throw new Exception("Error CAMS: Could not create necesary tables",1);
				}
			}else{
				throw new Exception("Error CAMS: Could not select your database ".$_POST['Databasename'].". ".$result,1);
			}

		}else{
			throw new Exception("Error CAMS: Could create or check your database ".$_POST['Databasename'].". ".$result,1);
		}
	}
}
?>
