//window.onload = function() {
/*$("table.table") 
  .tablesorter({widthFixed: true, widgets: ['zebra']}) 
  .tablesorterPager({container: $("#pager")}); */    
function ComposeAlert(section, action, error = false, errorMessage = "" ) {
	var alertClass;
	var operationResult;
	if(error){
		alertClass = "alert-danger";
		operationResult = "Error!";
	}else{
		alertClass = "alert-success";
		operationResult = "Done!";
	}

	return `<div class="col-md-12 alert ${alertClass} alert-dismissible fade show" role="alert">
				<strong>${operationResult}</strong> ${section} ${action} <i>${errorMessage}</i>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>		
			</div>`;
}
$("a#profile").click(function(){
	$.ajax({
		type: "post",
		url: "modules/profile/index.php",
		data: $(this).val(),
		success: function(response){ //si recibimos respuesta, quitamos el anterior artículo y colocamos el uevo
			// log a message to the console
			$(".main").empty();
			$(".main").html(response);

		}

	});
});
$("a#settings").click(function(){
	$.ajax({
		type: "post",
		url: "modules/settings/index.php",
		data: $(this).val(),
		success: function(response){ //si recibimos respuesta, quitamos el anterior artículo y colocamos el uevo
			// log a message to the console
			$(".main").empty();
			$(".main").html(response);

		}

	});
});
$("a#log").click(function(){
	$.ajax({
		type: "post",
		url: "modules/record.php",
		data: $(this).val(),
		success: function(response){ //si recibimos respuesta, quitamos el anterior artículo y colocamos el uevo
			// log a message to the console
			$(".main").empty();
			$(".main").html(response);

		}

	});
});
$("a#users").click(function(){
	$.ajax({
		type: "post",
		url: "modules/users/index.php",
		data: $(this).val(),
		success: function(response){ //si recibimos respuesta, quitamos el anterior artículo y colocamos el uevo
			// log a message to the console
			$(".main").empty();
			$(".main").html(response);
			$("table.table").tablesorter();
		}

	});
});
$("a#roles").click(function(){
	$.ajax({
		type: "post",
		url: "modules/roles/index.php",
		data: $(this).val(),
		success: function(response){ //si recibimos respuesta, quitamos el anterior artículo y colocamos el uevo
			// log a message to the console
			$(".main").empty();
			$(".main").html(response);
			$("table.table").tablesorter();
		}

	});
});
$("a#pages").click(function(){
	$.ajax({
		type: "post",
		url: "modules/pages/index.php",
		data: $(this).val(),
		success: function(response){ //si recibimos respuesta, quitamos el anterior artículo y colocamos el uevo
			// log a message to the console
			$(".main").empty();
			$(".main").html(response);
			$("table.table").tablesorter();
		}

	});
});
$("a#articles").click(function(){
	$.ajax({
		type: "post",
		url: "modules/articles/index.php",
		data: $(this).val(),
		success: function(response){ //si recibimos respuesta, quitamos el anterior artículo y colocamos el uevo
			// log a message to the console
			$(".main").empty();
			$(".main").html(response);
			$("table.table").tablesorter();
		}

	});
});
$("a#categories").click(function(){
	$.ajax({
		type: "post",
		url: "modules/categories/index.php",
		data: $(this).val(),
		success: function(response){ //si recibimos respuesta, quitamos el anterior artículo y colocamos el uevo
			// log a message to the console
			$(".main").empty();
			$(".main").html(response);
			$("table.table").tablesorter();

		}

	});
});
$("a#files").click(function(){
	$.ajax({
		type: "post",
		url: "modules/files/index.php",
		data: $(this).val(),
		success: function(response){ //si recibimos respuesta, quitamos el anterior artículo y colocamos el uevo
			// log a message to the console
			$(".main").empty();
			$(".main").html(response);
			$("table.table").tablesorter();

		}

	});
});
$("a#styles").click(function(){
	$.ajax({
		type: "post",
		url: "modules/styles/index.php",
		data: $(this).val(),
		success: function(response){ //si recibimos respuesta, quitamos el anterior artículo y colocamos el uevo
			// log a message to the console
			$(".main").empty();
			$(".main").html(response);
			//$("table.table").tablesorter();
		}

	});
});
//};
