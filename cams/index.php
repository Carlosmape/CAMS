<?php
require_once "includes/class/connection.php";
require_once "includes/config.php";
require_once "includes/header.php";
require_once "includes/sqlfunctions.php"; 
$database = new Sqlconnection;
try{
	if (isset($_SESSION['connection']) && !$_SESSION['connection']->timeout()) { //you are connected
		$_SESSION['connection']->keepalive();
		require "modules/dashboard.php";
	} else {  //you are trying to connect
		if (isset($_POST['inputUser']) && isset($_POST['inputPassword'])) {
			if ($user = $database->checkLogin(strip_tags($_POST['inputUser']), md5(strip_tags($_POST['inputPassword'])))) {
				$user = $user->fetch_assoc();
				$_SESSION['connection'] = new Connection($user['USER'],$user['TYPE'],$user['ID']);
				require "modules/dashboard.php";
				//echo "logged in";
			} else {
				require "modules/login.html";
				echo '	<div class="container"><div class="alert alert-warning alert-dismissible col-md-12" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					<strong>Error!</strong> Wrong user or password.
					</div></div>';
			}
		} else { //show login page
			require "modules/login.html";
		}
	}

	require ("includes/footer.php");
} catch(Exception $ex) {
	if(isset($database)){
		if(!$database->addLog($ex)){
			var_dump(mysqli_errno($database->connection));
		}
	} else {
		echo "<pre>";
		echo "DATABASE:";
		var_dump($database);
		echo "EX:";
		var_dump($ex);
		echo "</pre>";
	}
}
?>
