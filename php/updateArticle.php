<?php
    require_once 'config.php';
    
    $id = $_POST['id'];
    $name = $_POST['aname'];
    $marketID = $_POST['amarket'];
    $prize = $_POST['aprize'];
    $unit = $_POST['aunit'];
    $size = $_POST['asize'];
    $brand = $_POST['abrand'];
    
    $safeModeQuery = "SET SQL_SAFE_UPDATES=0";
    $queryUpdateArticle = "UPDATE Articles a SET a.name = '$name' WHERE a.articleID = '$id'";
    mysql_query($safeModeQuery);
    $resutlUpdateArticle = mysql_query($queryUpdateArticle);
    
    
    $queryAddMarketArticle = "UPDATE MarketArticleManagement m SET m.prize = '$prize', m.PPU = ($prize/$size), m.unit = '$unit', m.size = '$size', m.brand = '$brand' WHERE m.marketID = '$marketID' AND m.articleID = '$id'";
    $resutlAddMarketArticle = mysql_query($queryAddMarketArticle);
    
    $result = array('1'=>$resutlUpdateArticle, '2'=>$resutlAddMarketArticle);
    
    $json = json_encode($result);
    echo $json;
    exit();
    
            
?>