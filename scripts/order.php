<?php 
	
	$url = $_SERVER['HTTP_HOST'];

	$thisIsLocalHostUrl = (strpos($url, 'localhost') !== false);
	$thisIsCloudControlUrl = (strpos($url, 'cloudcontrolled') !== false);

	//Credentials for localhost database
	if ($thisIsLocalHostUrl) {
		$database_name = 'tradingwithfriends';
		$database_username = 'root';
		$database_password = '';
		$database_hostname = 'localhost';
	}
	
	//Credentials for cloudcontrol database
	if ($thisIsCloudControlUrl) {
		$database_name = 'depqdrc7d65';
		$database_username = 'depqdrc7d65';
		$database_password = 'p6A2wObwmahl';
		$database_hostname = 'mysqlsdb.co8hm2var4k9.eu-west-1.rds.amazonaws.com';
	}

	$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); //Connect

	$stmt = $mysqli->prepare("SELECT * FROM `portfolio` WHERE `username` = ?"); //Select all from portfolio

	$stmt->bind_param("s", $username);

	$stmt->execute(); 

	$stmt->bind_result($username, $name, $quantity, $price, $total, $cash, $oldId, $order, $orderPrice);

	$orderArray = array(); //Fetch and store in array
	while ($stmt->fetch()) {
		$orderArray[$id] = array(
			'name' => $name,
			'quantity' => $quantity,
			'id' => $oldId,
			'order' => $order,
			'orderprice' => $orderPrice
		);
	}
	
	$stmt->close();

	$mysqli->close();
	
	foreach($orderArray as $key => $orderKey){ //Get each data in database

		$name = $orderKey['name'];
		$quantity = $orderKey['quantity'];
		$oldId = $orderKey['id'];
		$order = $orderKey['order'];
		$orderPrice = $orderKey['orderprice'];

		if ($order=="Stop Loss" ){ //If it is stop loss
			
			//Get price
	    	require 'scripts/equity_price2.php';
	  		if ($name=="Blumont, A33.SI"){
	  			$currentPrice = $blumont;
	  		} elseif ($name=="Ezra, 5DN.SI"){
	  			$currentPrice = $ezra;
	  		} elseif ($name=="GoldenAgr, E5H.SI"){
	  			$currentPrice = $goldenagr;
	  		} elseif ($name=="$ Viking, 557.SI"){
	  			$currentPrice = $viking;
	  		} elseif ($name=="Noble Grp, N21.SI"){
	  			$currentPrice = $noble;
	  		} elseif ($name=="$ Rex Intl, 5WH.SI"){
	  			$currentPrice = $rex;
	  		} elseif ($name=="Dragon Gp, MT1.SI"){
	  			$currentPrice = $dragon;
	  		} elseif ($name=="LionGold, A78.SI"){
	  			$currentPrice = $liongold;
	  		} elseif ($name=="Singtel, Z74.SI"){
	  			$currentPrice = $singtel;
	  		} elseif ($name=="$ Sky One, 5MM.SI"){
	  			$currentPrice = $skyone;
	  		} elseif ($name=="$ Vallianz, 545.SI"){
	  			$currentPrice = $vallianz;
	  		} elseif ($name=="Genting SP, G13.SI"){
	  			$currentPrice = $gentingsp;
	  		} elseif ($name=="Capitaland, C31.SI"){
	  			$currentPrice = $capitaland;
	  		} elseif ($name=="SIIC Env, 5GB.SI"){
	  			$currentPrice = $siic;
	  		} elseif ($name=="e Genting HK US$, S21.SI"){
	  			$currentPrice = $gentinghk;
	  		} elseif ($name=="Yangzijiang, BS6.SI"){
	  			$currentPrice = $yangzijiang;
	  		} elseif ($name=="Asiasons, 5ET.SI"){
	  			$currentPrice = $asiasons;
	  		} elseif ($name=="GLP, MC0.SI"){
	  			$currentPrice = $glp;
	  		} elseif ($name=="CapMallsAsia, JS8.SI"){
	  			$currentPrice = $capmallsasia;
	  		} elseif ($name=="EzionHldg, 5ME.SI"){
	  			$currentPrice = $ezionhldg;
	  		} else{
	  			$currentPrice = "";
	  		}
	  	
	  		if ($currentPrice<=$orderPrice) { //If current price is less than or equal to stop loss price
	  		
	  			$total = $currentPrice*$quantity;
  				$cash = $cash-40+$total;
  				
	  			require_once ('scripts/userdeletedatabase.php'); //Delete from database
  				require_once('scripts/historyinsertdatabase.php'); //Insert into database
  				echo "<script language=javascript>alert('Stop Loss Order had been activated!!')</script>";
	  		}
		}
	}

?>
