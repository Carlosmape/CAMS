$("input#newArticle").click(function() {
	PerformTransaction("modules/articles/editor.php", $(this).val());
});
$("input#articleSave").click(function(){
	var formData = $("form#article").serialize();
	formData=formData+"&articleText="+escape(CKEDITOR.instances['editor1'].getData().replace('\n', ''));
	PerformAction("modules/articles/saveArticle.php", formData,"modules/articles/index.php")
});
$("a.editArticle").click(function() { //editing a user
	PerformTransaction("modules/articles/editor.php",  {ID : userID});
});
$("a.deleteArticle").click(function() { //editing a user
	var userID = this.id.match(/\d+$/)[0];
	//alert(userID);
	$('#deleteArticleModal').modal('show');
	$("button#Delete").click(function(){
		$('#deleteArticleModal').modal('hide');
		setTimeout(null,100);
		PerformAction("modules/articles/deleteArticle.php", {ID : userID}, "modules/articles/index.php");
	});
});
