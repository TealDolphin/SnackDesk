<?php
require_once "../model.php";
session_start();

if(isset($_GET['action']) && $_GET['action'] == 'request' && isset($_GET['ID'])){
	//echo '' . $_GET['ID'];
	$par = $theDBA->retrieveParent($_GET['ID']);
	if($par == 'No parents found for this student.'){
		echo 'None';
		exit();
	}
	echo $par;
}

if(isset($_GET['action']) && $_GET['action'] == 'clear' && isset($_GET['ID'])){
	$theDBA->unAssignId($_GET['ID']);
	echo 'ID cleared from student.';
}
?>