$("input#EditProfile").click(function() {
	var formData = $("form#editForm").serialize();
	//alert(formData);
	$.ajax({
		type: 'POST',
		url: 'modules/profile/editProfile.php',
		data: formData,
		success:function(response){
			var alertDiv = ComposeAlert("Profile", response);
			$(".main").append(alertDiv);
			AutoCloseAlerts();
		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		}
	});
});	
