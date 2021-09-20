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

		?>
		<script>
		window.onload = function() {
<?php function createPluginLink($item){ ?>
			$("a#<?php echo $item; ?>").click(function(){
				//alert("Accediendo a <?php echo $item; ?>");
				$.ajax({
					type: "post",
					url: "plugins/<?php echo $item; ?>/index.php",
					data: $(this).val(),
					success: function(response){ //si recibimos respuesta, quitamos el anterior artículo y colocamos el uevo
						//alert("Hecho");
						// log a message to the console
						 $(".main").empty();
						 $(".main").html(response);
						 $("table.table").tablesorter();
					}

				});
			});
		}
		</script> <?php
	}
?>
