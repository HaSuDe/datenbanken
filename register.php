<?php
require_once 'php/config.php';

$username = $_POST["username"]; 
$passwort = $_POST["password"]; 
$passwort2 = $_POST["password2"]; 

if($passwort != $passwort2 OR $username == "" OR $passwort == "") 
    { 
    echo "Eingabefehler. Bitte alle Felder korekt ausfüllen. <a href=\"eintragen.html\">Zurück</a>"; 
    exit; 
    } 
$passwort = md5($passwort); 

$result = mysql_query("SELECT userId FROM Users WHERE name LIKE '$username'"); 
$menge = mysql_num_rows($result); 

if($menge == 0) 
    { 
    $eintrag = "INSERT INTO Users (name, password) VALUES ('$username', '$passwort')"; 
    $eintragen = mysql_query($eintrag); 

    if($eintragen == true) 
        { 
        header('location: login.php');
        //echo "Benutzername <b>$username</b> wurde erstellt. <a href=\"home.html\">Login</a>"; 
        } 
    else 
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