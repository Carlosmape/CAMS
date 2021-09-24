<?php
	require "../../includes/class/connection.php";
	require "../../includes/config.php";
	require "../../includes/sqlfunctions.php";
	if (isset($_SESSION['connection']) && !$_SESSION['connection']->timeout()) { //if you are connected
		$_SESSION['connection']->keepalive(); //refresh connection timeout
		$database = new Sqlconnection;//connect to database in order to extract users info
		if (isset($database)){ 
			if ($user = $database->getUser($_SESSION['connection']->user)){
				$user = $user->fetch_assoc();
				?>
				<form id="editForm" class="form-horizontal">
					<div class="form-group">
						<input type="text" id="editID" name="editID" hidden required value="<?php echo $user['ID'];?>">
						<input type="text" id="editType" name="editType" hidden required value="<?php echo $user['TYPE'];?>">
					</div>
					<div class="form-group">
						<label class="control-label" for="editUser">User:</label>
						<input class="form-control" type="text" id="editUser" name="editUser" required value="<?php echo $user['USER'];?>">
					</div>
					<div class="form-group">
						<label class="control-label" for="editMail">Mail:</label>
						<input class="form-control" type="text" id="editMail" name="editMail" required value="<?php echo $user['MAIL'];?>">
					</div>
					<div class="form-group">
						<label class="control-label" for="email">New password:</label>
						<span class="badge badge-info">Let empty to do not change it</span>
						<input class="form-control" type="text" id="editPass" name="editPass" placeholder="New pass...">
					</div>						
					<div class="form-group">
						<input class="btn btn-info" type="button" id="EditProfile" name="EditProfile" value="Edit">
					</div>
				</form>
				<script src="modules/profile/functions.js"></script>
				<?php
			}
		}
	}
	?>
