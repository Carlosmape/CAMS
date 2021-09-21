$("input#Save").click(function() {
	var formData = $("form#form").serialize();
	//alert(formData);
	if$("form#form").checkValidity()) {
	$.ajax({
		type: 'POST',
		url: 'modules/users/createUser.php',
		data: formData,
		success:function(response){
			$.ajax({//refreshing the page
				type: "post",
				url: "modules/users/index.php",
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
}
});
$("a.editUser").click(function() { //editing a user
	//rellenamos el modal con los datos de este usuario
	var userID = this.id.match(/\d+$/)[0];
	$("input#editID").val($("#rowID"+userID).html());
	$("input#editUser").val($("#rowUser"+userID).html());
	$("input#editMail").val($("#rowMail"+userID).html());
	$("input#editType").val($("#rowType"+userID).html());
	$('#editUserModal').modal('show');
	$("button#Edit").click(function() {
		$('#editUserModal').modal('hide');
		$('.modal-backdrop.fade.in').remove();
		var formData = $("form#editForm").serialize();
		//alert(formData);
		$.ajax({
			type: 'POST',
			url: 'modules/users/editUser.php',
			data: formData,
			success:function(response){
				$.ajax({//refreshing the page
					type: "post",
					url: "modules/users/index.php",
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
$("a.deleteUser").click(function() { //deleting a user
	var userID = this.id.match(/\d+$/)[0];
	//alert(userID);
	$('#deleteUserModal').modal('show');
	$("button#Delete").click(function(){
		$('#deleteUserModal').modal('hide');
		$('.modal-backdrop.fade.in').remove();
		$.ajax({
			type: 'POST',
			url: 'modules/users/deleteUser.php',
			data: {ID : userID},
			success:function(response){
				$.ajax({//refreshing the page
					type: "post",
					url: "modules/users/index.php",
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
