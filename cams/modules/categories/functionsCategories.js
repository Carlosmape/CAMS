$("input#Save").click(function() {
	var formData = $("form#form").serialize();
	if( $("form#form")[0].checkValidity()) {
		PerformAction("modules/categories/createCategory.php", formData, "modules/categories/index.php");
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
			setTimeout(null,100);
			var formData = $("form#editForm").serialize();
			PerformAction("modules/categories/editCategory.php", formData, "modules/categories/index.php");
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
		setTimeout(null,100);
		PerformAction("modules/categories/deleteCategory.php", {ID : catID}, "modules/categories/index.php")
	});
});
