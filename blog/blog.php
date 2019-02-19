<?php
require_once "cams/includes/config.php";
require_once "cams/includes/sqlfunctions.php";

$database = new Sqlconnection;//connect to database in order to extract users info
if (isset($database)){
	$searching = false;
	if (isset($_GET['search'])){
		$articles = $database->getAllArticlesLike(strip_tags($_GET['search']));
		$searching = true;
	}else if(isset($_GET['p'])){//if looking for next page
		$articles = $database->getAllArticlesIndex(strip_tags($_GET['p']-1));
	}	else if (isset($_GET['category'])){
		$articles = $database->getArticlesByCategory(strip_tags($_GET['category']));
	}
	else{
		$articles = $database->getAllArticlesIndex();
	}
?>
	<!-- Page Content -->
	<div class="container row">

		<!-- Blog Entries Column -->
		<div class="col-9">
			<?php if ($searching){?>
				<div class="row">
					<h1 class="col-md-8"><span class="glyphicon glyphicon-search"></span> <?php echo $_GET['search'];?></h1>
					<h1 class="col-md-4"><small><?echo " ".$articles->num_rows;?> results</small></h1>
				</div>
			<?php } ?>
			<?php //show all posts
			if ($articles)
			foreach ($articles as $row){
				?>
				<img  class="img-responsive articleImage" src="<?php echo $row['IMAGEHEADER']?>" alt="">
				<p><h2 class="articleTitle"><?php echo $row['TITLE']?></h2><form action="<?php echo HOST ?>/blog.php" method="get">
					<input type="hidden" name="post" value="<?php echo $row['TITLE']?>">
					<button class="btn btn-primary rowID articleReadMore" id="rowID" type="submit">
						Read<span class="glyphicon glyphicon-chevron-right"></span>
					</button>
				</form>
					<p class="articleDate"><span class="glyphicon glyphicon-time"></span><?php echo $row['DATE']?></p>
				</p>

				<hr>
			<?php }?>
			<?php if (!$searching){?>
				<!-- Pager -->
				<ul class="pager">

					<?php if (isset($_GET['p'])){?>
						<li class="previous">
							<a href="<?php echo HOST ?>/blog.php<?php
								if ($_GET['p']>2)
								echo "?p=".($_GET['p']-1);?>"><span class="glyphicon glyphicon-chevron-left"></span>
							</a>
						</li>
					<?php }?>
					<?php if ($articles->num_rows==10){?>
						<li class="next">
							<a href="<?php echo HOST ?>/blog.php?p=<?php
								if (isset($_GET['p']))
									echo $_GET['p']+1;
								else
									echo 2;
							?>"><span class="glyphicon glyphicon-chevron-right"></span></a>
						</li>
					<?php }?>
				</ul>
			<?php }?>
		</div>
<?php }?>
