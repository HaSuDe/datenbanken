$(document).ready(function() {
		console.log("Site loaded");
		var rowNmbr = 0;
		var originalContent;

		var list = document.getElementById('list');

/*		// save and clear List
		$("#saveList").on('click', function(e) {
			e.preventDefault();
			//localStorage.setItem('todoList', list.innerHTML);
			alertify.success("You have saved your list.");
		});
 */
		$("#clearList").on('click', function(e) {
			e.preventDefault();
			localStorage.clear();
			window.location.replace('home.php');
		});

		// Load prizes and look how many rows are there
		loadPrizes();
		rowNmbr = $('#myTable tbody').children('tr').length;

		// --------------------------- On click	----------------------------//	
		$(document).on('click', function(e) {

			/* ------------- Click on an editable table cell (article or amount) */
			if($(event.target).hasClass('editable')) {

				// vorherige Listener removen
				$(event.target).unbind('blur');
				$(event.target).unbind('keypress');
				$(event.target).unbind('keyup');
				$('#livesearch li').unbind('click');

				// nur wenn Text nicht leer ist origContent speichern
				if($(event.target).text() != "")
					originalContent = $(event.target).text(); 
				console.log(originalContent);

				// Text löschen
				$(event.target).text("");
				$(event.target).attr('contentEditable', 'true');
				$(event.target).focus();

				// Wenn nach dem Focus ein Key gepressed wird
				$(event.target).on('keypress', function(e) {
					// only when pressed field is article and div isn't already set
					if ($(event.target).hasClass('article')) {
						// if text is empty hide field
						if($(event.target).text() == "") 
							$('#livesearch').remove();
					}

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
					// if text is empty hide field	
					} else if ($(event.target).text() == ""){
						$('#chooseDiv').remove();

					// else show livesearch ---------------------------------------
					} else {
						// create div for result if not there
						if ($(event.target).parent().parent().children('div').length <= 0) {
							var div = '<div id="chooseDiv"><ul id="livesearch"></ul></div>';
							$(event.target).parent().after(div);
						}
						// fill with content
						showResult($(event.target).text());	
					}
				});
				
				// ------------------------ Wenn der Focus weg geht ----------------------//
				$(event.target).on('blur', function(e){

		    		// destroy livesearch div
		    		$('#chooseDiv').remove();

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
						var articleName = $(e.target).text();
						var tmpRow = $(e.target).parent().index();
						console.log(tmpRow);
							//tmpRow = tmpRow.match(/\d+/);
							rowNmbr = $('#myTable tbody').children('tr').length;
						getPrize(tmpRow, articleName, rowNmbr, true, e);						
					}

		    		// remove warningBox if there
		    		$(event.target).removeClass('warningBox');
		    	});
			/* ------------------ Click on market field --------------------------- */
		    } else if ($(event.target).hasClass('market')) {
		    	console.log("Choose Market");
		    	// create div for result if not there
		    }
		});

		/* ----------------------- Mousedown Event for LiveClick (fires before Blur) ---------------------------------- */
		$(document).mousedown(function(e) {
			// if mousedown is performed on LiElemnt in Livesearch
			if (event.target.tagName == "LI" && $(e.target).parent().parent().attr('id') == 'chooseDiv') {
				// fill table cell
				var cell2Fill = $(e.target).parent().parent().prev().children()[0]
				$(cell2Fill).text($(e.target).text());
			}
		});

		loadToDo();
});

function getPrize(row, articleN, rowNmbr, oriContent, clicked, e){
	console.log("getting Prize");
	// Change Prize and Market for Row
	console.log(articleN);
	$.get( "ajax/getBestPrize.php", {article: articleN}, function(data) {
		console.log(data[0]);
		$('#myTable td.prize:eq(' + row +')').text(data[0].prize);
		// if more then 1 row is returned make Markets selectable
		if (data.length > 1) {
			$('#myTable td.market:eq(' + row +')').text("");
			$('#myTable td.market:eq(' + row +')').append('<select></select>');
			for (var i = 0; i < data.length; i++) {
				$('#myTable td.market:eq(' + row +') select').append('<option>' + data[i].market + '</option>')
			}
			// set onChange listener to field
			$('#myTable td.market:eq(' + row +') select').on('change', function(e) {
				// get index 2 display right prize
				var sqlRowIndex = $(e.target).find('option:selected').index();
				console.log('#myTable td.prize:eq(' + row +')');
				$('#myTable td.prize:eq(' + (row-1) +')').text(data[sqlRowIndex].prize);
			})
		} else
			$('#myTable td.market:eq(' + row +')').text(data[0].market);

		// add new Row
		// just add new Row when there is no unfilled Row
		row = row+1;
		console.log("tmpRow: " + row + "rowNmbr: " + rowNmbr);
		if (row >= rowNmbr) {
			$('#myTable > tbody:first').append('<tr id="tableRow' + row + '"> <td class="editable article">Article</td> <td class="editable amount" >1</td>' + 
									   '<td class="prize">Prize</td> <td class="market">Market</td> </tr> </tbody>');
		}									
	}, 'json')
	// if something went wrong, give error message and reset text
	.fail(function(data) {
		alertify.error("Oops Something went wrong please try again! Maybe its just a typing mistake :)");
		if(clicked)
			$(e.target).text(oriContent);
		console.log("Something went wrong in getBestPrize.php. Maybe no entry found? Or just not connected in time.");
		console.log(data);
	})
}

function loadPrizes(){
	// get tbody
	var tbody = $('#myTable tbody');
	// call get Prize for every table row
	for(var i = 0; i < tbody.children('tr').length; i ++) {
		var row = tbody.children('tr')[i];
		if($(row).find('.article').text() != "Type here for new Article" && $(row).find('.prize').text() == "Prize") {
			var article = $(row).find('.article').text();
			getPrize(i, article, tbody.children('tr').length, false, null);
		}
	}
	
};

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
	  $('#livesearch').html(xmlhttp.responseText);;
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