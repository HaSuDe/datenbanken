<?php 
    session_start(); 
?> 

<?php
    require_once 'config.php';
    
    $articleID = $_POST('articleID');

    $queryArticle = "SELECT * FROM Articles a WHERE a.articleID = '$articleID'";

    $resultArticle = mysql_query($queryArticle);

    $row = mysql_fetch_object($resultArticle);
    // create object
    $rowObject = array('id'=>$row->articleID,'name'=>$row->name, 'image'=>$row->image);

    $json = json_encode($rowObject);
    echo $json;
    exit();
?>