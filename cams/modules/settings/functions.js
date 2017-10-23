$("input#submitsettings").click(function() {
	var formData = $("form#form").serialize();
	$.ajax({
		type: 'POST',
		url: 'modules/settings/saveSettings.php',
		data: formData,
		success:function(response){
			$(".main").append(response);
		},
	})
});
