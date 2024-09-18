<?php
	//$s->insert(['id' => 1, 'name' => 'niraj', 'phoneNo' => '984035.0970070'], 't');
	//We are finding the square root:
	$n = 2;
	$a = 1;
	$b = 2;
	$y = 10; //Because root of 123
	function squareRootFunction($x, $y){
		return (2* $x * $x * $x - 5 * $x + 2);
	}

	function isNegative($x){
		return ($x < 0);
	}

	function midValue($a, $b){
		return ($a + $b) / 2;
	}
	$m = 0;
	echo "<table border=\"3\" style=\"border:3px solid green; border-collapse: collapse; width: 100%; font-size: 1.2rem;color: white;\"><tr style=\"color: blue;\">
	<th>a</th><th>b</th><th>fa</th><th>fb</th><th>m</th><th>fm</th><th>b-a</th></tr>";
	$i = 1;
	while(1){
		if ($m == midValue($a, $b))
			break;
		$fa = squareRootFunction($a, $y);
		$fb = squareRootFunction($b, $y);
		$m = midValue($a, $b);
		$fm = squareRootFunction($m, $y);
		echo "<tr style=\"background-color: ".(($i++ % 2 == 0)?"red":"green")."\"><td>$a</td><td>$b</td><td>$fa</td><td>$fb</td><td>$m</td><td>$fm</td><td>".($b-$a)."</td></tr>";
		if(isNegative($fa * $fm)){
			$b = $m;
		}
		else{
			$a = $m;
		}
		// echo midValue($a, $b) . "<br>";
	}
	echo "</table>";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Pobenirajitive</title>
	<style type="text/css">
		td{
			border: 8px solid black;
		}
	</style>
</head>
<body>
	
</body>
</html>