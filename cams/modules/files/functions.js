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
	PerformAction("modules/files/uploadFile.php", formData, "modules/files/index.php");
});
$("a.viewFile").click(function() { //deleting a user
	var url = this.id;
	$('#viewFileModal').modal('show');
  	$('#viewerFile').attr('src',url);
});


