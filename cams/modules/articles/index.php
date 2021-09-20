<?php
require "../../includes/class/connection.php";
require "../../includes/config.php";
require "../../includes/sqlfunctions.php";
 
	if (isset($_SESSION['connection']) && !$_SESSION['connection']->timeout()) { //if you are connected
		$_SESSION['connection']->keepalive(); //refresh connection timeout
		$database = new Sqlconnection;//connect to database in order to extract users info
		if (isset($database)){
			$articles = $database->getAllArticles();
			echo '<h1 class="page-header">Articles</h1>';?>
				<form id="form" class="row" action="" method="post">
					<div class="form-group col-md-2">
						<input class="form-control btn btn-info" type="button" id="newArticle" name="newArticle" value="Add article">
					</div>
				</form>
				<script src="modules/articles/functionsArticles.js"></script>
				<script src="includes/js/bootstrap.js"></script>

			<?php
			//will show articles info
			//first open table head and body putting as columns as you need
			echo '
			<div class="table-responsive">
				<table class="table table-striped">	
					<thead>
						<tr>
							<th>Id</th>
							<th>Title</th>
							<th>Type</th>
							<th>Category</th>
							<th>Date</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
					';
						while($row = mysqli_fetch_array($articles)) { ?>
							<?php if ($row['AUTOR']==$_SESSION['connection']->userid || $_SESSION['connection']->isAdmin()){ ?>
							<tr>
								<td id="rowID<?php echo $row['ID']?>" class="rowID"><?php echo $row['ID']?></td>
								<td id="rowUser<?php echo $row['ID']?>" class="rowUser"><?php echo $row['TITLE']?></td>
								<td id="rowMail<?php echo $row['ID']?>" class="rowMail"><?php echo $row['TYPE']?></td>
								<td id="rowPass<?php echo $row['ID']?>" class="rowPass"><?php echo $row['CATEGORIES']?></td>
								<td id="rowType<?php echo $row['ID']?>" class="rowType"><?php echo $row['DATE']?></td>
								<td><a href="#" class="edit editArticle" id="edit<?php echo $row['ID']?>"><i class="material-icons">edit</i></a></td>
								<td><a href="#" class="delete deleteArticle" id="delete<?php echo $row['ID']?>"><i class="material-icons">delete</i></a></td>
							</tr>
						<?php }
						}
						echo '
					</tbody>
				</table>
			</div>';
		}else{
		  echo "Error CAMS could not connect to your DATABASE";
		}
		?>		
		<div class="modal fade" id="deleteArticleModal" role="dialog">
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
		<?php
	}
?>
