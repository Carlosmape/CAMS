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

      <div class="jumbotron">
        <h1>CAMS</h1>
        <p class="lead">You are about to install CAMS in your website, a simple and flexible CMS. You can choose yor own existing database or creates new one </p>
		<pre><?php phpinfo(); ?></pre>                
				<form id="form" class="row" action="setup.php" method="post">
				<div class="form-group col-md-6">
					<h3>Set up your website</h3>
					<label for="title" class="sr-only">Title</label>Title
					<input class="form-control" type="text" id="title" name="Title" value="<?php echo TITLE;?>">
					<label for="domain" class="sr-only">Domain</label>Domain
					<input class="form-control" type="text" id="domain" name="Domain" value="<?php echo HOST;?>">
					<label for="language" class="sr-only">Language</label>Language
					<input class="form-control" type="text" id="language" name="Language" value="<?php echo LANGUAGE?>">
					<label for="description" class="sr-only">Description</label>Description
					<input class="form-control" type="text" id="description" name="Description" value="<?php echo DESCRIPTION?>">
					<label for="Ganalyticsid" class="sr-only">Google Analytics ID</label>Google Analytics ID
					<input class="form-control" type="text" id="Ganalyticsid" name="Ganalyticsid" value="<?php echo GANALYTICSID?>">
					<label for="facebook" class="sr-only">Facebook</label>Facebook
					<input class="form-control" type="text" id="facebook" name="Facebook" value="<?php echo FACEBOOK?>">
				</div>
				<div class="form-group col-md-6">
					<h3>Set up your database connection</h3>
					<label for="dbhost" class="sr-only">Host</label>Host
					<input class="form-control" type="text" id="dbhost" name="Host" value="<?php echo DBHOST;?>">
					<label for="dbuser" class="sr-only">User</label>User
					<input class="form-control" type="text" id="dbuser" name="User" value="<?php echo DBUSER;?>">
					<label for="dbname" class="sr-only">Database Name</label>Database name
					<input class="form-control" type="text" id="dbname" name="Databasename" value="<?php echo DBNAME;?>">
					<label for="dbpassword" class="sr-only">Password</label>Password
					<input class="form-control" type="text" id="dbpassword" name="Password" value="<?php echo DBPASS;?>">
				</div>
				<div class="row"></div>
        <p><input class="btn btn-lg btn-success" name="setup" type="submit" value="Set up"></p>
      </div>

      <footer class="footer">
        <p>&copy; 2017 Camape</p>
      </footer>

    </div> <!-- /container -->
  </body>
</html>
