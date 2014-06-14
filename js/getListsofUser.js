$(document).ready(function() {

	var listData;

	$.get( "ajax/getListsofUser.php", function(data) {
		// add all lists
		if (data.length <= 0) {
			$('#userlists').append('<h4>You dont have any lists yet, create one <a href="./home.php">here</a></h4');
		} else {
			listData = data;
			for (var i = 0; i < data.length; i++) {
				console.log(data[i].listName);
				$('#userlists').append('<li class="list-group-item"> <a href="./home.php?listID=' + data[i].id + '" class="listname">' + data[i].listName + '</a></li>');
			}
		}						
	}, 'json')
	// if something went wrong, give error message
	.fail(function(data) {
		alertify.error("Oops Something went wrong please reload the page!");
		console.log(data);
	})
});