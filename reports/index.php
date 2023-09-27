<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../template.css" />
<title>Reports</title>
</head>
<body>
<?php
session_start();
$_SESSION['state'] = 'ready';
?>

<form action="javascript:;" onsubmit="hotL()" id="HL">
<input type="submit" id="HotLunch" value="Hot Lunch Report" class="wipeButton" style="float: left;">
</form>
<form action="javascript:;" onsubmit="history()" id="h">
<input type="submit" id="hist" value="Student History (WIP)" class="wipeButton" style="float: left;">
</form>

<br>
<br>
<br>
<h3 id="msg"></h3>

<script type="text/javascript" href="template.js">

function hotL(){
	let yourDate = new Date();
	const offset = yourDate.getTimezoneOffset();
	yourDate = new Date(yourDate.getTime() - (offset*60*1000));
	let filename = yourDate.toISOString().split('T')[0] + ".csv";
	
	let ajax = new XMLHttpRequest();
    
    ajax.open("GET", "special.php?action=hotL");
    ajax.send();
    
    ajax.onreadystatechange = function(){
        if(ajax.readyState == 4 && ajax.status == 200){
            if(download(filename, ajax.responseText)){
				document.getElementById("msg").innerHTML = "Month of Hot Lunch History Downloaded";
			}
        }
    };
}

function download(filename, text) {
	let element = document.createElement('a');
	element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
	element.setAttribute('download', filename);

	element.style.display = 'none';
	document.body.appendChild(element);

	element.click();

	document.body.removeChild(element);
	return true;
}

function history(){
	document.getElementById("msg").innerHTML = "Student History Comming Soon";
}

</script>
</body>
</html>