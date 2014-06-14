$(document).ready(function() {
    
    var shoppingView = false;
    
    // --------------------------- On click	----------------------------//	
    $(document).on('click', function(e) {
        
        if(e.target.id === "shoppingView"){
            
            shoppingView = !shoppingView;
            var btnSaveList = $('#saveList');
            var btnClearList = $('#clearList');
            var table = $('#myTable');
            
            if(shoppingView){
                
                // Removing Editable from all Fields
                table.find('tr').find('.article').removeClass('editable');
                table.find('tr').find('.amount').removeClass('editable');
                table.find('tr').find('.article').attr('contenteditable', 'false')
                table.find('tr').find('.amount').attr('contenteditable', 'false')
                
                // Disable Save and Clear Buttons for ShoppingView
                btnClearList.hide();
                btnSaveList.hide();
            }else{

                //Remove selectedMarks
                table.find('tr').removeClass("exclude");

                // Make Rows editable
                table.find('tr').find('.article').addClass('editable');
                table.find('tr').find('.amount').addClass('editable');
                
                // Enable Save and Clear Buttons for ShoppingView
                btnClearList.show();
                btnSaveList.show();
            }
        }else if($(e.target).is('td')){
            
            var tableRow = $(e.target).parent();
            
            if(shoppingView){
                if(!tableRow.hasClass('exclude')){

                    var children = tableRow.find('td');

                    tableRow.addClass("exclude");
                }else{
                    tableRow.removeClass("exclude");
                }
            }
        }
    });
});


