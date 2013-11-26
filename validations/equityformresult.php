<?php

$userArriveBySubmittingAForm = !empty($_POST);

$userArriveByClickingOrDirectlyTypeURL = !$userArriveBySubmittingAForm; //Arrive by URL is not the same as submitting a form

if ($userArriveBySubmittingAForm) {

	$nameNotSelected = empty($_POST['name']); //Empty post
	if ($nameNotSelected) {
		$errors['name'] = "Please select an equity"; //If no name selected
	}
	
	$noquantity = empty($_POST['quantity']); //Empty post
	$quantityNotNumeric = !is_numeric($_POST['quantity']); //Post not numeric

	//Error messages
	if ($noquantity) {
		$errors['quantity'] = "Please enter the quantity you wish to purchase";
	} elseif ($quantityNotNumeric) {
		$errors['quantity'] = "Quantity entered is not a number";
	}
	
	$noErrors = (count($errors) == 0);
	$haveErrors = !$noErrors;

	//No errors
	if ($noErrors) {
		if (!empty($_POST['name'])) { //Get name
			$name = $_POST['name'];
		}
		if (!empty($_POST['quantity'])) { //Get quantity
			$quantity = $_POST['quantity'];
		}

		//Get price
	    require 'scripts/equity_price.php';
	  	if ($_POST['name']=="A33.SI"){
	  	$price = $blumont;
	  	} elseif ($_POST['name']=="P05.SI"){
	  	$price = $pfood;
	  	} elseif ($_POST['name']=="E5H.SI"){
	  	$price = $goldenagr;
	  	} elseif ($_POST['name']=="557.SI"){
	  	$price = $viking;
	  	} elseif ($_POST['name']=="N21.SI"){
	  	$price = $noble;
	  	} elseif ($_POST['name']=="5WH.SI"){
	  	$price = $rex;
	  	} elseif ($_POST['name']=="MT1.SI"){
	  	$price = $dragon;
	  	} elseif ($_POST['name']=="A78.SI"){
	  	$price = $liongold;
	  	} elseif ($_POST['name']=="Z74.SI"){
	  	$price = $singtel;
	  	} elseif ($_POST['name']=="5MM.SI"){
	  	$price = $skyone;
	  	} else{
	  	$price = "";
	  	}
	}
}

?>