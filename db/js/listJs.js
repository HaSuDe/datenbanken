$(document).ready(function() {
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

		setListeners();

		loadToDo();
});

// Listeners für Events setzen
function setListeners() {
	$("td.editable").on('click', function(e) {

		var originalContent = $(this).text(); 

		$(this).unbind('keypress');

		// Text löschen
		$(this).html("");

		$(this).attr('contentEditable', 'true');

		$(this).focus();

		// Wenn nach dem Focus ein Key gepressed wird
		$(this).on('keypress', function(e) {
			var code = e.keyCode || e.which;
			// Confirm with enter
			if(code == 13) { //Enter keycode
				$(this).removeAttr('contentEditable');
				
				if($(this).text() != "") {
					$('#myTable > tbody:first').append('<tr><td class="editable">Article</td><td class="editable">1</td> <td>Prize</td> <td>Market</td></tr>');
					setListeners();
				} else {
					$(this).text(originalContent);
				}
			} else if(code == 37) { // left Arrow 

			} else if(code == 38) { // up Arrow

			} else if(code == 39) { // right Arrow

			} else if(code == 40) { // down Arrow

			} else return;

		});

		$(this).on('keyup', function(e) {
			//showResult($(this).text());
		});
		
		// Wenn der Focus weg geht 
		$(this).blur(function(){
    		if($(this).text() == "")
    			$(this).text(originalContent);
    	});
	});
};

/*
function showResult(str) {
	if (str.length==0) { 
	document.getElementById("livesearch").innerHTML="";
	document.getElementById("livesearch").style.border="0px";
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
	  document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
	  document.getElementById("livesearch").style.border="1px solid #A5ACB2";
	}
	}
	xmlhttp.open("GET","livesearch.php?q="+str,true);
	xmlhttp.send();
};
*/

function loadToDo() {
	if (localStorage.getItem('todoList')){
		list.innerHTML = localStorage.getItem('todoList'); 
	}
};