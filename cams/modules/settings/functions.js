$("input#submitsettings").click(function() {
	var formData = $("form#form").serialize();
	PerformAction("modules/settings/saveSettings.php", formData, "modules/settings/index.php");
});
