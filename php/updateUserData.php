<?php
    require_once 'config.php';
    
    if (isset($_POST['formData'])) {
        $data = $_POST['formData'];
    }
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    } else {
        $email = $data['email'];
    }
    if (isset($_POST['password'])) {
        $password = $_POST['password'];
    } else {
        $password = $data['password'];
    }
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
    } else {
        $name = $data['name'];
    }
    if (isset($_POST['city'])) {
        $city = $_POST['city'];
    } else {
        $city = $data['city'];
    }
    if (isset($_POST['code'])) {
        $code = $_POST['code'];
    } else {
        $code = $data['code'];
    }
    if (isset($_POST['address'])) {
        $address = $_POST['address'];
    } else {
        $address = $data['address'];
    }
    $password = md5($password);
    
    $safeModeQuery = "SET SQL_SAFE_UPDATES=0";
    $queryUpdateUser = "UPDATE Users u SET u.email = '$email', u.password = '$email', u.city = '$city', u.code = '$code', u.street = '$address'  
                        WHERE u.name = '$name'";
    mysql_query($safeModeQuery);
    $resutlUpdateUser = mysql_query($queryUpdateUser);
    
    $json = json_encode($resutlUpdateUser);
    echo $json;
    exit();
?>