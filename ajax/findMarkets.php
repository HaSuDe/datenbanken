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
	$rowObject = array('id'=>$row->marketID,'name'=>$row->name,'country'=>$row->country, 'city'=>$row->city,'code'=>$row->code, 'street'=>$row->street,'longitude'=>$row->longitude, 'latitude'=>$row->latitude);
	array_push($resultArray, $rowObject);
} 

$json = json_encode($resultArray);
echo $json;

?>