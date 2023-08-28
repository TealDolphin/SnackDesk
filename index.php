<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="template.css" />
<title>Page Title</title>
</head>
<body>
<!-- Comment, both single line and multi line -->
<?php
session_start();
$_SESSION['state'] = 'ready';
?>
<div id='main'></div>
<script type="text/javascript" href="template.js">

var page = document.getElementById('main');

function callState(){
	var fill = '<div style="display: none">Debug</div>';
	
	//ajax.open("GET","control.php?login=yes&name=" + username + "&pwd=" + document.getElementById("pwd").value);
	ajax.open("GET", "control.php?action=load");
    ajax.send();
    
    ajax.onreadystatechange = function(){
        if(ajax.readyState == 4 && ajax.status == 200){
            page.innerHTML = ajax.responseText;
        }
    };
	
	//page.innerHTML = fill;
}

function submitStudent(){
	var stdId = document.getElementById('stdInput').innerHTML;
	if (stdId.length == 10 && /^[0-9]{10}$/.test(stdId)){
		ajax.open("GET", "control.php?action=submitStudent&ID=" + stdId);
		ajax.send();
		
		ajax.onreadystatechange = function(){
			if(ajax.readyState == 4 && ajax.status == 200){
				var output = ajax.responseText;
				if(output == "Succsessful login attempt."){
					
				}
				document.getElementById("message").value
			}
		};
		page.innerHTML = fill;
	}else{
		alert('Invalid student ID, please rescan to try again.');
	}
}

function assignStudent(){
	var par = document.getElementById('parents').value;
	var newP = document.getElementById('newPar').innerHTML;
	if(par == "newParent"){
		ajax.open("GET", "control.php?action=assignParent&new=" + newP + "&par=" + newP);
		ajax.send();
		
		ajax.onreadystatechange = function(){
			if(ajax.readyState == 4 && ajax.status == 200){
				var output = ajax.responseText;
				if(output == "Succsessful login attempt."){
					
				}
				document.getElementById("message").value
			}
		};
	}
	
	ajax.open("GET", "control.php?action=assignParent&par=" + par);
		ajax.send();
		
		ajax.onreadystatechange = function(){
			if(ajax.readyState == 4 && ajax.status == 200){
				var output = ajax.responseText;
				if(output == "Succsessful login attempt."){
					
				}
				document.getElementById("message").value
			}
		};
}


callState();
</script>
</body>
</html>


