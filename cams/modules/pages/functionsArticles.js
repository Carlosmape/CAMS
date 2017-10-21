$("input#newArticle").click(function() {
	$.ajax({
		type: "post",
		url: "modules/pages/editor.php",
		data: $(this).val(),
		success: function(response){ //si recibimos respuesta, quitamos el anterior artículo y colocamos el uevo
			// log a message to the console
			 $(".main").empty();
			 $(".main").html(response);
		}
	});
});
$("input#articleSave").click(function(){
	var formData = $("form#article").serialize();
	formData=formData+"&articleText="+escape(CKEDITOR.instances['editor1'].getData().replace('\n', ''));
	//alert(formData);
	$.ajax({
		type: 'POST',
		url: 'modules/pages/saveArticle.php',
		data: formData,
		success:function(response){
			alert("response: "+response);
			$.ajax({//refreshing the page
				type: "post",
				url: "modules/pages/index.php",
				success: function(refresh){ //si recibimos respuesta, quitamos el anterior artículo y colocamos el uevo
					 $(".main").empty();
					 $(".main").html(refresh);
				}
			});
		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		}
	})
});
	$("a.editArticle").click(function() { //editing a user
		var userID = this.id.match(/\d+$/)[0];
		//alert(userID);
		$.ajax({
			type: 'POST',
			url: 'modules/pages/editor.php',
			data: {ID : userID},
			success: function(refresh){
				$(".main").empty();
				$(".main").html(refresh);
			}
		});
	});
	$("a.deleteArticle").click(function() { //editing a user
		var userID = this.id.match(/\d+$/)[0];
		//alert(userID);
		$('#deleteArticleModal').modal('show');
		$("button#Delete").click(function(){
			$('#deleteArticleModal').modal('hide');
			$('.modal-backdrop.fade.in').remove();
			$.ajax({
				type: 'POST',
				url: 'modules/pages/deleteArticle.php',
				data: {ID : userID},
				success:function(response){
					$.ajax({//refreshing the page
						type: "post",
						url: "modules/pages/index.php",
						success: function(refresh){ //si recibimos respuesta, quitamos el anterior artículo y colocamos el uevo
							 $(".main").empty();
							 $(".main").html(refresh);
						}
					}); 
				},
				error: function (xhr, ajaxOptions, thrownError) {
					alert(xhr.status);
					alert(thrownError);
				}
			})
		});
	});
