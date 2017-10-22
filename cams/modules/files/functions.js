$("a.deleteFile").click(function() { //deleting a user
	var file = this.id;
	$('#deleteFileModal').modal('show');
	$("button#Delete").click(function(){
		$('#deleteFileModal').modal('hide');
		$('.modal-backdrop.fade.in').remove();
		$.ajax({
			type: 'POST',
			url: 'modules/files/deleteFile.php',
			data: {ID : file},
			success:function(response){
				//alert(response);
				$.ajax({//refreshing the page
					type: "post",
					url: "modules/files/index.php",
					success: function(refresh){ //si recibimos respuesta, quitamos el anterior artículo y colocamos el uevo
						 $(".main").empty();
						 $(".main").html(refresh);
					}
				}); 
			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status);
				alert(thrownError);
			}
		})
	});
});

$("a.viewFile").click(function() { //deleting a user
	var url = this.id;
	//alert(userID);
	$('#viewFileModal').modal('show');
  $('#viewerFile').attr('src',url);
	
});


