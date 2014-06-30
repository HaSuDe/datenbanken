<?php
require_once 'php/config.php';

$supermarketName = $_POST["supermarketName"];
$supermarketStreet = $_POST["supermarketStreet"];
$supermarketCity = $_POST["supermarketCity"];
$supermarketZipCode = $_POST["supermarketZipCode"];
$supermarketCountry = $_POST["supermarketCountry"];
$supermarketLongitude = $_POST["supermarketLongitude"];
$supermarketLatitude = $_POST["supermarketLatitude"];

/*Validation if Supermarket already exists*/
$query1 = "SELECT name FROM Supermarkets s WHERE s.name LIKE '$supermarketName' LIMIT 1";
$result1 = mysql_query($query1);
$size1 = mysql_num_rows($result1);

$query2 = "SELECT street FROM Supermarkets s WHERE s.street LIKE '$supermarketStreet' LIMIT 1";
$result2 = mysql_query($query2);
$size2 = mysql_num_rows($result2);

$what = array("ä", "ö", "ü", "Ä", "Ö", "Ü", "ß"); 
$how = array("ae", "oe", "ue", "Ae", "Oe", "Ue", "ss");
$supermarketName = str_replace($what,$how,$supermarketName);
$supermarketStreet = str_replace($what,$how,$supermarketStreet);
$supermarketCity = str_replace($what,$how,$supermarketCity);
$supermarketZipCode = str_replace($what,$how,$supermarketZipCode);
$supermarketCountry = str_replace($what,$how,$supermarketCountry);
$supermarketLongitude = str_replace($what,$how,$supermarketLongitude);
$supermarketLatitude = str_replace($what,$how,$supermarketLatitude);


if($size1 == 0 || $size2 == 0){

	/*Add Article to Articles Table*/
	$query3 = "INSERT INTO Supermarkets(name, street, city, code, country, longitude, latitude) VALUES ('$supermarketName', '$supermarketStreet', '$supermarketCity', '$supermarketZipCode', '$supermarketCountry', '$supermarketLongitude', '$supermarketLatitude')";
	$result3 = mysql_query($query3); 

	if($result3 == true){ 
	    $result = array(1=>"success");
	}else{ 
	    $result = array(1=>"fail");
	}
}else{
    $result = array(1=>"already");
} 

    $json = json_encode($result);
    echo $json;
    exit();

?>