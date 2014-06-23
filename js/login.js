$(document).ready(function() {

	console.log("Login loaded");
	$('#loginBtn').on('click', function(event) {
		// get name and pw
		var name = $('#username').val();
		var pw = $('#password').val();
		console.log("Name: " + name + " PW: " + pw);
		login(name, pw);
	});

	function login(name, pw) {
		$.post( "login.php", {username: name, password: pw}, function(data) {
			// success
			console.log(data);
			window.location.replace('home.php');									
		}, 'json')
		// if something went wrong, give error message and reset text
		.fail(function(data) {
			// error
			console.log(data);
			alertify.error("Benutzername und/oder Passwort sind falsch");
		})
	};
});