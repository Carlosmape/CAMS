$("input#newArticle").click(function() {
	PerformTransaction("modules/pages/editor.php", $(this).val())
});
$("input#articleSave").click(function(){
	var formData = $("form#article").serialize();
	formData=formData+"&articleText="+escape(CKEDITOR.instances['editor1'].getData().replace('\n', ''));
	PerformAction("modules/pages/saveArticle.php", formData, "modules/pages/index.php")
});
$("a.editArticle").click(function() { 
	var pageID = this.id.match(/\d+$/)[0];
	PerformTransaction("modules/pages/editor.php", {ID : pageID})
});
$("a.deleteArticle").click(function() { 
	var pageID = this.id.match(/\d+$/)[0];
	$('#deleteArticleModal').modal('show');
	$("button#Delete").click(function(){
		$('#deleteArticleModal').modal('hide');
		setTimeout(null,100);
		PerformAction("modules/pages/deleteArticle.php", {ID : pageID}, "modules/pages/index.php");
	});
});
