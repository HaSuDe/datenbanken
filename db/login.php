<?php 
session_start(); 
?> 

<?php 
$verbindung = mysql_connect("195.37.176.178:11336", "mileycyrus" , "mileycyrus")  
or die("Verbindung zur Datenbank konnte nicht hergestellt werden"); 
mysql_select_db("mileycyrus") or die ("Datenbank konnte nicht ausgewählt werden"); 

$username = $_POST["username"]; 
$password = md5($_POST["password"]); 

$abfrage = "SELECT name, password FROM Users WHERE name LIKE '$username' LIMIT 1"; 
$ergebnis = mysql_query($abfrage); 
$row = mysql_fetch_object($ergebnis); 

if($row->password == $password) 
    { 
    $_SESSION["username"] = $username; 
    header('location: home.php'); 
    } 
else 
    { 
    echo "Benutzername und/oder Passwort waren falsch. <a href=\"index.html\">Login</a>";
    } 

?>