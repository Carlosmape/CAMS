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
				<div class="col-sm-9 col-md-10 main">
					<form id="editForm" class="form-horizontal">
						<div class="form-group">
							<input class="col-sm-8" type="text" id="editID" name="editID" placeholder="" hidden required value="<?php echo $user['ID'];?>">
							<input class="col-sm-8" type="text" id="editType" name="editType" placeholder="" hidden required value="<?php echo $user['TYPE'];?>">
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="editUser">User:</label>
							<input class="form-control col-sm-8" type="text" id="editUser" name="editUser" placeholder="" required value="<?php echo $user['USER'];?>">
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="editMail">Mail:</label>
							<input class="form-control col-sm-8" type="text" id="editMail" name="editMail" placeholder="" value="<?php echo $user['MAIL'];?>">
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="email">New password:</label>
							<input class="form-control col-sm-8" type="text" id="editPass" name="editPass" placeholder="New pass...">
						</div>						
						<div class="form-group">
							<input class="btn btn-info" type="button" id="EditProfile" name="EditProfile" value="Edit">
						</div>
					</form>
				</div>
				<script src="modules/profile/functions.js"></script>
				<?php
			}
		}
	}
	?>
