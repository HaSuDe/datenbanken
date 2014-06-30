<?php

function load() { 
	require_once './php/config.php';
	$listID = $_GET['listID'];

	// if listID is defined fill list
	if(isset($_GET['listID'])) {
		$listID = $_GET['listID'];
		$resultArray = array();
		$rowIndex = 0;

		$abfrage = "SELECT a.name AS article, lam.amount AS amount 
		FROM Articles a, ListArticleManagement lam, ShoppingLists s
		WHERE s.listID = lam.listID AND a.articleID = lam.articleID
		AND s.listID = $listID";

		$ergebnis = mysql_query($abfrage);
		// for every row
		while($row = mysql_fetch_object($ergebnis)) {
			
			// create table row
			$rowObject = '<tr id="tableRow'.$rowIndex.'"><td class="editable article">'.$row->article.'</td>
						  <td class="editable amount" >'.$row->amount.'</td><td class="unit">unit here</td>
						  <td class="prize">Prize</td><td class="market">Market</td></tr>';
			$rowIndex++;
			echo $rowObject; 
		} 
	// else do nothing
	} else {
		echo "noIdFound"; 
	}
}
?>