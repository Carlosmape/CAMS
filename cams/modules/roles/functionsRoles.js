$("input#Save").click(function() {
	var formData = $("form#form").serialize();
	if( $("form#form")[0].checkValidity()) {
		PerformAction("modules/roles/createRole.php", formData, "modules/roles/index.php");
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
		setTimeout(null,100);
		var formData = $("form#editForm").serialize();
		PerformAction("modules/roles/editRole.php", formData, "modules/roles/index.php");
	});
});	
$("a.deleteRole").click(function() { //deleting a role
	var roleID = this.id.match(/\d+$/)[0];
	//alert(roleID);
	$('#deleteRoleModal').modal('show');
	$("button#Delete").click(function(){
		$('#deleteRoleModal').modal('hide');
		setTimeout(null,100);
		PerformAction("modules/roles/deleteRole.php", {ID : roleID}, "modules/roles/index.php");
	});
});
