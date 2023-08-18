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
function callState(){
	var page = document.getElementById('main');
	var fill = '<div style="display: none">Debug</div>';
	
	//ajax.open("GET","control.php?login=yes&name=" + username + "&pwd=" + document.getElementById("pwd").value);
	ajax.open("GET", "control.php?action=load");
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
}
callState();
</script>
</body>
</html>


