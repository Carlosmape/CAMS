$("input#stylesSave").click(function(){
	var str = ""+$("#editorStyles")[0].value;
	//alert("Guardando...: "+str);
	$.ajax({
		type: "post",
		url: "modules/styles/saveStyles.php",
		data: {content : str},
		success: function(response){ //si recibimos respuesta, quitamos el anterior artículo y colocamos el uevo
			// log a message to the console
			//alert("Response: "+response);
			 //$(".main").empty();
			 $(".main").append(response);
		}
	});
});
