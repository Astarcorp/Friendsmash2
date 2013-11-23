<?php

	require_once('config/database.php');

	$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); 

	$stmt = $mysqli->prepare("INSERT INTO `portfolio` (`username`, `name`, `quantity`, `price`, `total`) VALUES (?, ?, ?, ?, ?)"); 

	$stmt->bind_param("sssss", $username, $name, $quantity, $price, $total); 

	$successfullyInserted = $stmt->execute(); 

	$stmt->close();

	$mysqli->close();

?>