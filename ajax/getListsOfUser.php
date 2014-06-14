<?php 
session_start(); 
?> 

<?php
require_once '../php/config.php';

$user = $_SESSION["username"];
$resultArray = array();

$abfrage = "SELECT s.listID AS listID, s.name AS name 
FROM ShoppingLists s, UserListManagement ulm, Users u 
WHERE u.userID = ulm.userID AND s.listID = ulm.listID
AND u.name LIKE '$user'"; 

$ergebnis = mysql_query($abfrage);
// for every row
while($row = mysql_fetch_object($ergebnis))
{
	// create object
	$rowObject = array('id'=>$row->listID,'listName'=>$row->name);
	// push into array
	array_push($resultArray, $rowObject);
} 

//header('Content-Type: application/json');
$json = json_encode($resultArray);
echo $json;
exit();
?>