<?php
	require_once "cams/includes/sqlfunctions.php";
	if (isset($_GET['post'])){
		$database = new Sqlconnection;//connect to database in order to extract users info
		if (isset($database)){
			$article = $database->getArticleByTITLE($_GET['post']);
			if (!$article){
				require "error/index.php";
			}else{
				while($row = mysqli_fetch_array($article)){
?>
					<!-- Open Graph metadata -->
          <meta property="og:title" content="<?php echo TITLE?>|<?$row['TITLE']?>" />
          <meta property="og:site_name" content="<?php echo TITLE?>" />
					<meta property="og:type" content="article" />
					<meta property="article:published_time" content="<?php echo $row['DATE']?>" />
					<meta property="og:url" content="<?php echo DOMAIN?>/blog.php?post=<?php echo urlencode($row['TITLE'])?>" />
					<meta property="og:image" content="<?php $row['IMAGEHEADER']?>" />
					<meta property="og:locale" content="<?php echo LANGUAGE?>" />
					<!-- Blog Post Content Column -->
          <div class="container">
            <div class="col-md-9">

                <!-- Blog Post -->

                <!-- Title -->
                <h1 class="articleTitle"><?php echo $row['TITLE'];?></h1>
                <?php
								if ($row['TYPE']!=0){?>
									<p class="articleDate"><span class="glyphicon glyphicon-time"></span><?php echo $row['DATE']?></p>
								<?php }?>
                <!-- Preview Image -->
                <img class="img-responsive articleImage" src="<?php echo $row['IMAGEHEADER']?>" alt="">

                <hr>

                <!-- Post Content -->
                <div class="articleContent"><?php echo $row['CONTENT']?></div>

                <!-- Blog Comments -->
                <!-- Comments Form -->
								<?php if ($row['TYPE']==1){	?>
									<hr>
									<div class="well">
										<div class="fb-comments" data-width="100%" data-href="<?php echo FACEBOOK?>/<?php echo $row['TITLE'] ?>" data-numposts="5"></div>
                	</div>
									<hr>
								<?php } ?>
            </div>
<?php			}//end while
			}
		}else{
			echo "Error CAMS could not connect to your DATABASE";
		}

	}else{
		echo "Ups!";
	}
?>
