$("input#Save").click(function() {
	var formData = $("form#form").serialize();
	if( $("form#form")[0].checkValidity()) {
		$.ajax({
			type: 'POST',
			url: 'modules/categories/createCategory.php',
			data: formData,
			success:function(response){
				$.ajax({//refreshing the page
					type: "post",
					url: "modules/categories/index.php",
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
$("a.editCategory").click(function() { //editing a user
	//rellenamos el modal con los datos de este usuario
	var userID = this.id.match(/\d+$/)[0];
	$("input#editID").val($("#rowID"+userID).html());
	$("input#editTitle").val($("#rowTitle"+userID).html());
	$("input#editParent").val($("#rowParent"+userID).html().replace("-","NULL"));
	$('#editCategoryModal').modal('show');
	$("button#Edit").click(function() {
		$('#editCategoryModal').modal('hide');
		var formData = $("form#editForm").serialize();
		$.ajax({
			type: 'POST',
			url: 'modules/categories/editCategory.php',
			data: formData,
			success:function(response){
				$.ajax({//refreshing the page
					type: "post",
					url: "modules/categories/index.php",
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
$("a.deleteCategory").click(function() { //deleting a user
	var catID = this.id.match(/\d+$/)[0];
	$('#deleteCategoryModal').modal('show');
	$("button#Delete").click(function(){
		$('#deleteCategoryModal').modal('hide');
		$.ajax({
			type: 'POST',
			url: 'modules/categories/deleteCategory.php',
			data: {ID : catID},
			success:function(response){
				$.ajax({//refreshing the page
					type: "post",
					url: "modules/categories/index.php",
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
