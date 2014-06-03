<?php 

$hostname= "195.37.176.178:11336";
$username= "mileycyrus";
$password= "mileycyrus";
$dbname= "mileycyrus";

mysql_connect($hostname, $username, $password) OR die('Unable to connect to database! Please try again later.');
mysql_select_db($dbname) or die("Datenbank konnte nicht ausgewählt werden"); ;

?>