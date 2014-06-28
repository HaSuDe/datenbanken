<?php
    require_once 'php/config.php';
    
    $ldata = $_POST['ldata'];
    $listName = $_POST['lname'];
    $userName = $_POST["uname"];
    
    // Create new List
    $queryCreateList = "INSERT INTO ShoppingLists(name) VALUES ('$listName')";
    $resultCreateList = mysql_query($queryCreateList);
    
    // Requiering List ID
    $queryListId = "SELECT listID FROM ShoppingLists sl WHERE sl.name LIKE '$listName'";
    $resultListId = mysql_query($queryListId);
    $row = mysql_fetch_object($resultListId);
    $listID = $row->listID;
    
    //Get User ID
    $querUserId = "SELECT userID FROM Users u WHERE u.name LIKE '$userName'";
    $resultUserId = mysql_query($querUserId);
    $rowId = mysql_fetch_object($resultUserId);
    $userId = $rowId->userID;
    
    // Add List to User
    $queryAddUser = "INSERT INTO UserListManagement VALUES($userId, $listID)";
    $resultAddUser = mysql_query($queryAddUser);
    
    $articleCount = 0;
    $stillArticle = true;
    do{
        if(isset($ldata[$articleCount])){
            
            //Add article to List
            
            // Get Market
            $market = "Penny";
            
            // Get Name of Article
            $name = $ldata[$articleCount][0];
            // Get ID of Article
            $queryArticleId = "SELECT articleID FROM Articles a WHERE a.name LIKE '$name'";
            $resultArticleId = mysql_query($queryArticleId);
            $rowA = mysql_fetch_object($resultArticleId);
            $articleId = $rowA->articleID;
            
            // Get Amount
            $amount = $ldata[$articleCount][1];
            
            // Add Article
            $queryAddToList = "INSERT INTO ListArticleManagement VALUES ($listID, $articleId, $amount)";
            $resultAddArticle = mysql_query($queryAddToList);
            
            $articleCount++;
        }else{
            $stillArticle = false;
        }
        
    }while($stillArticle);

    $json = json_encode($queryCreateList);
    echo $json;
    exit();

?>