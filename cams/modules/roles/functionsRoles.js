$("input#Save").click(function() {
	var formData = $("form#form").serialize();
	//alert(formData);
	if( $("form#form")[0].checkValidity()) {
	$.ajax({
		type: 'POST',
		url: 'modules/roles/createRole.php',
		data: formData,
		success:function(response){
			$.ajax({//refreshing the page
				type: "post",
				url: "modules/roles/index.php",
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
	}else{
		$("form#form")[0].reportValidity();
	}
});
$("a.editRole").click(function() { //editing a role
	//rellenamos el modal con los datos de este usuario
	var roleID = this.id.match(/\d+$/)[0];
	$("input#editID").val($("#rowID"+roleID).html());
	$("input#editRole").val($("#rowRole"+roleID).html());
	$("input#editMail").val($("#rowMail"+roleID).html());
	$("input#editType").val($("#rowType"+roleID).html());
	$('#editRoleModal').modal('show');
	$("button#Edit").click(function() {
		$('#editRoleModal').modal('hide');
		$('.modal-backdrop.fade.in').remove();
		var formData = $("form#editForm").serialize();
		//alert(formData);
		$.ajax({
			type: 'POST',
			url: 'modules/roles/editRole.php',
			data: formData,
			success:function(response){
				$.ajax({//refreshing the page
					type: "post",
					url: "modules/roles/index.php",
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
$("a.deleteRole").click(function() { //deleting a role
	var roleID = this.id.match(/\d+$/)[0];
	//alert(roleID);
	$('#deleteRoleModal').modal('show');
	$("button#Delete").click(function(){
		$('#deleteRoleModal').modal('hide');
		$('.modal-backdrop.fade.in').remove();
		$.ajax({
			type: 'POST',
			url: 'modules/roles/deleteRole.php',
			data: {ID : roleID},
			success:function(response){
				$.ajax({//refreshing the page
					type: "post",
					url: "modules/roles/index.php",
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
