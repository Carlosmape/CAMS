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
function AutoCloseAlerts(){
	$(".alert").delay(5000).slideUp(500, function() {
		$(this).remove();
	});
}
function PerformTransaction(toURL, withData = null, alertDiv = null){
	$.ajax({
		type: "post",
		url: toURL,
		data: withData,
		success: function(response){
			$(".main").empty();
			$(".main").html(response);
			if(alertDiv){
				$(".main").append(alertDiv);
				AutoCloseAlerts();
			}
			$("table.table").tablesorter();
		},
		error: function (xhr, ajaxOptions, thrownError) {
			console.log(xhr.status);
			console.log(thrownError);
		}
	})
}

function PerformAction(toURL, withData, refreshURL){
	$.ajax({
		type: "post",
		url: toURL,
		data: withData,
		success: function(response){
			var alertDiv = ComposeAlert("Server:", response);
			PerformTransaction(refreshURL, null, alertDiv);
		},
		error: function (xhr, ajaxOptions, thrownError) {
			console.log(xhr.status);
			console.log(thrownError);
		}
	})
}

$("a#profile").click(function(){
	PerformTransaction("modules/profile/index.php");
});
$("a#settings").click(function(){
	PerformTransaction("modules/settings/index.php");
});
$("a#log").click(function(){
	PerformTransaction("modules/record.php");
});
$("a#users").click(function(){
	PerformTransaction("modules/users/index.php");
});
$("a#roles").click(function(){
	PerformTransaction("modules/roles/index.php");
});
$("a#pages").click(function(){
	PerformTransaction("modules/pages/index.php");
});
$("a#articles").click(function(){
	PerformTransaction("modules/articles/index.php");
});
$("a#categories").click(function(){
	PerformTransaction("modules/categories/index.php");
});
$("a#files").click(function(){
	PerformTransaction("modules/files/index.php");
});
$("a#styles").click(function(){
	PerformTransaction("modules/styles/index.php");
});
