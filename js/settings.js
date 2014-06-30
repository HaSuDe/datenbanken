$(document).ready(function() {
	console.log("Site loaded");
	var findMIndex = 0;
	loadValues();

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
			$('#marketForm').children('div:last').before(
				'<div class="form-group">' +
                    '<label class="col-md-2 control-label"></label>' +
                        '<div class="col-md-8">'+
                        	'<input class="form-control" type="text" placeholder="MarketName">' +
                        '</div>' +
                        '<div class="col-md-2">' +
                        	'<input type="button" class="btn btn-default findM" value="Find Market">'+
                        '</div>'+
                      '</div>')

		} else if (e.target.id === "saveMarketBtn") {
			saveMarkets();
			console.log();

		} else if (e.target.id === "cancelMarketBtn") {
			window.location.replace('settings.php');
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

	function loadValues() {
		var userName = $('#userName').text();
		console.log(userName);

	    $.post( 'php/loadUserData.php',{user : userName}, function(data) {
	        // if post was successful
	        console.log(data);
	        
	        var uName = $('#userName');
	        var uEmail = $('#userEmail');
	        var uCity = $('#userCity');
	        var uCode = $('#userCode');
	        var uAdress = $('#userAdress');
	        
	        uName.val(data['name']);
	        uEmail.val(data['email']);
	        uCity.val(data['city']);
	        uCode.val(data['code']);
	        uAdress.val(data['adress']);
	        
	        }, 'json') // I expect a JSON response
	    .fail(function (data) {
	        // if post had an error
	        console.log('Failed to save other Fields in DB' +data);
	        console.log(data);
	    });
	}

	function saveMarkets() {
		var allInputs = $('#marketForm').children().children().children('input[type=text]');
		var success = false;
		$.each(allInputs, function(index) {
			$.post( "php/saveMarket.php", {marketID : $(this).val().replace(/\:.*/,''), user : $('#userName').text()}, function(data) {
				console.log("success");
				success = true;
			}, 'json')
			.fail(function(data) {
				alertify.error("Error while saving markets. Please try again");
				console.log(data);
				success = false;
				return false;
			});
			if(success)
				alertify.success("Saved all Markets");
		});
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
				list.append('<li class=marketChooser>' + data[i]['id'] + ': "' + data[i]['name'] + ', ' + data[i]['country'] + ' ' +  data[i]['code'] + ' ' + data[i]['city'] + ' ' + data[i]['street'] + '</li>');
			}
		}, 'json')
		.fail(function(data) {
			alertify.error("Error while loading markets. Please try again");
			console.log(data);
		});
	}
});