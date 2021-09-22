<?php
require "../../includes/class/connection.php";
require "../../includes/config.php";
require "../../includes/sqlfunctions.php";
 
	if (isset($_SESSION['connection']) && !$_SESSION['connection']->timeout()) { //if you are connected
		$_SESSION['connection']->keepalive(); //refresh connection timeout
		$database = new Sqlconnection;//connect to database in order to extract users info
		if (isset($database)){
			$parentscategories = $database->getParentCategories();
			$childcategories = $database->getChildCategories();
			echo '<h1 class="page-header">Categories</h1>';?>
				<form id="form" class="row" action="" method="post">
					<div class="form-group col-md-2">
						<input class="form-control btn btn-info" type="button" id="Save" name="Save" value="Add category">
					</div>
					<div class="form-group col-md-5">
						<input required class="form-control" type="text" id="Title" name="Title" placeholder="A title ...">
					</div>
					<div class="form-group col-md-5 row">
						<label class="col-form-label col-md-4" for="categoryParent">Parent</label>
						<select class="form-control btn-default col-md-8" type="number" id="categoryParent" name="categoryParent" placeholder="A category...">
							<option value="0">-</option>
							<?php 
							foreach ($parentscategories as $patcat){
								echo "<option value='".$patcat['ID']."'>".$patcat['TITLE']."</option>";
							}
							?>
						</select>
					</div>
				</form>
				<script src="modules/categories/functionsCategories.js"></script>

			<?php
			//will show users info
			//first open table head and body putting as columns as you need
			echo '
			<div class="table-responsive">
				<table class="table table-striped table-hover">	
					<thead>
						<tr>
							<th>Id</th>
							<th>Parent</th>
							<th>Title</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
					';
						foreach ($parentscategories as $patcat){ ?>
							<tr>
								<td id="rowID<?php echo $patcat['ID']?>" class="rowID"><?php echo $patcat['ID']?></td>
								<td id="rowParent<?php echo $patcat['ID']?>" class="rowParent"><?php echo $patcat['PARENTID']?></td>
								<td id="rowTitle<?php echo $patcat['ID']?>" class="rowTitle"><?php echo $patcat['TITLE']?></td>
								<td><a href="#" class="editCategory" id="editCategory<?php echo $patcat['ID']?>"><i class="material-icons">edit</i></a></td>
								<td><a href="#" class="delete deleteCategory" id="deleteCaegory<?php echo $patcat['ID']?>"><i class="material-icons">delete</i></a>
								</td>
							</tr> 
							<?php 
							foreach ($childcategories as $chicat){
								if($patcat['ID'] == $chicat['PARENTID']){
								?>
								<tr class="active">
									<td id="rowID<?php echo $chicat['ID']?>" class="rowID">|- <?php echo $chicat['ID']?></td>
									<td id="rowParent<?php echo $chicat['ID']?>" class="rowParent"><?php echo $chicat['PARENTID']?></td>
									<td id="rowTitle<?php echo $chicat['ID']?>" class="rowTitle"><?php echo $chicat['TITLE']?></td>
									<td><a href="#" class="editCategory" id="editCategory<?php echo $chicat['ID']?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
									<td><a href="#" class="delete deleteCategory" id="deleteCaegory<?php echo $chicat['ID']?>"><span class="glyphicon glyphicon-trash"></span></a>
									</td>
								</tr> 
							<?php
									}
								}
							}
						echo '
					</tbody>
				</table>
			</div>';
		}else{
		  echo "Error CAMS could not connect to your DATABASE";
		}
	}
?>
<!--MODAL WINDOW FOR EDITING USERS -->
  <!-- Modal -->
<div class="modal fade" id="editCategoryModal" role="dialog">
	<div class="modal-dialog">
	
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Editing Category</h4>
			</div>
			<div class="modal-body">
				<form id="editForm" class="form-horizontal col-md-12">
					<div class="form-group">
						<input class="col-sm-8" type="text" id="editID" name="editID" placeholder="" hidden required>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="email">Title:</label>
						<input class="form-control col-sm-8" type="text" id="editTitle" name="editTitle" placeholder="" required>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="email">Parent:</label>
						<select class="form-control col-md-6" type="number" id="editParent" name="editParent" placeholder="A category...">
							<option value="0">-</option>
							<?php 
							foreach ($parentscategories as $patcat){
								echo "<option value='".$patcat['ID']."'>".$patcat['TITLE']."</option>";
								foreach ($childcategories as $chicat){
									if($patcat['ID'] == $chicat['PARENTID']){
										echo "<option value='".$chicat['ID']."'>|→".$chicat['TITLE']."</option>";
									}
								}
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<button type="button" class="col-sm-offset-2 col-sm-4 btn btn-default" data-dismiss="modal">Cancel</button>
						<button class="btn btn-info col-sm-4" type="button" id="Edit" name="Edit" value="Edit" data-dismiss="modal">Edit</button>
					</div>
				</form>
			</div>
			<div	class="modal-footer">
			</div>
		</div>
		
	</div>
</div>
<div class="modal fade" id="deleteCategoryModal" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-body">
				<h3>¿Are you sure?</h3>
			</div>
			<div	class="modal-footer">
				<form>
					<button type="button" class="col-sm-offset-2 col-sm-4 btn btn-default" data-dismiss="modal">Cancel</button>
					<button class="btn btn-danger col-sm-4" type="button" id="Delete" name="Delete" value="Delete">Delete</button>
				</form>
			</div>
		</div>
		
	</div>
</div>
