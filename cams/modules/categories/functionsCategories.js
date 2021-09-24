$("input#Save").click(function() {
	var formData = $("form#form").serialize();
	if( $("form#form")[0].checkValidity()) {
		$.ajax({
			type: 'POST',
			url: 'modules/categories/createCategory.php',
			data: formData,
			success:function(response){
				$.ajax({
					type: "post",
					url: "modules/categories/index.php",
					success: function(refresh){
						$(".main").empty();
						$(".main").html(refresh);
						var alertDiv = ComposeAlert("Category", response);
						$(".main").append(alertDiv);
						AutoCloseAlerts();
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
$("a.editCategory").click(function() { 
	var catID = this.id.match(/\d+$/)[0];
	$("input#editID").val($("#rowID"+catID).html());
	$("input#editTitle").val($("#rowTitle"+catID).html());
	$("input#editParent").val($("#rowParent"+catID).html().replace("-","NULL"));
	$('#editCategoryModal').modal('show');
	$("button#Edit").click(function() {
		if($("form#editForm")[0].checkValidity()){
			$('#editCategoryModal').modal('hide');
			var formData = $("form#editForm").serialize();
			$.ajax({
				type: 'POST',
				url: 'modules/categories/editCategory.php',
				data: formData,
				success:function(response){
					$.ajax({
						type: "post",
						url: "modules/categories/index.php",
						success: function(refresh){ 
							$(".main").empty();
							$(".main").html(refresh);
							var alertDiv = ComposeAlert("Category", response);
							$(".main").append(alertDiv);
							AutoCloseAlerts();
						}
					}); 
				},
				error: function (xhr, ajaxOptions, thrownError) {
					alert(xhr.status);
					alert(thrownError);
				}
			})
		} else {
			$("form#editForm")[0].reportValidity();
		}	
	});
});	
$("a.deleteCategory").click(function() { 
	var catID = this.id.match(/\d+$/)[0];
	$('#deleteCategoryModal').modal('show');
	$("button#Delete").click(function(){
		$('#deleteCategoryModal').modal('hide');
		$.ajax({
			type: 'POST',
			url: 'modules/categories/deleteCategory.php',
			data: {ID : catID},
			success:function(response){
				$.ajax({
					type: "post",
					url: "modules/categories/index.php",
					success: function(refresh){ 
						$(".main").empty();
						$(".main").html(refresh);
						var alertDiv = ComposeAlert("Category", response);
						$(".main").append(alertDiv);
						AutoCloseAlerts();
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
