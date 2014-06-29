<?php
    require_once 'config.php';

    $articleName = $_POST["articleName"];
    $articleBrand = $_POST["articleBrand"];
    $articlePrize = $_POST["articlePrize"];
    $articleAmount = $_POST["articleAmount"];
    $articleAmountUnit = $_POST["articleAmountUnit"];
    $articleSupermarket = $_POST["articleSupermarket"];

    // Upload Image

    // Create Unique ID and extention for surveyImage Upload
    $image = $_FILES['articleImage'];
    $tsSurveyImage = uniqid();
    $extension = pathinfo($_FILES['articleImage']['name'], PATHINFO_EXTENSION);

    // A list of permitted file extensions
    $allowed = array('png', 'jpg', 'gif','zip');

    $imagePath = '../uploads/article/'.$tsSurveyImage.'.'.$extension;
    
    if(isset($image) && $image['error'] == 0){
        if(!in_array(strtolower($extension), $allowed)){
                //Fehler
                echo 'Extention nicht allowed';
        }
        if(move_uploaded_file($image['tmp_name'], $imagePath)){
                //Erfolg
            echo 'Bild erfolgreich';
        }
    }else{
        // Fehler
        echo 'Fehler im Bild';
    }

    /*Validation if Article already exists*/
    $query1 = "SELECT name FROM Articles WHERE name LIKE '$articleName' LIMIT 1";
    $result1 = mysql_query($query1);
    $size = mysql_num_rows($result1);

    if($size == 0){
        /*Add Article to Articles Table*/
        $query2 = "INSERT INTO Articles(name, image) VALUES ('$articleName', '$imagePath')";
        $result2 = mysql_query($query2); 

        /*Requiering Article ID*/
        $query3 = "SELECT articleID FROM Articles a WHERE a.name LIKE '$articleName'";
        $result3 = mysql_query($query3);
        $row = mysql_fetch_object($result3);

        /*Create Article in MarketArticleManagement*/
        $query4 = "INSERT INTO MarketArticleManagement VALUES ('$articleSupermarket', '$row->articleID', '$articlePrize', ($articlePrize/$articleAmount), '$articleAmountUnit', '$articleAmount', '$articleBrand')";
        $result4 = mysql_query($query4);

        if($result2 == true && result4 == true){ 
            header('location: ../home.php');
        }else{ 
            header('location: ../index.php');
        }
    }
?>