<?PHP
$input = "";
$return = "";

$pieces = explode($input, "'");

$i = 0;
$return = $pieces[$i++];

while($i < length($pieces)){
  $return = $return . "'" . $pieces[$i++] . "'" . $pieces[$i++];
}


// write output to file
?>
