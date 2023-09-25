<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="template.css" />
<title>Page Title</title>
</head>
<body>


<!-- 
static $mainPage = '<div><form action="javascript:;" onsubmit="submitStudent()" ><input type="text" autocomplete="off" placeholder="ID number input" id="stdInput" class="stdInput" pattern="^[0-9]{10}$"></form></div>';
-->
<?php
session_start();
$_SESSION['state'] = 'ready';
?>
<div id='main'></div>
<script type="text/javascript" href="template.js">

let page = document.getElementById('main');


function request(){
    let ajax = new XMLHttpRequest();

    
    
    ajax.open("GET", "control.php?action=load");
    ajax.send();
    
    ajax.onreadystatechange = function(){
        if(ajax.readyState == 4 && ajax.status == 200){
            page.innerHTML = ajax.responseText;
        }
    };
}

function wipe(){
    let ajax = new XMLHttpRequest();
    
    
    ajax.open("GET", "control.php?action=load");
    ajax.send();
    
    ajax.onreadystatechange = function(){
        if(ajax.readyState == 4 && ajax.status == 200){
            page.innerHTML = ajax.responseText;
        }
    };
}

function kick(){
    page.innerHTML = "";
}
</script>
</body>
</html>


