<?php 
    session_start(); 
?> 

<?php
    require_once 'config.php';
    
    $userName = $_POST['user'];
    
    $queryUserID = "SELECT userID FROM Users WHERE name = '$userName'";
    $resultUserID = mysql_query($queryUserID);
    $row = mysql_fetch_object($resultUserID);
    
    $uID = $row->userID;

    $queryUserData = "SELECT * FROM Users u WHERE u.userID = '$uID' ";
    $resultUserData = mysql_query($queryUserData);
    // for every row
    $row = mysql_fetch_object($resultUserData);
    $resultArray = array('email'=>$row->email,'name'=>$row->name, 'zipcode'=>$row->code, 'street'=>$row->street, 'city'=>$row->city);

    $json = json_encode($resultArray);
    echo $json;
    exit();
?>