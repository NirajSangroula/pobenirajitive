<?php
$a = 9;
$b = 2;
echo "f(a) : ". squareRootFunction($a). " and f(b) : ". squareRootFunction($b). '<br><br>';
$x = $b;
function squareRootFunction($x){
	return ($x * $x - 5);
}
function derivativeFunction($x){
	return (2 * $x);
}
function entireFunction($x){
	return $x - (squareRootFunction($x) / derivativeFunction($x));
}
echo "<table border=\"3\" style=\"border:3px solid green; border-collapse: collapse; width: 100%; font-size: 1.2rem;color: white;\"><tr style=\"color: blue;\">
	<th>Iteration Number</th><th>New value</th><th>f(x)</th>";
	$i = 1;
while(1){
	if(strval($x) == strval(entireFunction($x))){
		break;
	}
	$functionalValue = squareRootFunction($x);
	echo "<tr style=\"background-color: ".(($i++ % 2 == 0)?"red":"green")."\"><td>x".($i-2)."</td><td>$x</td><td>$functionalValue</td></tr>";
	$x = entireFunction($x);
}