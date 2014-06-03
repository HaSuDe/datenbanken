<?php
require_once '../php/config.php';

$article = $_GET['article']; 

$abfrage = "SELECT mam.PPU * 100 AS comp, s.name AS sName
FROM Articles a, Supermarkets s, MarketArticleManagement mam
LEFT OUTER JOIN MarketOfferManagement mom ON mam.marketID = mom.marketID AND mam.articleID = mom.articleID
WHERE a.articleID = mam.articleID AND s.marketID = mam.marketID
AND a.name LIKE '$article' ORDER BY mam.PPU LIMIT 1"; 

$ergebnis = mysql_query($abfrage); 
$row = mysql_fetch_object($ergebnis); 

//echo $row->comp;
//echo $row->name;

$return_data = array('market'=>$row->sName,'prize'=>$row->comp);

//header('Content-Type: application/json');
$json = json_encode($return_data);
echo $json;
exit();

//return $row->comp;

?>