<?php 
    session_start(); 
?> 

<?php
    require_once 'config.php';

    $resultArray = array();

    $queryArticles = "SELECT * FROM Articles";

    $resultArticles = mysql_query($queryArticles);
    // for every row
    while($row = mysql_fetch_object($resultArticles))
    {
            // create object
            $rowObject = array('id'=>$row->articleID,'articleName'=>$row->name);
            // push into array
            array_push($resultArray, $rowObject);
    } 

    //header('Content-Type: application/json');
    $json = json_encode($resultArray);
    echo $json;
    exit();
?>