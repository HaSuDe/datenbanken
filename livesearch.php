<?php
$xmlDoc=new DOMDocument();
$xmlDoc->load("xml/articles.xml");

$x=$xmlDoc->getElementsByTagName('article');

//get the q parameter from URL
$q=$_GET["q"];

//lookup all links from the xml file if length of q>0
if (strlen($q)>0) {
  $hint="";
  for($i=0; $i<($x->length); $i++) {
    $y=$x->item($i)->getElementsByTagName('title');
    if ($y->item(0)->nodeType==1) {
      //find a link matching the search text
      if (stristr($y->item(0)->childNodes->item(0)->nodeValue,$q)) {
        if($hint == "") {
        $hint="<li>". $y->item(0)->childNodes->item(0)->nodeValue . "</li>";
        } else {
          $hint=$hint. "<li>" . $y->item(0)->childNodes->item(0)->nodeValue . "</li>";
        }
      }
    }
  }
}

// Set output to "no suggestion" if no hint were found
// or to the correct values
if ($hint=="") {
  $response="No article found";
} else {
  $response=$hint;
}

//output the response
echo $response;
?>