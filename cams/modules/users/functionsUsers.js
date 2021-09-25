$("input#Save").click(function() {
	var formData = $("form#form").serialize();
	if( $("form#form")[0].checkValidity()) {
		PerformAction("modules/users/createUser.php", formData, "modules/users/index.php");
	}else{
		$("form#form")[0].reportValidity();
	}
});
$("a.editUser").click(function() { 
	var userID = this.id.match(/\d+$/)[0];
	$("input#editID").val($("#rowID"+userID).html());
	$("input#editUser").val($("#rowUser"+userID).html());
	$("input#editMail").val($("#rowMail"+userID).html());
	$("input#editType").val($("#rowType"+userID).html());
	$('#editUserModal').modal('show');
	$("button#Edit").click(function() {
		$('#editUserModal').modal('hide');
		setTimeout(null,100);
		var formData = $("form#editForm").serialize();
		PerformAction("modules/users/editUser.php", formData, "modules/users/index.php");
	});
});	
$("a.deleteUser").click(function() { //deleting a user
	var userID = this.id.match(/\d+$/)[0];
	//alert(userID);
	$('#deleteUserModal').modal('show');
	$("button#Delete").click(function(){
		$('#deleteUserModal').modal('hide');
		setTimeout(null,100);
		PerformAction("modules/users/deleteUser.php", {ID : userID}, "modules/users/index.php");
	});
});
