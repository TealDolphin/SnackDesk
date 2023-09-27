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

<input type="button" id="HotLunch" value="Hot Lunch Report (Soon)" class="wipeButton" onclick="hotL()">
<input type="button" onclick="history()" id="history" value="Student History (WIP)" class="wipeButton">

<script type="text/javascript" href="template.js">

function hotL(){
	const offset = yourDate.getTimezoneOffset()
	let yourDate = new Date(yourDate.getTime() - (offset*60*1000))
	let filename = yourDate.toISOString().split('T')[0] + ".csv"
	
	let ajax = new XMLHttpRequest();
    
    ajax.open("GET", "special.php?action=hotL");
    ajax.send();
    
    ajax.onreadystatechange = function(){
        if(ajax.readyState == 4 && ajax.status == 200){
            download(filename, ajax.responseText);
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
}

</script>
</body>
</html>