$(document).ready(function() {
    
    $.post( 'php/createXML.php', function(data) {
            console.log(data);
            }, 'json') // I expect a JSON response
    .fail(function (data) {
            console.log("error: " + data);
    });
    
});


