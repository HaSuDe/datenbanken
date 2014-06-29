<?php
    session_start(); 
?>

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
    $allowed = array('png', 'jpg');

    $imagePath = '../uploads/article/'.$tsSurveyImage.'.'.$extension;
    
        /*Validation if Article already exists*/
    $query1 = "SELECT name FROM Articles WHERE name LIKE '$articleName' LIMIT 1";
    $result1 = mysql_query($query1);
    $size = mysql_num_rows($result1);

    if($size == 0){
        if(isset($image) && $image['error'] == 0){
            // check right Extension
            if(!in_array(strtolower($extension), $allowed)){
                    //Fehler
                    $_SESSION['status'] = 'Image extension not allowed';
                    header('location: ../createArticle.php');
                    exit;
            }else{ 
                // Upload File
                if(move_uploaded_file($image['tmp_name'], $imagePath)){
                    //If umpload was successfull

                        /*Add Article to Articles Table*/
                        $imagePathDB = 'article/'.$tsSurveyImage.'.'.$extension;
                        $query2 = "INSERT INTO Articles(name, image) VALUES ('$articleName', '$imagePath')";
                        $result2 = mysql_query($query2);
                        if(!($result2 == true)){
                            $_SESSION['status'] = 'Error while creating new Article, please try again';
                            header('location: ../createArticle.php');
                            exit;
                        }else{
                            /*Requiering Article ID*/
                            $query3 = "SELECT articleID FROM Articles a WHERE a.name LIKE '$articleName'";
                            $result3 = mysql_query($query3);
                            $row = mysql_fetch_object($result3);

                            /*Create Article in MarketArticleManagement*/
                            $query4 = "INSERT INTO MarketArticleManagement VALUES ('$articleSupermarket', '$row->articleID', '$articlePrize', ($articlePrize/$articleAmount), '$articleAmountUnit', '$articleAmount', '$articleBrand')";
                            $result4 = mysql_query($query4);

                            if($result2 == true && result4 == true){ 
                                $_SESSION['status'] = 'Article successfully created';
                                header('location: ../createArticle.php');
                                exit;
                            }else{ 
                                // Delete Article
                                $query5 = "SET SQL_SAFE_UPDATES=0";
                                $query6 = "DELETE FROM Articles WHERE articleID = '$row->articleID'";
                                mysql_query($query5);
                                mysql_query($query6);
                                
                                $_SESSION['status'] = 'Error while creating new article, please try again';
                                header('location: ../createArticle.php');
                                exit;
                            }
                        }
                    }else{
                    // Error in Imageupload
                    $_SESSION['status'] = 'Error while uploading Image, please try again';
                    header('location: ../createArticle.php');
                    exit;
                }
            }
        }else{
            // Error in Imageupload
            $_SESSION['status'] = 'Image contains Error, please choose another image';
            header('location: ../createArticle.php');
            exit;
        }
    }else{
        // Article already exists
        $_SESSION['status'] = 'Article already exists';
        header('location: ../createArticle.php');
        exit;
    }
    
?>