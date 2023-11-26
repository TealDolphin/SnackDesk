<?PHP
$input = "";
$return = "";

$pieces = explode($input, "'");

$i = 0;
$return = $pieces[$i++];

while($i < length($pieces)){
  $return = $return . "'" . titleCase($pieces[$i++]) . "'" . $pieces[$i++];
}


// write output to file

function titleCase($name){
  $n = explode($name, ' ');
  $r = '';
  $i = 0;
  if($n[$i] != 
}
?>
