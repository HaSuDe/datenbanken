$( "#addRowBtn" ).on( "click", function() {

	$('#mainTable > tbody:last').append('<tr><td>Your Article</td><td>Amount</td><td></td><td></td></tr>');
	// Nach erzeugen muss die Methode noch einmal ausgeführt werden
	$('#mainTable').editableTableWidget().numericInputExample().find('td:first').focus();
	$('#textAreaEditor').editableTableWidget({editor: $('<textarea>')});
});
