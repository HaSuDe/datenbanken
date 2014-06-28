$(document).ready(function() {
   
    $('#registerSubmit').on('click', function(event) {
        
        var name = $('#username').val();
        var password1 = $('#password').val();
        var password2 = $('#password2').val();
        var email = $('#email').val();

        $.post( 'register.php', {uname : name, upass1 : password1, upass2 : password2, uemail : email}, function(data) {
            // if post was successful
            console.log(data);
            
            if(data['1'] === "success"){        
                $.post( 'login.php', {username : name, password : password1}, function(data) {
                    // if post was successful
                    console.log(data);
                    if(data[0] === "Ok"){   
                        window.location.replace('home.php');
                    }else{
                        // Fehlerausgabe
                    }
                }, 'json') // I expect a JSON response
                .fail(function (data) {
                    // if post had an error
                    // Fehlerausgabe
                    console.log("error: " + data);
                }); 
            }
            
            }, 'json') // I expect a JSON response
        .fail(function (data) {
            // if post had an error
            // Fehlerausgabe
            console.log("error: " + data);
        });
    });
    
});


