$(document).ready(function() {

	var listData;

	$.get( "php/getAllArticles.php", function(data) {
		// add all lists
		if (data.length <= 0) {
			$('#articleList').append('<h4>You dont have any lists yet, create one <a href="./home.php">here</a></h4');
		} else {
			listData = data;
			for (var i = 0; i < data.length; i++) {
				$('#articleList').append('<li class="list-group-item"> <a class="articleItem ' + data[i].id + '" >' + data[i].articleName + '</a></li>');
			}
		}						
	}, 'json')
	// if something went wrong, give error message
	.fail(function(data) {
		alertify.error("Oops Something went wrong please reload the page!");
		console.log(data);
	});
});


