$(document).ready(function() {
    
    var id;

    $.post( 'loadUserData.php',{userID : id}, function(data) {
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
    });
});

