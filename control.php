<?php
// single line comment
/*
multi line comment
*/

$mainPage = '<div><form action="javascript:;" onsubmit="submitStudent()"><input type="text" id="stdInput" style="margin:auto"></form></div>';

// inital load and anytime i would like to kick back inital page quickly
if($action == 'load'){
	unset($_SESSION['std']);
	// return basic page and kick back
	echo $mainPage;
	exit();
}

if($action == 'assignParent'){
	if(!isset($par)){throw new Exception('Required variables error.');}
	if(isset($new)){
		$theDBA->addParent($new);
	}
	$theDBA->assignParent($_SESSION['std'], $par);
	echo 'ID added to account ' . $par . '<br>';
	$action == 'submitStudent';
}

if($action == 'submitStudent'){
	if(!preg_match('/^[0-9]{10}$/', $ID)){
		echo $mainPage . '<p>Incorrect student ID. Please try again.</p>';
		exit();
	}
	$_SESSION['std'] = $ID;
	$par = $theDBA->retrieveParent($std);

	if($par == 'No parents found for this student.'){
		$allP = $theDBA->parentsList();
		$options = '<form action="javascript:;" onsubmit="assignStudent()"><label for="parents">Assign student to a Parent:</label><select name="parents", id="parents">';
		foreach($allP as $p){
			$options = $options . '<>' . $p . '</>';
		}
		$options = $options . '<option value="newParent">New Parent</>';
		echo '' . $options . '<br><br><label for="newPar">Assign to new parent:</label><input type="text" id="newPar"><br><br><input type="submit" value="Submit"></form>';
		exit();
	}else{
	$bal = $theDBA->retrieveBal($par);
	echo '<h3>Snack Bar Purchase</h3><div><p>Account Info:</p> <p>Name: ' . $par . '</p> <p>Balance: $' . $bal . '</p> </div><form onsubmit="javascript" ="purchase()"><input type="text"><br><p>Hot Lunch Purchase</p><input type="text" id=""><input type="submit" value="Purchase"></form>';
	exit();
	}
}

if($action == 'pay'){
	if(isset($snack) && isset($hotlunch) && isset($_SESSION['std'])){
		$par = $theDBA->retrieveParent($_SESSION['std']);
		
		// convert to cents for database use
		$snack = intval($snack*100);
		$hotlunch = intval($hotlunch*100);
		
		if($par == 'No parents found for this student.'){
			throw new Exception('Invalid student error.');
		}elseif($snack < 0 || $hotlunch < 0){
			throw new Exception('Invalid value error.');
		}elseif(($snack + $hotlunch) > retrieveMoney($par)){
			throw new Exception('Isufficient funds error.');
		}

		$theDBA->purchase($_SESSION['std'], $snack, $hotlunch);
		$o = '';
		if($snack > 0){$o = $o . '<p>Purchased snacks worth $' . $snack/100 . ' from the snack bar.</p>';}
		if($hotlunch > 0){$o = $o . '<p>Purchased hot lunch(es) worth $' . $hotlunch/100 . ' from the snack bar.</p>';}
		echo $o . $mainPage;
		unset($_SESSION['std']);
		exit();
	}else{
		throw new Exception('Invalid access error.');
	}
}

if($action == 'history'){
	if(!isset($_SESSION['std'])){
		throw new Exception('No student error.');
	}
	// DONOTDO. this is for returning the history of the purchases. low priority if i can get the rest working
}

/*
function f($var){
    $str = "Hello World!";
    echo $str;
    return "Goodbye.";
}

echo f;*/
?>
