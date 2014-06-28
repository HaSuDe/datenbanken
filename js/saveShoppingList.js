$(document).ready(function() {

    $('#saveList').on('click', function(event) {
    	console.log("Submit called");

    	event.preventDefault();
		//localStorage.setItem('todoList', list.innerHTML);
		alertify.success("You have saved your list.");

    	var listData = new Array();

    	var tableRows = $('#myTableBody tr');
        
        var iter = 0;

        $.each( tableRows, function( key, value ) {
            var rowData = new Array();

            console.log(key);
            console.log(value);
            
                            console.log("Size ist: " + tableRows.size());
                console.log("Iter ist: " + iter);
            
            
            if(iter <= (tableRows.size()-2)){

                rowData.push($(value).find('.article').text());
                rowData.push($(value).find('.amount').text());
                rowData.push($(value).find('.prize').text());
                rowData.push($(value).find('.market').text());



            listData.push(rowData);
            }

            console.log(listData);
            iter++;
        });


        $.post( 'saveList.php', {ldata : listData}, function(data) {
            // if post was successful
            console.log(data);
            }, 'json') // I expect a JSON response
        .fail(function (data) {
            // if post had an error
            console.log('Failed to save other Fields in DB' +data);
        });
    });

});