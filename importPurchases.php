<?php

require_once "model.php";
require_once "jotform-api-php/JotForm.php";



$formID = file_get_contents('formid.env');
$apiKey = file_get_contents('api.env');

$jotformAPI = new JotForm($apiKey);


///*
$forms = $jotformAPI->getForms();
    
    foreach ($forms as $form) {
        print var_dump($form) . '<br><br>';
    }
//*/



//$forms = $jotformAPI->getForms(0, 1, null, null);
// retrieve list of forms, but i already have form number
//echo var_dump($forms[0]);


//$submissions = $jotformAPI->getFormSubmissions($formID);


//echo var_dump($submissions);





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