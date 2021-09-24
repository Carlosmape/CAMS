
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="includes/js/jquery-3.1.1.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="includes/js/bootstrap.min.js"></script>
	<script src="includes/js/bootstrap.bundle.min.j"></script>
	<script src="includes/js/ckeditor/ckeditor.js"></script> <!--Textarea plugin-->
	<script src="includes/js/tablesorter/jquery.tablesorter.js"></script> <!--Textarea plugin-->
	<script src="includes/js/tablesorter/addons/pager/jquery.tablesorter.pager.js"></script> <!--Textarea plugin-->
	<script src="includes/js/functions.js"></script>
	<?php require_once "modules/collector.php";
	$plugins = collectPlugins();
	if (!empty($plugins)){ ?>
		<script>
		<?php foreach ($plugins as $plugin){ 
			createPluginLink($plugin);
		} ?>
		</script>
	<?php } ?>
</body>
</html>
