<?php
function collectPlugins(){
	$contenido = scandir('plugins/');
	//var_dump($contenido);
	$plugins = array();
	foreach ($contenido as $item){
		if (is_dir("plugins/$item") && $item!="." && $item!=".."){
			array_push($plugins, "$item");
		}
	}
	return $plugins;
}

function createPluginLink($item){ ?>
	$("a#<?php echo $item; ?>").click(function(){
		$.ajax({
		type: "post",
			url: "plugins/<?php echo $item; ?>/index.php",
			data: $(this).val(),
			success: function(response){ 	
				// log a message to the console
				$(".main").empty();
				$(".main").html(response);
				$("table.table").tablesorter();
			}
		});
	});
<?php }	?>
