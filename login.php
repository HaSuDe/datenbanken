<?php 
session_start(); 
?> 

<?php
require_once 'php/config.php'; 

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