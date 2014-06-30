<?php
    require_once 'config.php';
    
    $ID = $_POST['uid'];
    $email = $_POST['uemail'];
    $password = $_POST['upassword'];
    $name = $_POST['uname'];
    $city = $_POST['ucity'];
    $zipcode = $_POST['uzipcode'];
    $street = $_POST['ustreet'];
    
    $safeModeQuery = "SET SQL_SAFE_UPDATES=0";
    $queryUpdateUser = "UPDATE Users u SET u.email = '$email', u.password = '$email', u.name = '$name', u.city = '$city', u.code = '$code', u.street = '$street'  WHERE u.userID = '$ID'";
    mysql_query($safeModeQuery);
    $resutlUpdateUser = mysql_query($queryUpdateUser);
    
    $json = json_encode($resutlUpdateUser);
    echo $json;
    exit();
?>