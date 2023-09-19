<?php

require_once "model.php";
require_once "jotform-api-php/JotForm.php";


$formID = file_get_contents('formid.env');
$apiKey = file_get_contents('api.env');

$jotformAPI = new JotForm($apiKey);


/*
$forms = $jotformAPI->getForms();
    
    foreach ($forms as $form) {
        print var_dump($form) . '<br><br>';
    }
*/



//$forms = $jotformAPI->getForms(0, 1, null, null);
// retrieve list of forms, but i already have form number
//echo var_dump($forms[0]);


$submissions = $jotformAPI->getFormSubmissions($formID, 0, 100, NULL, "created_at");

//echo var_dump(array_keys($submissions)) . '<br><br>';
//echo var_dump($submissions[0]['answers'][6]['answer']) . '<br><br>';

//echo var_dump(($submissions[1]['created_at'])) . '<br><br>';

/*
echo var_dump($submissions[0]['answers'][6]['answer'][1]) . '<br><br>';
echo var_dump($submissions[0]['answers'][6]['answer'][2]) . '<br><br>';
echo var_dump($submissions[0]['answers'][6]['answer'][3]) . '<br><br>';
echo var_dump($submissions[0]['answers'][6]['answer'][4]) . '<br><br>';
echo var_dump($submissions[0]['answers'][6]['answer'][5]) . '<br><br>';
echo var_dump($submissions[0]['answers'][6]['answer'][6]) . '<br><br>';
echo var_dump($submissions[0]['answers'][6]['answer']['paymentArray']) . '<br><br>';
/* * /
echo var_dump(json_decode($submissions[0]['answers'][6]['answer']['paymentArray'], true)['shortView']['products'][0]) . '<br><br>';
echo var_dump(json_decode($submissions[0]['answers'][6]['answer']['paymentArray'], true)['shortView']['products'][1]) . '<br><br>';
echo var_dump(json_decode($submissions[0]['answers'][6]['answer']['paymentArray'], true)['shortView']['products'][2]) . '<br><br>';
echo var_dump(json_decode($submissions[0]['answers'][6]['answer']['paymentArray'], true)['shortView']['products'][3]) . '<br><br>';
echo var_dump(array_keys(json_decode($submissions[0]['answers'][6]['answer']['paymentArray'], true))) . '<br><br>';
*/


$today = date("Y-m-d") . ' 11:00:00';
$last = trim(file_get_contents('lastImportDate.env'));

echo "$today, $last,<br><br>";

///*
foreach($submissions as $s){
	$name = $s['answers'][3]['prettyFormat'];
	$data = array_keys($s['answers']);
	/*	
	$x = $s['answers'];
	echo "<br><br>" . var_dump($x[1]) ."<br><br>";
	echo "<br><br>" . var_dump($x[2]) ."<br><br>";
	echo "<br><br>" . var_dump($x[3]) ."<br><br>";
	echo "<br><br>" . var_dump($x[11]) ."<br><br>";
	$q = $x[6];
	$w = $q['answer'];
	$u = $w['paymentArray'];
	$r = json_decode($u, true);
	$t = $r['total'];
	$val = intval($t)*100;
	*/
	
	if(array_key_exists('answer', $s['answers'][$data[3]])){
		$val = intval(json_decode($s['answers'][$data[3]]['answer']['paymentArray'], true)['total'])*100;
		$d = trim($s['created_at']);
		//echo var_dump($s) . '<br><br><br>';
		//echo var_dump($val) . '<br><br><br>';
		// if the date of the submition is between the last added date and today, then add it.
		if($d >= $last && $d < $today){
			$theDBA->addMoney($name, $val);
			//$theDBA->test();
			echo "-<br>";
		}
		echo "Name: $name, Total: $val, $d<br>";
		//echo "<br><br>";
	}
	echo "Name: $name<br>";
}
///*
//update the last added date to today.
$f = fopen('lastImportDate.env', 'w');
fwrite($f, $today);
fclose($f);
//*/



//id, form_id, ip, created_at, status, new, flag, notes, updated_at, answers



/*
$par = parentsList();

foreach($forms as $arr){
	if(in_array($forms[0],$arr)){
		addMoney($forms[0],$forms[1]);
	}else{
		addParent($forms[0]);
		addMoney($forms[0],$forms[1]);
	}
}
*/




// $theDBA->totalStudents($level);

/*
$f = fopen("dev/tempBan.log", "a") or die("Unable to open file!");
fwrite($f, $_SERVER['REMOTE_ADDR'] . '<::>' . strval(time()) . "\n");
fclose($f);
*/

?>