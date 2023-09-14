<?php
// single line comment
/*
multi line comment
*/
//require_once "rebuildSQL.php";
require_once "model.php";
session_start();

static $mainPage = '<div><form action="javascript:;" onsubmit="submitStudent()" ><input type="text" autocomplete="off" placeholder="ID number input" id="stdInput" class="stdInput" pattern="^[0-9]{10}$"></form></div>';

// inital load and anytime i would like to kick back inital page quickly
if($_GET['action'] == 'load'){
	unset($_SESSION['std']);
	// return basic page and kick back
	echo $mainPage;
	exit();
}

if($_GET['action'] == 'assignParent'){
	
	//echo $_GET['par'] . '-' . $_GET['new'];
	
	if(!isset($_GET['par'])){throw new Exception('Required variables error.');}
	if(isset($_GET['new'])){
		$theDBA->addParent($_GET['new']);
		$_GET['par'] = $_GET['new'];
	}
	$theDBA->assignParent($_SESSION['std'], $_GET['par']);
	echo 'ID added to account ' . $_GET['par'] . '<br>';
	
	$_GET['action'] = 'submitStudent';
	$_GET['ID'] = $_SESSION['std'];
}

if($_GET['action'] == 'submitStudent'){
	if(!isset($_GET['ID'])){throw new Exception('No student error.');}
	
	if(!preg_match('/^[0-9]{10}$/', $_GET['ID'])){
		echo $mainPage . '<p>Incorrect student ID. Please try again.</p>';
		exit();
	}
	$_SESSION['std'] = $_GET['ID'];
	$par = $theDBA->retrieveParent($_SESSION['std']);

	if($par == 'No parents found for this student.'){
		$allP = $theDBA->parentsList();
		$options = '<form action="javascript:;" onsubmit="assignStudent()"><label for="parents">Assign ID to a Student:</label><select name="parents", id="parents">';
		
		$options = $options . '<option value="newParent">New Parent</option>';
		
		foreach($allP as $p){
			$options = $options . '<option value="' . $p . '">' . $p . '</option>';
		}
		echo '' . $options . '<br><br><label for="newPar">Assign to new student:</label><input type="text" id="newPar"><br><br><input type="submit" value="Submit"></form>';
		exit();
	}else{
	$bal = ($theDBA->retrieveBal($par))/100;
	echo '<h3>Snack Bar Purchase</h3><div><p>Account Info:</p> <p>Name: ' . $par . '</p> <p>Balance: $' . $bal . '</p> <input id="bal" value="' . $bal . '" hidden> </div><form action="javascript:;" onsubmit="pay()"><input id="snk" pattern="^[0-9]*\.?[0-9]*$" type="text"><br><p>Hot Lunch Purchase</p><input type="text" id="hotl" pattern="^[0-9]*\.?[0-9]*$"><input type="submit" value="Purchase"></form>';
	exit();
	}
}

if($_GET['action'] == 'pay'){
	//echo "asdfkjhl;asdfuhkilaew";
	if(isset($_GET['snack']) && isset($_GET['hotlunch']) && isset($_SESSION['std'])){
		$par = $theDBA->retrieveParent($_SESSION['std']);
		
		//$TODO =  $_GET['snack'] . '-' . $_GET['hotlunch'] . '-' . $_SESSION['std'];
		
		
		// convert to cents for database use
		$snack = intval($_GET['snack']*100);
		$hotlunch = intval($_GET['hotlunch']*100);
		
		if($par == 'No parents found for this student.'){
			throw new Exception('Invalid student error.');
		}elseif($snack < 0 || $hotlunch < 0){
			throw new Exception('Invalid value error.');
		}elseif(($snack + $hotlunch) > $theDBA->retrieveBal($par)){
			throw new Exception('Isufficient funds error.');
		}

		$theDBA->purchase($_SESSION['std'], $snack, $hotlunch);
		$o = '';
		if($snack > 0){$o = $o . '<p>Purchased snacks worth $' . $snack/100 . ' from the snack bar.</p>';}
		if($hotlunch > 0){$o = $o . '<p>Purchased hot lunch(es) worth $' . $hotlunch/100 . ' from the snack bar.</p>';}
		
		//echo $TODO . $o . $mainPage;
		
		echo $o . $mainPage;
		
		unset($_SESSION['std']);
		exit();
	}else{
		throw new Exception('Invalid access error.');
	}
}

if($_GET['action'] == 'history'){
	if(!isset($_SESSION['std'])){
		throw new Exception('No student error.');
	}
	echo('Work in progress. Check back later.');
	exit();
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
