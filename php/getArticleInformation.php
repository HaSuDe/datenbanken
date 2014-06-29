<?php 
    session_start(); 
?> 

<?php
    require_once 'config.php';
    
    $articleID = $_POST['articleID'];
    $resultSummary = array();
    
    // Get Article Information
    $queryArticle = "SELECT * FROM Articles a WHERE a.articleID = '$articleID'";
    $resultArticle = mysql_query($queryArticle);
    $row = mysql_fetch_object($resultArticle);
    // create object
    $articleI = array('id'=>$row->articleID,'name'=>$row->name, 'image'=>$row->image);
    array_push($resultSummary, $articleI);
    
    // Get  Article Relations
    $resultArray = array();
    $queryRelations = "SELECT m.marketID, m.size, m.unit, m.prize, m.brand  FROM MarketArticleManagement m WHERE m.articleID = '$articleID'";
    $resultRelations = mysql_query($queryRelations);
    
    while($row2 = mysql_fetch_object($resultRelations)){
        // create object
        $marketID = $row2->marketID;
        
        $queryMarketName = "SELECT s.name FROM Supermarkets s WHERE s.marketID = '$marketID'";
        $resultMarketName = mysql_query($queryMarketName);
        $marketName = mysql_fetch_object($resultMarketName);
        
        $rowObject = array('marketName'=>$marketName->name, 'size'=>$row2->size, 'unit'=>$row2->unit, 'prize'=>$row2->prize, 'brand'=>$row2->brand);
        // push into array
        array_push($resultArray, $rowObject);
    } 
    
    array_push($resultSummary, $resultArray);

    $json = json_encode($resultSummary);
    echo $json;
    exit();
?>