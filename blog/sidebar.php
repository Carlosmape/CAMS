<?php 
	require_once "cams/includes/config.php";
	$database = new Sqlconnection;//connect to database in order to extract users info
?>
 <!-- Blog Sidebar Widgets Column -->
			<div class="col-3 sidebar">
					<!-- Blog Categories Well -->
					<div class="blogWidget widgetRandomPost">
						<div class="card-body">
							<div class="row">
							<?php
							if (isset($database)){
								$latestposts = $database->getRandomArticles();
								$i=0;
								foreach($latestposts as $post){
									echo "<div class='col col-xs-4 col-md-6'>
													<a class='card' href='".HOST."/blog.php?post=".urlencode($post['TITLE'])."'>
														<img class='img-fluid card-img-top widgetRandomPostImage' src='".$post['IMAGEHEADER']."' alt=''>
														<h6 class='card-text'>
														".$post['TITLE']."
														</h6>
													</a>
												</div>";
									$i=$i+1;
									if ($i%2==0) {
										echo "<div class='clearfix visible-lg-block visible-md-block'></div>";
									}
									if ($i%3==0) {
										echo "<div class='clearfix visible-xs-block visible-sm-block'></div>";
									}
								}
							} ?>
							</div>
						</div>
					</div>
					<div class="blogWidget">
						<h4>Categories</h4>
						<div class="row">
							<div class="col-lg-6">
								<ul class="list-unstyled blogCategoryParent">
								<?php
								if (isset($database)){
									$parentscategories = $database->getParentCategories();
									$childcategories = $database->getChildCategories();
									foreach ($parentscategories as $patcat){
										echo "<li><a href='/blog.php?category=".$patcat['TITLE']."'>".$patcat['TITLE']."</a></li>";
										echo "<ul class='list-unstyled blogCategoryChild'>";
										foreach ($childcategories as $chicat){
											if($patcat['ID'] == $chicat['PARENTID']){
												echo "<li><a href='/blog.php?category=".$chicat['TITLE']."'>".$chicat['TITLE']."</a></li>";
											}
										}
										echo "</ul>";
									}
								}?>
								</ul>
							</div>
						</div>
					</div>

					<!-- Side Widget Well -->
					<div class="well blogWidget">
							<div class="fb-page" data-href="<?echo FACEBOOK?>" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
								<blockquote cite="<?echo FACEBOOK?>" class="fb-xfbml-parse-ignore"><a href="<?echo FACEBOOK?>"></a></blockquote>
								</div>
					</div>

			</div>

	</div>
	<!-- /.row -->

	<hr>
