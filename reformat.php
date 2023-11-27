<?PHP
$input = "";
$return = "";

$pieces = explode("'", $input);

$i = 0;
$return = $pieces[$i++];
$a = sizeof($pieces);

while($i < $a){
  $return = $return . "'" . titleCase($pieces[$i++]) . "'" . $pieces[$i++];
}
$myfile = fopen("clean.txt", "w") or die("AAAAAAAAAAAA");
fwrite($myfile, $return);
fclose($myfile);

// write output to file

function titleCase($name){
  $n = explode(' ', trim($name));
  $i = 0;
  $r = ucfirst(strtolower(trim($n[$i++])));
  $a = sizeof($n);
  while($i < $a){
	  $m = ucfirst(strtolower(trim($n[$i++])));
	  if($m != ''){
		  $r = $r . ' ' . $m;
	  }
  }
  return $r;
}

//ucfirst(strtolower($m))
?>
