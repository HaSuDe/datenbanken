<?php 
session_start(); 
?> 

<?php
    require_once 'php/config.php'; 

    if(isset($_POST["username"]))
            $username = $_POST["username"];

    if(isset($_POST["password"]))
            $password = md5($_POST["password"]); 

    login($username, $password);

    function login($username, $password) {
        $abfrage = "SELECT name, password FROM Users WHERE name LIKE '$username' LIMIT 1"; 
        $ergebnis = mysql_query($abfrage); 
        $row = mysql_fetch_object($ergebnis); 

        if($row->password == $password) 
            { 
            $_SESSION["username"] = $username; 
            $json = json_encode(array("Ok"));
            echo $json;
        } else 
            { 
            echo "error";
        }
    }
?>