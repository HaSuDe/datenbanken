<?php
require_once '../php/config.php';

$name = $_POST['name'];
$country = $_POST['country'];
$city = $_POST['city'];
$code = $_POST['code'];
$street = $_POST['street'];
$longitude = $_POST['longitude'];
$latitude = $_POST['latitude'];
$resultArray = array();

$abfrage = "SELECT * FROM Supermarkets 
			WHERE NAME REGEXP '^$name' AND COUNTRY REGEXP '^$country'
			AND CITY REGEXP '^$city' AND CODE REGEXP '^$code'
			AND STREET REGEXP '^$street' AND LONGITUDE REGEXP '^$longitude'
			AND LATITUDE REGEXP '^$latitude'";
$ergebnis = mysql_query($abfrage);
while($row = mysql_fetch_object($ergebnis))
{
	// evtl für andere sachen
	$what = array("ä", "ö", "ü", "Ä", "Ö", "Ü", "ß"); 
    $how = array("ae", "oe", "ue", "Ae", "Oe", "Ue", "ss"); 
	$nameVal = str_replace($what,$how,$row->name);
	$countryVal = str_replace ($what, $how, $row->country);
	$cityVal = str_replace ($what, $how, $row->city);
	$codeVal = str_replace ($what, $how, $row->code);
	$streetVal = str_replace ($what, $how, $row->street);
	$longitudeVal = str_replace ($what,$how,$row->longitude);
	$latitudeVal = str_replace ($what,$how,$row->latitude);

	$rowObject = array('name'=>$nameVal,'country'=>$countryVal, 'city'=>$cityVal,'code'=>$codeVal, 'street'=>$streetVal,'longitude'=>$longitudeVal, 'latitude'=>$latitudeVal);
	array_push($resultArray, $rowObject);
} 

$json = json_encode($resultArray);
echo $json;

?>