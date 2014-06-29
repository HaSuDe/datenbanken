$(document).ready(function() {

    $('#saveList').on('click', function(event) {
        
        var tableRows = $('#myTableBody tr');
       
        if(($('#myTableBody tr').size() > 1)){
            var filledWrong = false;
            $.each( tableRows, function( key, value ) {
                if($(value).find('.market').text() === "Market"){
                    if(!($(value).find('.article').text() === "Article")){
                        filledWrong = true;
                    }
                }
            });
            
            if(!filledWrong){
                $('#articleSubmitButton').unbind();
                var modal = $("#listNameModal");
                modal.modal(); 
            }else{
                alertify.error("Please correct the Mistakes in your List");
            }

        }else{
            alertify.error("A List must have at least one Article");
        }



        
        // After Name was typed Submit List to Database
        $('#shoppingListNameSubmit').on('click', function(event){
            
            event.preventDefault();
            console.log("Submit called");

            var listData = new Array();
            
            var listName = $('#listName').val();
            
            var userName = $('#userName').text();

            var iter = 0;

            // For every Tablerow
            $.each( tableRows, function( key, value ) {
                var rowData = new Array();

                // Data of Tablerow
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

            $.post( 'saveList.php', {ldata : listData, lname : listName, uname : userName}, function(data) {
                // if post was successful
                console.log(data);
                alertify.success("You have successfully saved your list.");
                }, 'json') // I expect a JSON response
            .fail(function (data) {
                // if post had an error
                console.log('Failed to save other Fields in DB' +data);
                alertify.error("Something went Wrong :(, please try again");
            });
        });
    	
    });
    
    
     // -------------------------- Create Modal ------------------//
    // Wenn modal versteckt wurde
    $('#listNameModal').on('hidden.bs.modal', function () {
        // Felder wieder leeren
        $('#listName').val("");
    });
    
    // Wenn Modal geshowed wurde
    $('#listNameModal').on('shown.bs.modal', function () {
        // Vielleicht alten Namen reinladen
    });

});