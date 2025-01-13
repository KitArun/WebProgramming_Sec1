<?php
function add($n1,$n2){
    $result = $n1 + $n2;
    echo $result;
}

function subtract($n1,$n2){
    $result = $n1 - $n2;
    echo $result;
}

function multiply($n1, $n2) {
    $result = $n1 * $n2;
    return $result;
}
function divide ($n1,$n2, &$result) {
    $result = $n1 / $n2;
}
$num1 =10;
$num2 =20;

divide($num1,$num2,$resultDivide); //PASS BY VALUE
echo "<br>$num1 / $num2 = " . $resultDivide;

$resultMultiply = 0;
$resultMultiply = multiply($num1,$num2); //PASS BY REFERRAN
echo "<br><br>$num1 * $num2 = " . $resultMultiply;

echo "<br><br>$num1 + $num2 = ", add($num1,$num1);

echo "<br><br>$num1 - $num2 = ", subtract($num1, $num2);
?>