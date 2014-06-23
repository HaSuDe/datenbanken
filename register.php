<?php
require_once 'php/config.php';
include_once 'login.php';

$username = $_POST["username"]; 
$password = $_POST["password"]; 
$password2 = $_POST["password2"]; 

if($password != $password2 OR $username == "" OR $password == "") 
    { 
    echo "Eingabefehler. Bitte alle Felder korekt ausfüllen. <a href=\"eintragen.html\">Zurück</a>"; 
    exit; 
    } 
$password = md5($password); 

$result = mysql_query("SELECT userId FROM Users WHERE name LIKE '$username'"); 
$menge = mysql_num_rows($result); 

if($menge == 0) 
    { 
    $eintrag = "INSERT INTO Users (name, password) VALUES ('$username', '$password')"; 
    $eintragen = mysql_query($eintrag); 

    if($eintragen == true) { 
        login($username, $password);
        //echo "Benutzername <b>$username</b> wurde erstellt. <a href=\"home.html\">Login</a>"; 
    } else 
        { 
        echo "Fehler beim Speichern des Benutzernames. <a href=\"register.html\">Zurück</a>"; 
        } 


    } 

else 
    { 
    echo "Benutzername schon vorhanden. <a href=\"register.html\">Zurück</a>"; 
    } 
?>
?>