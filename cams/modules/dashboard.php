<?php 
	/*
	 * Buttons functions are linked on /cams/includes/functions.js
	 * If you want to add one button must keep examples in here
	 * */
	 require_once "includes/class/connection.php";
	 require_once "includes/sqlfunctions.php";
	 require_once "modules/collector.php";
if (isset($_SESSION['connection']) && !$_SESSION['connection']->timeout()) { //you are connected
	$_SESSION['connection']->keepalive();
?>
      <nav class="navbar navbar-dark bg-dark fixed-top navbar-expand-lg justify-content-between">
				<a class="navbar-brand" href="<?php echo HOST;?>/cams/"><?php echo TITLE;?> panel</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
				<div id="cams-navbar-collapse-2" class="collapse navbar-collapse justify-content-end">
					<ul class="nav navbar-nav navbar-right">
						<?php if ($_SESSION['connection']->isAdmin()) { ?> 
							<li class="nav-item"><a class="nav-link"id="settings" href="#settings"><i class="material-icons"> settings </i></span> Settings</a></li>
							<li class="nav-item"><a class="nav-link" id="log" href="#log"><i class="material-icons">library_books</i></span> Log</a></li>
						<?php } ?>
						<li class="nav-item"><a class="nav-link" id="profile" href="#profile"><i class="material-icons">account_circle</i></span><?php echo " ".$_SESSION['connection']->user; if($_SESSION['connection']->isAdmin()) echo " (Admin)";?></a></li>
						<li class="nav-item"><a class="nav-link" href="<?php echo HOST.'/cams/modules/logout.php';?>"><i class="material-icons">exit_to_app</i> Logout</a></li>
					</ul>
				</div>
      </nav>

      <div class="container-fluid bg">
        <div class="row">
          <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav flex-column">
              <li class="nav-item"><a class="nav-link active" href="<?php echo HOST;?>/cams/"><i class="material-icons">dashboard</i></span> Overview</a></li>
              <?php if ($_SESSION['connection']->isAdmin()) { ?> 
								<li class="nav-item"><a class="nav-link" id="styles" href="#"><i class="material-icons">style</i></span> Styles</a></li>
								<li class="nav-item"><a class="nav-link" id="users" href="#"><i class="material-icons">supervised_user_circle</i></span> Users</a></li>
								<li class="nav-item"><a class="nav-link" id="pages" href="#"><i class="material-icons">insert_drive_file</i></span> Pages</a></li>
							<?php } ?>
              <li class="nav-item"><a class="nav-link" id="articles" href="#"><i class="material-icons">description</i></span> Articles</a></li>
              <li class="nav-item"><a class="nav-link" id="categories" href="#"><i class="material-icons">category</i></span> Categories</a></li>
              <li class="nav-item"><a class="nav-link" id="files" href="#"><i class="material-icons">folder_open</i></span> Files</a></li>
              <hr>
				<?php $plugins = collectPlugins();
					if (!empty($plugins)){
						foreach ($plugins as $plugin){ ?>
							<li class="nav-item"><a class="nav-link" id="<?php echo $plugin; ?>" href="#"><i class="material-icons">stars</i></span> <?php echo ucfirst($plugin); ?></a></li>
						<?php }
					} 
				?>
            </ul>
          </div>
          <div class="col-sm-9 col-md-10 main">
            <h1 class="page-header">Overview</h1>
            <?php
							$database = new Sqlconnection();
							if (isset($database))
							{
								?>
								<div class="row placeholders">
									<div class="col-xs-6 col-sm-4 col-md-2 placeholder text-center">
										<i class="material-icons" style="font-size: 48px;">supervised_user_circle</i> 
										<h4>Users</h4>
										<span class="text-muted"><?php echo mysqli_fetch_array($database->countUsers())[0]?></span>
									</div>
									<div class="col-xs-6 col-sm-4 col-md-2 placeholder text-center">
										<i class="material-icons" style="font-size: 48px;">insert_drive_file</i>
										<h4>Pages</h4>
										<span class="text-muted"><?php echo mysqli_fetch_array($database->countPages())[0]?></span>
									</div>
									<div class="col-xs-6 col-sm-4 col-md-2 placeholder text-center">
										<i class="material-icons" style="font-size: 48px;">description</i>
										<h4>Articles</h4>
										<span class="text-muted"><?php echo mysqli_fetch_array($database->countArticles())[0]?></span>
									</div>
									<div class="col-xs-6 col-sm-4 col-md-2 placeholder text-center">
										<i class="material-icons" style="font-size: 48px;">category</i>
										<h4>Categories</h4>
										<span class="text-muted"><?php echo mysqli_fetch_array($database->countCategories())[0]?></span>
									</div>
									<div class="col-xs-6 col-sm-4 col-md-2 placeholder text-center">
										<i class="material-icons" style="font-size: 48px;">save</i>
										<h4>Used space</h4>
										<span class="text-muted"><?php 
											function folderSize ($dir){
												$size = 0;
												foreach (glob(rtrim($dir, '/').'/*', GLOB_NOSORT) as $each) {
													$size += is_file($each) ? filesize($each) : folderSize($each);
													}
													return $size;
												}
												$bytes = folderSize("../../");
												$si_prefix = array( 'B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB' );
												$base = 1024;
												$class = min((int)log($bytes , $base) , count($si_prefix) - 1);
												echo sprintf('%1.2f' , $bytes / pow($base,$class)) . ' ' . $si_prefix[$class];
										?></span>
									</div>
								</div>
								<hr>
								<div class="row">	
									<div class="col-md-6 col-xs-12">
										<h2>Blog menu</h2>
										<div class="btn-group" role="group" aria-label="...">
										
											<?php 
											$menu = $database->getMenuPages();
											if(!empty(mysqli_fetch_array($menu))){
												foreach($menu as $pages){
													echo "<a target='_blank' href='/blog.php?post=".$pages['TITLE']."' type='button' class='btn btn-default'>".$pages['TITLE']."</a>";
												}
											}else{
												echo "<a type='button' class='btn btn-default'>No Pages found.</a>";
											}
											?>
										</div>
									</div>
									<div class="col-md-6 col-xs-12">
										<h2>Hidden pages</h2>
										<div class="btn-group" role="group" aria-label="...">
									
											<?php 
											$menu = $database->getHiddenPages();
											if(!empty(mysqli_fetch_array($menu))){
												foreach($menu as $pages){
													echo "<a target='_blank' href='/blog.php?post=".$pages['TITLE']."' type='button' class='btn btn-default'>".$pages['TITLE']."</a>";
												}
											}else{
												echo "<a type='button' class='btn btn-default'>No Hidden pages found.</a>";
											}
											?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					 <?php
							}else{
								echo "Error CAMS could not connect to your DATABASE";
							}
					?>
<?php
	}
?>
						
