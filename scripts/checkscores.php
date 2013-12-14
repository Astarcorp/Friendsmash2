<?php

	require_once('config/database.php'); //Login to database

	$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); //Connect

	$stmt = $mysqli->prepare("SELECT * FROM `friendsusername` WHERE `username` = ? AND `friendsusername` = ? AND `cash` = ? AND `friendsid` = ?"); //Select all from friendscores

	$stmt->bind_param("ssis", $username, $friendsusername, $scores, $friendsid);

	$stmt->execute(); 

	$stmt->bind_result($oldUsername, $oldFriends, $oldScores, $oldFriendsId);
	
	$checkFriendscores = array(); //Fetch and store in array
	while ($stmt->fetch()) {
		$checkPortfolio[$oldFriendsId] = array(
			'username' => $oldUsername,
			'friends' => $oldFriends,
			'score' => $oldScores,
			'friendsid' => $oldFriendsId
		);
	}

	foreach($checkFriendscores as $key => $checkFriendKeys){ //Get latest information
		$oldUsername = $checkFriendKeys['username'];
		$oldFriends = $checkFriendKeys['friends'];
		$oldScores = $checkFriendKeys['score'];
		$oldFriendsId = $checkFriendKeys['friendsid'];
	}

	$isUsernameValid = !empty($oldUsername); //Username is not empty
	$isFriendValid = !empty($oldFriends); //Friend is not empty
	$isScoreValid = !empty($oldScores); //Score is not empty
	$isIDValid = !empty($oldFriendsId); //ID is not empty

	$stmt->close();

	$mysqli->close();

	if ($isUsernameValid && $isFriendValid && $isScoreValid && $isIDValid){ //There is data in database
		$username = $oldUsername;
		$friendsusername = $oldFriends;
		$scores = $oldScores;
		$friendsid = $oldFriendsId;
	} else { //No data in database
		$username = $oldUsername;
		$friendsusername = $oldFriends;
		$scores = $oldScores;
		$friendsid = $oldFriendsId;
		$Valid = 0;
	}

?>