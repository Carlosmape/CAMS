$("a.deleteFile").click(function() { //deleting a user
	var file = this.id;
	$('#deleteFileModal').modal('show');
	$("button#Delete").click(function(){
		$('#deleteFileModal').modal('hide');
		setTimeout(null,100);
		PerformAction("modules/files/deleteFile.php", {ID : file}, "modules/files/index.php")
	});
});
$("input#Upload").click(function() {
	var formData = new FormData($("form#form")[0])
	var files = $ ('#File' )[0].files[0];
	formData.append( 'file', files );
	$.ajax( {
		cache :fale,
		data : formData,
		url : "modules/files/uploadFile.php",
		type : 'post',
		processData : false,
		contentType : false,
		success:(function(response){
			var alertDiv = ComposeAlert("Server:",response);
			PerformTransaction("modules/files/index.php", null, alertDiv);
		})
	});
});
$("a.viewFile").click(function() { //deleting a user
	var url = this.id;
	$('#viewFileModal').modal('show');
  	$('#viewerFile').attr('src',url);
});


