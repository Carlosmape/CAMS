$("input#EditProfile").click(function() {
	var formData = $("form#editForm").serialize();
	PerformAction("modules/profile/editProfile", formData, "modules/profile/index.php");
});	
