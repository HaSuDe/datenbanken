<?php
require_once 'php/config.php';

$supermarketName = $_POST["supermarketName"];
$supermarketStreet = $_POST["supermarketStreet"];
$supermarketCity = $_POST["supermarketCity"];
$supermarketZipCode = $_POST["supermarketZipCode"];
$supermarketCountry = $_POST["supermarketCountry"];
$supermarketLongitude = $_POST["supermarketLongitude"];
$supermarketLatitude = $_POST["supermarketLatitude"];
$supermarketLongitude = $_POST["supermarketLongitude"];

/*Validation if Supermarket already exists*/
$query1 = "SELECT name FROM Supermarkets s WHERE s.name LIKE '$supermarketName' LIMIT 1";
$result1 = mysql_query($query1);
$size1 = mysql_num_rows($result1);

$query2 = "SELECT street FROM Supermarkets s WHERE s.street LIKE '$supermarketStreet' LIMIT 1";
$result2 = mysql_query($query2);
$size2 = mysql_num_rows($result2);



if($size1 == 0 && $size2 == 0){

	/*Add Article to Articles Table*/
	$query3 = "INSERT INTO Supermarkets(name, street, city, code, country, longitude, latitude) VALUES ('$supermarketName', '$supermarketStreet', '$supermarketCity', '$supermarketZipCode', '$supermarketCountry', '$supermarketLongitude', '$supermarketLatitude')";
	$result3 = mysql_query($query3); 

	if($result3 == true){ 
	    header('location: home.php');
	}else{ 
	    header('location: index.html');
	}
} 

?>