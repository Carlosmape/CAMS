<?php
	if (file_exists("install/index.php")){
		echo "Aun no ha terminado la instalación. Ejecute suip/INSTALL en su navegador";
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
