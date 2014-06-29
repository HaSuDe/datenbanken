<?php

    require_once 'config.php';
    
    // Get Articles from Database
    $queryArticles = "SELECT name FROM Articles";
    $resultArticles = $ergebnis = mysql_query($queryArticles);
    
    $doc = new DOMDocument('1.0');
    // we want a nice output
    $doc->formatOutput = true;
    
    $pages = $doc->createElement('pages');
    $pages = $doc->appendChild($pages);
    
    while($row = mysql_fetch_object($resultArticles)) {

        $article = $doc->createElement('article');
        $article = $pages->appendChild($article);

        $title = $doc->createElement('title');
        $title = $article->appendChild($title);
        
        $text = $doc->createTextNode($row->name);
        $text = $title->appendChild($text);
    }
    
    $string = 'Wrote: ' . $doc->save("../xml/articles.xml") . ' bytes'; // Wrote: 72 bytes
    $result = array(1=>$string);
    
    $json = json_encode($result);
    echo $json;
    exit();
?>