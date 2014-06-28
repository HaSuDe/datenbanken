<?php
    require_once 'php/config.php';
//    include_once 'login.php';

    $username = $_POST["uname"]; 
    $password = $_POST["upass1"]; 
    $password2 = $_POST["upass2"]; 
    $email = $_POST["uemail"];

    if($password != $password2 OR $username == "" OR $password == ""){ 
        $result = array(1=>"wrong input");
    } 
    
    $password = md5($password); 

    $result = mysql_query("SELECT userId FROM Users WHERE name LIKE '$username'"); 
    $menge = mysql_num_rows($result); 

    if($menge == 0){ 
            $eintrag = "INSERT INTO Users (email, name, password) VALUES ('$email', '$username', '$password')"; 
            $eintragen = mysql_query($eintrag); 

        if($eintragen == true) { 
            $result = array(1=>"success");
            //login($username, $password);
        } else { 
            $result = array(1=>"fail create");
        } 


    }else{ 
        $result = array(1=>"fail taken");
    } 
    
    $json = json_encode($result);
    echo $json;
    exit();
     
?>