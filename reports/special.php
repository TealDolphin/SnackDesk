<?php
require_once "../model.php";
session_start();

if(isset($_GET['action']) && $_GET['action'] == 'hotL'){
	echo $theDBA->hotLunch();
}
?>