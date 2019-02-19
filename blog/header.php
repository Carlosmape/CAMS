<?php 
	require_once "cams/includes/config.php";
	require_once "cams/includes/sqlfunctions.php";
?>
<!DOCTYPE html>
<html lang="<?php echo LANGUAGE?>">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo DESCRIPTION?>">
    <meta name=”keywords” content="<?php echo DESCRIPTION?>"/>
    <meta name="author" content="CAMS">
    <link rel="shortcut icon" type="image/svg" href="blog/favicon.svg"/>
    

    <title><?php echo TITLE;?> | <?php
			if(isset($_GET['post']))
				echo urldecode($_GET['post']);
			else
				echo "Blog";
		?></title>

    <!-- Bootstrap Core CSS -->
    <link href="cams/includes/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="blog/css/blog.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>


<body>
	<div id="fb-root"></div>
	<script>
		(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.8&appId=244385435998528";
		fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
	
    <!-- Navigation -->
    <nav class="navbar navbar-fixed-top blogNavigator" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo HOST;?>"><?php echo TITLE;?></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
								<!-- Search form -->
								<form class="navbar-form navbar-right" action="" method="get">
									<div class="input-group">
											<input type="text" name="search" class="form-control">
											<span class="input-group-btn">
													<button class="btn btn-default" type="submit">
															<span class="glyphicon glyphicon-search"></span>
											</button>
											</span>
									</div>
								</form><!-- /search form -->
                <ul class="blogMenu nav navbar-nav navbar-right">
									<?php 
									$database = new Sqlconnection;//connect to database in order to extract users info
									if (isset($database))
										$menu = $database->getMenuPages();
									if (isset($menu))
										foreach($menu as $entry){?>
                    <li>
                        <a class="menuOption" href="/blog.php?post=<?php echo $entry['TITLE']?>"><?php echo $entry['TITLE']?></a>
                    </li>
									<?php }?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
            
        </div>
        <!-- /.container -->
    </nav>
