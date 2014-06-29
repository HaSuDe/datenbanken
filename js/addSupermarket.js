$(document).ready(function() {
    
    $('#createSupermarket').on('click', function(event) {
        
        console.log("submit clickeddddd");
        
        var name = $('#supermarketName').val();
        var street = $('#supermarketStreet').val();
        var city = $('#supermarketCity').val();
        var zipCode = $('#supermarketZipCode').val();
        var country = $('#supermarketCountry').val();
        var longitude = $('#supermarketLongitude').val();
        var latitude = $('#supermarketLatitude').val();
        
        if(name==="" || street==="" || city==="" || zipCode==="" || country==="" || longitude==="" || latitude===""){
            alertify.error("Please fill every field with information");
        }else{
            
            $.post( 'addSupermarket.php', {supermarketName : name, supermarketStreet : street, supermarketCity : city, supermarketZipCode : zipCode, 
                                            supermarketCountry : country, supermarketLongitude : longitude, supermarketLatitude : latitude}, function(data) {
                // if post was successful
                console.log(data);
                alertify.success("You have successfully created a Supermarket");
                //Clear all inputfields
                $('#supermarketName').val("");
                $('#supermarketStreet').val("");
                $('#supermarketCity').val("");
                $('#supermarketZipCode').val("");
                $('#supermarketCountry').val("");
                $('#supermarketLongitude').val("");
                $('#supermarketLatitude').val("");
                
                }, 'json') // I expect a JSON response
            .fail(function (data) {
                // if post had an error
                console.log('Failed to save other Fields in DB' +data);
                alertify.error("Something went Wrong :(, please try again");
            });
            
        }
    });
    
});


