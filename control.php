<?php
// single line comment
/*
multi line comment
*/

$mainPage = '<div><form action="javascript:;" onsubmit="submitStudent()"><input type="text" id="stdInput" style="margin:auto"></div>';

// inital load and anytime i would like to kick back inital page quickly
if($action == 'load'){
	// return basic page and kick back
	echo $mainPage;
	exit();
}

if($action == 'submitStudent'){
	if(!preg_match('/^[0-9]{10}$/', $ID)){
		echo $mainPage . '<p>Incorrect student ID. Please try again.</p>';
		exit();
	}
	$_SESSION['std'] = $ID;
	echo '<form onsubmit=""><h3>Snack Bar Purchase</h3><imput type="text"><br><p>Hot Lunch Purchase</p><imput type="text" id=""><input type="submit" value="Purchase"></form>';
}

if($action == 'pay'){
	if(isset($snack) && isset($hotlunch) && isset($_SESSION['std'])){
		$par = retrieveParent($_SESSION['std']);
		if($snack < 0 || $hotlunch < 0){
			throw new Exception('Invalid value error.');
		}
		if(($snack + $hotlunch) > retrieveMoney($par)){
			throw new Exception('Isufficient funds error.');
		}
	}else{
		throw new Exception('Invalid access error.');
	}
}

/*
function f($var){
    $str = "Hello World!";
    echo $str;
    return "Goodbye.";
}

echo f;*/
?>
