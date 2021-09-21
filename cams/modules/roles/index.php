<?php
require "../../includes/class/connection.php";
require "../../includes/config.php";
require "../../includes/sqlfunctions.php";
 
	if (isset($_SESSION['connection']) && !$_SESSION['connection']->timeout() && $_SESSION['connection']->isAdmin()) { //if you are connected
		$_SESSION['connection']->keepalive(); //refresh connection timeout
		$database = new Sqlconnection;//connect to database in order to extract roles info
		if (isset($database)){
			$roles = $database->getRoles();
			$sections = $database->getSections();
			echo '<h1 class="page-header">Roles</h1>';?>
				<form id="form" class="row" action="" method="post">
					<div class="form-group col-md-2">
						<input class="form-control btn btn-info" type="button" id="Save" name="Save" value="Add role">
					</div>
					<div class="form-group col-md-4">
						<input required class="form-control" type="text" id="Name" name="Name" placeholder="A rolename ...">
					</div>
					<div class="form-group col-md-6">
						<input class="form-control" type="text" id="Description" name="Description" placeholder="A brief description ...">
					</div>
					<div class="form-group col-md-12">
   						<label for="Permission">Grant permissions to manage</label>
						<span class="badge badge-info">Press CTRL to multiple selection</span>
						<select multiple class="form-control btn-default" type="number" id="Permission" name="Permission[]" placeholder="Permissions" >
							<?php while($section = mysqli_fetch_array($sections)) { ?>
							<option value="<?php echo $section['ID'] ?>" <?php if($section['ENTITY']=='ARTICLES') echo "selected" ?> ><?php echo $section['ENTITY'] ?></option>
							<?php } ?>
						</select>					
					</div>
				</form>
			<?php
			//will show roles info
			//first open table head and body putting as columns as you need
			echo '
			<div class="table-responsive">
				<table class="table table-striped">	
					<thead>
						<tr>
							<th>Id</th>
							<th>Name</th>
							<th>Description</th>
							<th>Permissions</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
					';
						while($row = mysqli_fetch_array($roles)) { ?>
							<tr>
								<td id="rowID<?php echo $row['ID']?>" class="rowID"><?php echo $row['ID']?></td>
								<td id="rowName<?php echo $row['ID']?>" class="rowRole"><?php echo $row['NAME']?></td>
								<td id="rowDescription<?php echo $row['ID']?>" class="rowDescription"><?php echo $row['DESCRIPTION']?></td>
								<td id="rowPermissions<?php echo $row['ID']?>" class="rowPermissions"></td>
								<?php
								if (!$_SESSION['connection']->isAdmin()){?>
								<td></td>
								<td></td>
								<?php }
								else{?>
								<td><a href="#" class="editRole" id="editRole<?php echo $row['ID']?>"><i class="material-icons">edit</i></a></td>
								<td><a href="#" class="delete deleteRole" id="deleteRole<?php echo $row['ID']?>"><i class="material-icons">delete</i></a></td>
								<?php }?>
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
<div class="modal fade" id="editRoleModal" role="dialog">
	<div class="modal-dialog">
	
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Editing role</h4>
			</div>
			<div class="modal-body">
				<form id="editForm" class="form-horizontal col-md-12">
					<div class="form-group">
						<input class="form-control col-sm-8" type="text" id="editID" name="editID" placeholder="" hidden required>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="editRole">Role:</label>
						<input class="form-control col-sm-8" type="text" id="editRole" name="editRole" placeholder="" required>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="editDescription">Description:</label>
						<input class="form-control col-sm-8" type="text" id="editDescription" name="editDescription" placeholder="">
					</div>
					<div class="form-group col-md-12">
   						<label for="permission"="">Grant permissions to manage</label>
						<span class="badge badge-info">Press CTRL to multiple selection</span>
						<select multiple class="form-control btn-default" type="number" id="editPermission" name="editPermission[]" placeholder="Permissions" >
							<?php while($section = mysqli_fetch_array($sections)) { ?>
							<option value=<?php echo $section['ID'] ?>><?php echo $section['ENTITY'] ?></option>
							<?php } ?>
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
<div class="modal fade" id="deleteRoleModal" role="dialog">
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
<script src="modules/roles/functionsRoles.js"></script>
