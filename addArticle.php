<?php
require_once 'php/config.php';

$articleName = $_POST["articleName"];
$articleBrand = $_POST["articleBrand"];
$articlePrize = $_POST["articlePrize"];
$articleAmount = $_POST["articleAmount"];
$articleAmountUnit = $_POST["articleAmountUnit"];
$articleSupermarket = $_POST["articleSupermarket"];

/*Validation if Article already exists*/
$query1 = "SELECT name FROM Articles WHERE name LIKE '$articleName' LIMIT 1";
$result1 = mysql_query($query1);
$size = mysql_num_rows($result1);

if($size == 0){

	/*Add Article to Articles Table*/
	$query2 = "INSERT INTO Articles(name, image) VALUES ('$articleName', '/beispielPath1/')";
	$result2 = mysql_query($query2); 

	/*Requiering Article ID*/
	$query3 = "SELECT articleID FROM Articles a WHERE a.name LIKE '$articleName'";
	$result3 = mysql_query($query3);
	$row = mysql_fetch_object($result3);

	/*Create Article in MarketArticleManagement*/
	$query4 = "INSERT INTO MarketArticleManagement VALUES ('$articleSupermarket', '$row->articleID', '$articlePrize', ($articlePrize/$articleAmount), '$articleAmountUnit', '$articleAmount', '$articleBrand')";
	$result4 = mysql_query($query4);

	if($result2 == true && result4 == true){ 
	    header('location: home.php');
	}else{ 
	    header('location: index.html');
	}

} 

?>