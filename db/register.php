<?php 
$verbindung = mysql_connect("195.37.176.178:11336", "mileycyrus" , "mileycyrus") 
or die("Verbindung zur Datenbank konnte nicht hergestellt werden"); 

mysql_select_db("mileycyrus") or die ("Datenbank konnte nicht ausgewählt werden"); 

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