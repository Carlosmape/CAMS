<?php
  require_once "../../includes/class/Connection.php";
	require_once "../../includes/config.php";
	require_once "../../includes/sqlfunctions.php"; 
	
	//refresh session activity
  if (isset($_SESSION['connection'])&& !$_SESSION['connection']->timeout() && $_SESSION['connection']->isAdmin()) {
    $_SESSION['connection']->keepalive();
    //obtaining current defines
    $alldefines = get_defined_constants(true);
    $userdefines = $alldefines['user'];
		?>
		<h1 class="page-header">Settings</h1>
		<div class="alert alert-warning" role="alert"><strong>CAUTION!</strong> Edit that settings may broke your web site. Dont touch it if you have no idea about what are you doing!</div>
		<form id="form" class="row" action="" method="post">
			<div class="form-group col-md-6">
				<h3>Set up your website</h3>
				<label for="title" class="sr-only">Title</label>Title
				<input class="form-control" type="text" id="title" name="Title" value="<?php echo $userdefines['TITLE'];?>">
				<label for="domain" class="sr-only">Domain</label>Domain
				<input class="form-control" type="text" id="domain" name="Domain" value="<?php echo $userdefines['HOST'];?>">
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
				<input class="form-control" type="text" id="dbhost" name="Host" value="<?php echo $userdefines['DBHOST'];?>">
				<label for="dbuser" class="sr-only">User</label>User
				<input class="form-control" type="text" id="dbuser" name="User" value="<?php echo $userdefines['DBUSER'];?>">
				<label for="dbname" class="sr-only">Database Name</label>Database name
				<input class="form-control" type="text" id="dbname" name="Databasename" value="<?php echo $userdefines['DBNAME'];?>">
				<label for="dbpassword" class="sr-only">Password</label>Password
				<input class="form-control" type="text" id="dbpassword" name="Password" value="<?php echo $userdefines['DBPASS'];?>">
			</div>
			<div class="form-group col-md-6">
				<label for="save" class="sr-only">Submit</label>
				<input id="submitsettings" class="form-control btn btn-info" type="button"  name="submit" value="Save">
			</div>
			<script src="modules/settings/functions.js"></script>
		</form>
		<?php
		}else{
			echo "You are not connected as admin user";
			}
?>
