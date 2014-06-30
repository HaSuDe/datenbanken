<?php
	require_once './config.php';

	$marketID = $_POST['marketID'];
	$userName = $_POST['user'];

	$abfrage = "SELECT u.userID FROM UserMarketManagement umm, Users u
				WHERE u.userID = umm.userID AND umm.marketID = '$marketID' AND u.name = '$userName'";

	$exists = mysql_query($abfrage);
	$menge = mysql_num_rows($exists);

	$abfrage2 = "SELECT u.userID AS userID FROM Users u 
				 WHERE u.name = '$userName'";
	$ergebnisIds = mysql_query($abfrage2);
	$ids = mysql_fetch_object($ergebnisIds);

	if($menge == 0) {
		$abfrage = "INSERT INTO UserMarketManagement(userID, marketID) VALUES ('$ids->userID', '$marketID')";
		$ergebnis = mysql_query($abfrage);
		if($ergebnis == true){ 
	    	$result = array(1=>"success");
	    } else
	    	$result = array(1=>"fail");
	} else {
		$abfrage = "UPDATE UserMarketManagement umm SET umm.userID = '$ids->userID', umm.marketID = '$marketID'";
		$ergebnis = mysql_query($abfrage);
		if($ergebnis == true){ 
	    	$result = array(1=>"success");
	    } else
	    	$result = array(1=>"fail");
	}

	$json = json_encode($result);
    echo $json;
?>
	