<?php
/*
	
	require_once('config/database.php');

	$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); 

	$stmt = $mysqli->prepare("UPDATE `portfolio` SET `quantity` = ((SELECT quantity FROM `portfolio` WHERE username = ? AND WHERE name = ?)+quantity)"); 

	$stmt->bind_param("ss", $name, $username);

	$successfullyUpdated = $stmt->execute(); 

	$stmt->close();
	
	$mysqli->close();
*/
?>