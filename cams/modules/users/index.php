<?php
require "../../includes/class/Connection.php";
require "../../includes/config.php";
require "../../includes/sqlfunctions.php";
 
	if (isset($_SESSION['connection']) && !$_SESSION['connection']->timeout() && $_SESSION['connection']->isAdmin()) { //if you are connected
		$_SESSION['connection']->keepalive(); //refresh connection timeout
		$database = new Sqlconnection;//connect to database in order to extract users info
		if (isset($database)){
			$users = $database->getAllUsers();
			echo '<h1 class="page-header">Users</h1>';?>
				<form id="form" class="row" action="" method="post">
					<div class="form-group col-md-2">
						<input class="form-control btn btn-info" type="button" id="Save" name="Save" value="Add user">
					</div>
					<div class="form-group col-md-4">
						<input class="form-control" type="text" id="Name" name="Name" placeholder="A username ...">
					</div>
					<div class="form-group col-md-4">
						<input class="form-control" type="password" id="Password" name="Password" placeholder="A Password ...">
					</div>
					<div class="form-group col-md-2">
						<select class="form-control btn btn-default" type="number" id="Type" name="Type" placeholder="A type" required>
							<option value="1">User</option>
							<option value="0">Admin</option>
						</select>					
					</div>
				</form>
			<?php
			//will show users info
			//first open table head and body putting as columns as you need
			echo '
			<div class="table-responsive">
				<table class="table table-striped">	
					<thead>
						<tr>
							<th>Id</th>
							<th>Name</th>
							<th>Mail</th>
							<th>Pass</th>
							<th>Type</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
					';
						while($row = mysqli_fetch_array($users)) { ?>
							<tr>
								<td id="rowID<?php echo $row['ID']?>" class="rowID"><?php echo $row['ID']?></td>
								<td id="rowUser<?php echo $row['ID']?>" class="rowUser"><?php echo $row['USER']?></td>
								<td id="rowMail<?php echo $row['ID']?>" class="rowMail"><?php echo $row['MAIL']?></td>
								<td id="rowPass<?php echo $row['ID']?>" class="rowPass"><?php echo $row['PASSWORD']?></td>
								<td id="rowType<?php echo $row['ID']?>" class="rowType">
									<?php 
									if ($row['TYPE']==0)
										echo "Admin";
									else if($row['TYPE']==1){
										echo "User";
									}
									?>
								</td>
								<?php
								if ($_SESSION['connection']->user == $row['USER']){?>
									<td></td>
									<td></td>
								<?php }
								else{?>
									<td><a href="#" class="editUser" id="editUser<?php echo $row['ID']?>">				<i class="material-icons">visibility</i></a></td>
									<td><a href="#" class="delete deleteUser" id="deleteUser<?php echo $row['ID']?>">	<i class="material-icons">delete</i>	</a>
								<?php }?>
								</td>
							</tr>
						<?php }
						echo '
					</tbody>
				</table>
				<div id="pager"></div>
			</div>';
		}else{
		  echo "Error CAMS could not connect to your DATABASE";
		}
	}
?>
<!--MODAL WINDOW FOR EDITING USERS -->
  <!-- Modal -->
<div class="modal fade" id="editUserModal" role="dialog">
	<div class="modal-dialog">
	
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Editing user</h4>
			</div>
			<div class="modal-body">
				<form id="editForm" class="form-horizontal col-md-12">
					<div class="form-group">
						<input class="form-control col-sm-8" type="text" id="editID" name="editID" placeholder="" hidden required>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="email">User:</label>
						<input class="form-control col-sm-8" type="text" id="editUser" name="editUser" placeholder="" required>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="email">Mail:</label>
						<input class="form-control col-sm-8" type="text" id="editMail" name="editMail" placeholder="">
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="email">Pass:</label>
						<input class="form-control col-sm-8" type="text" id="editPass" name="editPass" placeholder="New pass...">
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="email">Type:</label>
						<select class="form-control col-sm-8 btn btn-default" type="number" id="editType" name="editType" placeholder="A type" required>
							<option value="1">User</option>
							<option value="0">Admin</option>
						</select>					
					</div>						
					<div class="form-group">
						<button type="button" class="col-sm-offset-2 col-sm-4 btn btn-default" data-dismiss="modal">Cancel</button>
						<button class="btn btn-info col-sm-4" type="button" id="Edit" name="Edit" data-dismiss="modal" value="Edit">Edit</button>
					</div>
				</form>
			</div>
			<div	class="modal-footer">
			</div>
		</div>
		
	</div>
</div>
<div class="modal fade" id="deleteUserModal" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-body">
				<h3>¿Are you sure?</h3>
			</div>
			<div	class="modal-footer">
				<form>
					<button type="button" class="col-sm-offset-2 col-sm-4 btn btn-default" data-dismiss="modal">Cancel</button>
					<button class="btn btn-danger col-sm-4" type="button" id="Delete" name="Delete" data-dismiss="modal" value="Delete">Delete</button>
				</form>
			</div>
		</div>
		
	</div>
</div>
<script src="modules/users/functionsUsers.js"></script>
