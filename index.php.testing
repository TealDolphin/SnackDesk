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

let page = document.getElementById('main');


let ajax = new XMLHttpRequest();

ajax.open("GET", "importPurchases.php");
ajax.send();

ajax.onreadystatechange = function(){
	if(ajax.readyState == 4 && ajax.status == 200){
		page.innerHTML = ajax.responseText;
	}
};


/*
function callState(){
	let ajax = new XMLHttpRequest();
	
	let fill = '<div style="display: none">Debug</div>';
	
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
	let ajax = new XMLHttpRequest();
	
	let stdId = document.getElementById('stdInput');
	
	if (/^[0-9]{10}$/.test(stdId.value)){
		ajax.open("GET", "control.php?action=submitStudent&ID=" + stdId.value);
		ajax.send();
		
		ajax.onreadystatechange = function(){
			if(ajax.readyState == 4 && ajax.status == 200){
				page.innerHTML = ajax.responseText;
			}
		};
	}else{
		//alert("-" + stdId.value + "-");
		stdId.value = "";
		alert('Invalid student ID, please rescan to try again.');
	}
}

function assignStudent(){
	let ajax = new XMLHttpRequest();
	
	let par = document.getElementById('parents').value;
	let newP = document.getElementById('newPar').value;
	
	if(par == "newParent"){
		ajax.open("GET", "control.php?action=assignParent&new=" + newP + "&par=" + par);
		ajax.send();
		
		ajax.onreadystatechange = function(){
			if(ajax.readyState == 4 && ajax.status == 200){
				page.innerHTML = ajax.responseText;
			}
		};
	} else {
		ajax.open("GET", "control.php?action=assignParent&par=" + par);
		ajax.send();
		
		ajax.onreadystatechange = function(){
			if(ajax.readyState == 4 && ajax.status == 200){
				page.innerHTML = ajax.responseText;
			}
		};
	}
}

function pay(){
	let ajax = new XMLHttpRequest();
	
	let bal = document.getElementById('bal').value;
	let snk = document.getElementById('snk').value;
	let hotl = document.getElementById('hotl').value;
	
	if(snk === ""){snk = 0;}
	if(hotl === ""){hotl = 0;}
	
	
	if(snk < 0 || hotl < 0){
		alert("no");
		return;
	}
	
	//alert(bal + "-" + snk + "-" + hotl);
	
	if((snk + hotl) <= bal){
		ajax.open("GET", "control.php?action=pay&snack=" + snk + "&hotlunch=" + hotl);
		ajax.send();
		
		ajax.onreadystatechange = function(){
			if(ajax.readyState == 4 && ajax.status == 200){
				page.innerHTML = ajax.responseText;
			}
		};
	}else{
		alert("Insufficient Funds.");
	}
	
}


callState();*/


</script>
</body>
</html>


