$(document).ready(function() {
		var rowNmbr = 0;

		var list = document.getElementById('list');
		// save and clear List
		$("#saveList").on('click', function(e) {
			e.preventDefault();
			//localStorage.setItem('todoList', list.innerHTML);
			alertify.success("You have saved your list.");
		});
		$("#clearList").on('click', function(e) {
			e.preventDefault();
			localStorage.clear();
			location.reload();
		});

// --------------------------- On click	----------------------------//	
		$(document).on('click', function(e) {

			if($(event.target).hasClass('editable')) {

				// vorherige Listener removen
				$(event.target).unbind('blur');
				$(event.target).unbind('keypress');
				$(event.target).unbind('keyup');

				var originalContent = $(event.target).text(); 
				console.log(originalContent);

				// Text löschen
				$(event.target).html("");

				$(event.target).attr('contentEditable', 'true');

				$(event.target).focus();

				// Wenn nach dem Focus ein Key gepressed wird
				$(event.target).on('keypress', function(e) {
					var code = e.keyCode || e.which;
					// Confirm with enter
					if(code == 13) { //Enter keycode
						// just remove editable blur will be called then
						$(event.target).removeAttr('contentEditable');
						
					} else if(code == 37) { // left Arrow 

					} else if(code == 38) { // up Arrow

					} else if(code == 39) { // right Arrow

					} else if(code == 40) { // down Arrow

					} else return;

				});

				// ----------- After klick on editable table field keyup ---------------//
				$(event.target).on('keyup', function(e) {
					if($(event.target).hasClass('amount')) {
						var text = $(event.target).text();
						if (text.match(/[^0-9]/)) {
							console.log("das ist keine Zahl");
							$(event.target).addClass('warningBox');
						} else {
							$(event.target).removeClass('warningBox');
						}
					} else {
						showResult($(event.target).text());
					}
				});
				
				// ------------------------ Wenn der Focus weg geht ----------------------//
				$(event.target).blur(function(){
		    		// if no Text reset text
		    		if($(event.target).text() == "") {
		    			console.log(originalContent);
		    			$(event.target).text(originalContent);
		    		// if amount then check if every key is a number else reset text
		    		} else if($(event.target).hasClass('amount')) {
		    			var text = $(event.target).text()
						if (text.match(/[^0-9]/)) {
							console.log("das ist keine Zahl");
							$(event.target).text(originalContent);
							
						}
					// else try to set the new text and fill in the best prize and the market
		    		} else {
						var articleName = $(event.target).text();
						// Change Prize and Market for Row
						$.get( "ajax/getBestPrize.php", {article: articleName}, function(data) {
							$('#myTable td.prize:eq(' + rowNmbr +')').text(data.prize);
							$('#myTable td.market:eq(' + rowNmbr +')').text(data.market);
							// add new Row
							// just add new Row when there is no unfilled Row
							var tmpRow = $(e.target).parent().attr('id');
							tmpRow = tmpRow.match(/\d+/);
							console.log("tmpRow: " + tmpRow + "rowNmbr: " + rowNmbr);
							if (tmpRow <= rowNmbr) {
								$('#myTable > tbody:first').append('<tr id="tableRow' + rowNmbr + '"> <td class="editable article">Article</td> <td class="editable amount" >1</td>' + 
														   '<td class="prize">Prize</td> <td class="market">Market</td> </tr> </tbody>');
								rowNmbr++;
							}									
						}, 'json')
						// if something went wrong, give error message and reset text
						.fail(function(data) {
							alertify.error("Oops Something went wrong please try again!");
							$(e.target).text(originalContent);
							console.log("Something went wrong in getBestPrize.php. Maybe no entry found?");
							console.log(data);
						})
					}
					// remove warningBox if there
		    		$(event.target).removeClass('warningBox');
		    		$('#livesearch').html("");
					$('#livesearch').css("border, 0px");
		    	});
		    }
		});

		loadToDo();
});


function showResult(str) {
	if (str.length==0) {
	$('#livesearch').html("");
	$('#livesearch').css("border, 0px");
	return;
	}
	if (window.XMLHttpRequest) {
	// code for IE7+, Firefox, Chrome, Opera, Safari
	xmlhttp=new XMLHttpRequest();
	} else {  // code for IE6, IE5
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	  $('#livesearch').html(xmlhttp.responseText);
	  $('#livesearch').css("border, 1px solid #A5ACB2");
	}
	}
	xmlhttp.open("GET","livesearch.php?q="+str,true);
	xmlhttp.send();
};

function loadToDo() {
	if (localStorage.getItem('todoList')){
		list.innerHTML = localStorage.getItem('todoList'); 
	}
};