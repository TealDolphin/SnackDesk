<?php

require_once "model.php";
require_once "JotForm.php";


$jotformAPI = new JotForm("YOUR API KEY");
$forms = $jotformAPI->getForms(0, 1, null, null);


$par = parentsList();

foreach($forms as $arr){
	if(in_array($forms[0],$arr)){
		addMoney($forms[0],$forms[1]);
	}else{
		addParent($forms[0]);
		addMoney($forms[0],$forms[1]);
	}
}





// $theDBA->totalStudents($level);

/*
$f = fopen("dev/tempBan.log", "a") or die("Unable to open file!");
fwrite($f, $_SERVER['REMOTE_ADDR'] . '<::>' . strval(time()) . "\n");
fclose($f);
*/

?>