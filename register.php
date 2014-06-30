<?php
    require_once 'php/config.php';
//    include_once 'login.php';

    $username = $_POST["uname"]; 
    $password = $_POST["upass1"]; 
    $password2 = $_POST["upass2"]; 
    $email = $_POST["uemail"];

    if($password != $password2 OR $username == "" OR $password == ""){ 
        $result = array(1=>"wrong input", 2=>"password");
    // if password is correct check email
    } else if (check_email_address($email)){
    
        $password = md5($password); 

        $userID = mysql_query("SELECT userId FROM Users WHERE name LIKE '$username'"); 
        $menge = mysql_num_rows($userID); 

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
    // email incorrect
    } else {
        $result = array(1=>"wrong input", 2=>"email");
    }
    
    $json = json_encode($result);
    echo $json;
    exit();

    function check_email_address($str_email_address) {
    if('' != $str_email_address && !((eregi("^[_\.0-9a-z-]+@([0-9a-z-]+\.)+[a-z]{2,6}$",$str_email_address)))) {
      return false;
    } else {
      return true;
    }
  }
     
?>