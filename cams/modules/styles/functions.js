$("input#stylesSave").click(function(){
	var str = ""+$("#editorStyles")[0].value;
	PerformAction("modules/styles/saveStyles.php", {content : str}, "modules/styles/index.php");
});
