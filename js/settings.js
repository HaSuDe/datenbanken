$(document).ready(function() {
	console.log("Site loaded");
	var findMIndex = 0;

	$(document).on('click', function(e) {

		// find market btn
		if ($(e.target).hasClass('findM')) {
			console.log('Click on Find');
			$('#findMarketM').modal();
			findMIndex = $(e.target).parent().parent().index();
			console.log(findMIndex);
		} else if (e.target.id === "savePersonalBtn") {
			changePersonalSettings();
		} else if (e.target.id === "addMarketBtn") {

		} else if (e.target.id === "saveMarketBtn") {

		} else if (e.target.id === "cancelMarketBtn") {
		} else if ($(e.target).hasClass('marketChooser')) {
			var market = $(e.target).text();
			var inputField = $('#marketForm').children('div:eq(' + findMIndex + ')').children('div').children('input[type=text]');
			$(inputField).val(market);
			$('#findMarketM').modal('hide');
			$('input.modalSearch').val("");
		}
	});

	$(document).on('keyup', function(e) {
		if($(e.target).hasClass("modalSearch")) {
			findMarkets();
		}
	});

	function loadValues(username) {

	}

	function changePersonalSettings() {
		// get username
		var user = $('#userName').text();
		console.log(user);
		$.post( "php/updateUserData.php", $('#personalForm').serialize(), function(data) {
			alertify.success("You have saved your changings successfully");
		}, 'json')
		.fail(function(data) {
			alertify.error("Error while saving user data. Please try again.");
			console.log(data);
		}); 

		
	}

	function findMarkets() {
		$.post( "ajax/findMarkets.php", $('#modalSearch').serialize(), function(data) {
			// list to be added to
			var list = $('#marketList');
			$(list).children('li').remove()
			// add every result set as li to the result list
			for(var i = 0; i<data.length; i++) {
				list.append('<li class=marketChooser>' + data[i]['name'] + ', ' + data[i]['country'] + ' ' +  data[i]['code'] + ' ' + data[i]['city'] + ' ' + data[i]['street'] + '</li>');
			}
		}, 'json')
		.fail(function(data) {
			alertify.error("Error while loading markets. Please try again");
			console.log(data);
		});
	}
});