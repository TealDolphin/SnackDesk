<?php
require_once "model.php";
session_start();



if(isset($_SESSION['clear'])){
	unAssignId($_SESSION['clear']);
	echo 'ID cleared from student.';
}
?>