<?php
	if (file_exists("install/index.php")){
		echo "CAMS is not totally instaled on the host. Please end installation before try to navigate the website";
	}else{
		require "blog/header.php";
		
		if (isset($_GET['post'])){
			require "blog/post.php";
		}else{
			require "blog/blog.php";
		}
		
		require "blog/sidebar.php";
		require "blog/footer.php";
	}

?>
