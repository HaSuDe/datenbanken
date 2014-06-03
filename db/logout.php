<?php 
session_start(); 
?> 

<?php
	session_destroy();
	session_unset();

	header('location: index.html'); 
?>