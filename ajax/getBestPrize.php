<?php
require_once '../php/config.php';

$article = $_GET['article']; 
$resultArray = array();

$abfrage = "SELECT mam.PPU AS comp, s.name AS sName
FROM Articles a, Supermarkets s, MarketArticleManagement mam
LEFT OUTER JOIN MarketOfferManagement mom ON mam.marketID = mom.marketID AND mam.articleID = mom.articleID
WHERE a.articleID = mam.articleID AND s.marketID = mam.marketID
AND a.name LIKE '$article' ORDER BY a.name, mam.PPU"; 

$ergebnis = mysql_query($abfrage);
while($row = mysql_fetch_object($ergebnis))
{
	$rowObject = array('market'=>$row->sName,'prize'=>$row->comp);
	array_push($resultArray, $rowObject);
} 

//echo $row->comp;
//echo $row->name;

//$return_data = array($resultArray);

//header('Content-Type: application/json');
$json = json_encode($resultArray);
echo $json;
exit();

//return $row->comp;

?>