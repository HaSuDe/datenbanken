$(document).ready(function() {

	$(document).on('click', function(e) {
		if($(e.target).hasClass('marketChooser')) {
			var market = $(e.target).text().replace(/\:.*/,'');
			$('#marketFinder').val(market);
			$('#findMarketM').modal('hide');
		}
	});

	$('#marketFinder').on('click', function(e) {
		$('#findMarketM').modal();
	});

	$(document).on('keyup', function(e) {
		if($(e.target).hasClass("modalSearch")) {
			findMarkets();
		}
	});



	function findMarkets() {
		$.post( "ajax/findMarkets.php", $('#modalSearch').serialize(), function(data) {
			// list to be added to
			var list = $('#marketList');
			$(list).children('li').remove()
			// add every result set as li to the result list
			for(var i = 0; i<data.length; i++) {
				list.append('<li class=marketChooser>' + data[i]['id']+ ": " + data[i]['name'] + ', ' + data[i]['country'] + ' ' +  data[i]['code'] + ' ' + data[i]['city'] + ' ' + data[i]['street'] + '</li>');
			}
		}, 'json')
		.fail(function(data) {
			alertify.error("Error while loading markets. Please try again");
			console.log(data);
		});
	}
});