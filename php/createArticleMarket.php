<?php
    require_once 'config.php';
    
    $articleID = $_POST['id'];
    $name = $_POST['aname'];
    $marketID = $_POST['amarket'];
    $prize = $_POST['aprize'];
    $unit = $_POST['aunit'];
    $size = $_POST['asize'];
    $brand = $_POST['abrand'];
    
    $queryAddMarketArticle = "INSERT INTO MarketArticleManagement VALUES ('$marketID', '$articleID', '$prize', ($prize/$size), '$unit', '$size', '$brand')";
    $resutlAddMarketArticle = mysql_query($queryAddMarketArticle);
    
    //$resutlAddMarketArticle = array('1'=>$marketID, '2'=>$articleID, '3'=>$prize, '4'=>$prize/$size, '5'=>$unit, '6'=>$size, '7'=>$brand, '8'=>$queryAddMarketArticle);
    
    $json = json_encode($resutlAddMarketArticle);
    echo $json;
    exit();            
?>