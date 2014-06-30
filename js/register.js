$(document).ready(function() {
   
    $('#registerSubmit').on('click', function(event) {
        
        var name = $('#username').val();
        var password1 = $('#password').val();
        var password2 = $('#password2').val();
        var email = $('#email').val();
        console.log("Name: " + name);

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
            } else if(data['1'] === "wrong input") {
                // always set back error marks and co
                $('div.form-group.has-error'). removeClass('has-error');
                $('div.alert').addClass('hidden');

                if(data['2'] === "password") {
                    // mark password1 and pw2
                    $('#password').parent().addClass('has-error');
                    $('#password2').parent().addClass('has-error');
                    // show error div with text
                    $('div.alert').text('Your passwords musst be equal. Please correct your passwords.')
                    $('div.alert').removeClass('hidden');
                } else if(data['2'] === "email") {
                    // mark password1 and pw2
                    $('#email').parent().addClass('has-error');
                    // show error div with text
                    $('div.alert').text('Your email is invalid. Please use a correct email address.')
                    $('div.alert').removeClass('hidden');
                }

            } else if(data['1'] === "fail taken") {
                console.log("Account is taken");
                // always set back error marks and co
                $('div.form-group.has-error'). removeClass('has-error');
                $('div.alert').addClass('hidden');

                // mark username field
                $('#username').parent().addClass('has-error');
                // show error div with text
                $('div.alert').text('Your username is already taken. Please choose another one.')
                $('div.alert').removeClass('hidden');

                
            } else if(data['1'] === "fail create") {
                // always set back error marks and co
                $('div.form-group.has-error'). removeClass('has-error');
                $('div.alert').addClass('hidden');

                $('div.alert').text('Your account could not be created. Please try one more time.')
                $('div.alert').removeClass('hidden');
                
            }
            
        }, 'json') // I expect a JSON response
        .fail(function (data) {
            // if post had an error
            // Fehlerausgabe
            console.log("error: " + data);
        });
    });
    
});


