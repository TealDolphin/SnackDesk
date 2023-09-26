<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../template.css" />
<title>Unassign ID</title>
</head>

<body>
<?php
session_start();
$_SESSION['state'] = 'ready';
?>
<div id='main'>
<div><form action="javascript:;" onsubmit="request()" id="form1" class="wipeForm"><h2 id="headline">Input Student ID to Unassign:</h2><input type="text" autocomplete="off" placeholder="ID number input" id="stdInput" class="wipeID" pattern="^[0-9]{10}$"></form></div>
</div>
<script type="text/javascript" href="template.js">

let page = document.getElementById('main');


function request(){
    let ajax = new XMLHttpRequest();
    let id = document.getElementById('stdInput').value;
    let f = document.getElementById('form1');
	let headline = document.getElementById('headline');
	
	// remove previous no student found message
	let negative = document.getElementById('Nope');
	if(negative){
		negative.remove();
	}
	
	
	//alert(id);
	
    ajax.open("GET", "special.php?action=request&ID=" + id);
    ajax.send();
    
    ajax.onreadystatechange = function(){
        if(ajax.readyState == 4 && ajax.status == 200){
			//alert(ajax.responseText);
			if(ajax.responseText === "None"){
				page.innerHTML = "<h3 id=\"Nope\">No students found for this ID.</h3>" + page.innerHTML;
			}else{
				// clear the form and set it to yes/no for wiping or not.
				f.innerHTML = "";
				headline.innerHTML = "Clear ID from student \"" + ajax.responseText + "\"?";
				f.appendChild(headline);
				f.innerHTML = f.innerHTML + "<input type=\"hidden\" id=\"ID\" value=\"" + id + "\">";
				f.innerHTML = f.innerHTML + "<input type=\"button\" id=\"Yes\" name=\"Yes\" value=\"Yes\" class=\"wipeButton\" onclick=\"wipe()\"><input type=\"button\" onclick=\"location=location\" id=\"No\" name=\"No\" value=\"No\" class=\"wipeButton\">";
			}
        }
    };
}

function wipe(){
    let ajax = new XMLHttpRequest();
    let id = document.getElementById('ID').value;
    
    ajax.open("GET", "special.php?action=clear&ID=" + id);
    ajax.send();
    
    ajax.onreadystatechange = function(){
        if(ajax.readyState == 4 && ajax.status == 200){
            page.innerHTML = "<h2>" + ajax.responseText + "</h2>";
        }
    };
}
</script>
</body>
</html>


