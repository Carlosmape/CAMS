<?php
require "../../includes/class/connection.php";
require "../../includes/config.php";
require "../../includes/sqlfunctions.php";
	
	if (isset($_SESSION['connection']) && !$_SESSION['connection']->timeout()) { //if you are connected
		$_SESSION['connection']->keepalive(); //refresh connection timeout
		$database = new Sqlconnection;//connect to database in order to extract users info
		
		if (isset($database)){ 
			//NOW WE CHECK IF THERE IS A ID, IF IT IS, WE EDIT THAT ARTICLE
			$id="";
			$title="";
			$type="";
			$category="";
			$date=date("Y-m-d");
			$text="";
			$parentscategories = $database->getParentCategories();
			$childcategories = $database->getChildCategories();
			if(isset($_POST['ID'])){
				$id=$_POST['ID'];
				$result = $database->getArticle($id);
				$row =mysqli_fetch_array($result);	
				$title=$row['TITLE'];
				$type=$row['TYPE'];
				$category=$row['CATEGORIES'];
				$date=$row['DATE'];
				$text=$row['CONTENT'];
				$image=$row['IMAGEHEADER'];
			}
			
			?>
			<div class="row"></div>
			<form action="" id="article" class="row">
				<input type="text" name="articleID" value="<?php echo $id;?>" hidden>
				<div class="form-group col-md-6">
					<input type="hidden" name="autorID" value="<?php echo $_SESSION['connection']->userid;?>">
					<label class="control-label col-md-2" for="articleTitle">Title</label>
					<input class="form-control col-md-6" type="text" id="articleTitle" name="articleTitle" value="<?php echo $title?>" placeholder="A title for your article...">
					<div class="row"></div>
					<input class="form-control col-md-6" type="hidden" id="articleType" name="articleType" value="1">
				</div>
				<div class="form-group col-md-6">
					<label class="control-label col-md-2" for="articleCategory">Category</label>
					<select class="form-control col-md-6" type="number" id="articleCategory" name="articleCategory" placeholder="A category...">
						<option value="0">-</option>
						<?php 
						foreach ($parentscategories as $patcat){
							?>
								<option value='<?php echo $patcat['ID']?>' <?php
									if ($category==$patcat['ID'])
										echo "selected";
							?>><?php echo $patcat['TITLE']?></option>
							<?php
							foreach ($childcategories as $chicat){
								if($patcat['ID'] == $chicat['PARENTID']){
								?>
									<option value='<?php echo $chicat['ID']?>' <?php
										if ($category==$chicat['ID'])
											echo "selected";
								?>>|→<?php echo $chicat['TITLE']?></option> 
							<?php 
								}
							}
						}
						?>
					</select>
					<div class="row"></div>
					<label class="control-label col-md-2" for="articleDate">Date</label>
					<input class="form-control col-md-6" type='date' id='datetimepicker4' name="articleDate" value="<?php echo $date?>">
				</div>
				<div class="form-group col-md-12">
					<label class="control-label col-md-2" for="">Header image</label>
					<input class="form-control " id="articleImage" type="text" name="articleImage" placeholder="Path to a image..." value=<?php if (isset($image)) echo $image;?>>
				</div>
				<div class="form-group col-md-12">
					<textarea id="editor1"><?php echo $text?></textarea>

					<script>
						CKEDITOR.replace( 'editor1', {
							height: 600
						} );
					</script>
				</div>
				<div class="form-group">
					<input class="btn btn-info form-control" type="button" id="articleSave" name="articleSave" value="Save">
				</div>
			</form>
		<?php
		}
	}
?>
<script src="modules/articles/functionsArticles.js"></script>
