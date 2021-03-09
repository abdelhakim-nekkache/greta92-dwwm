<?php 

function testPermut ($x, $y) {
    $t = $x;
    $x = $y;
    $y = $t;
    echo "valeur 1 = {$x} et valeur 2 = {$y}<br>";
};

$a = 12;
$b = 548; 

echo "\$a = $a<br>";
echo "\$b = $b<br>";
testPermut($a, $b);
echo "\$a = $a<br>";
echo "\$b = $b<br>";


?>