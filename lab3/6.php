<?php

$a = 10;
$b = 3;
echo $a % $b, "\n";

echo "Переменная a: ";
$a = fgets(STDIN);
echo "Переменная b: ";
$b = fgets(STDIN);
if ($a % $b == 0) {
    echo "Делится ", $a / $b, "\n";
} else {
    echo "Делится с остатком ", $a % $b, "\n";
}


$st = 2**10;
$sqrt_num = 245**1/2;

$array = array(4, 2, 5, 19, 13, 0, 10);
$sqr_sum = 0;
foreach ($array as $value) {
    $sqr_sum += $value**2;
}

echo $st, "\n$sqrt_num", "\nsqrt($sqr_sum)", "\n";


$num1 = sqrt(379);
$num11 = round($num1);
$num22 = round($num1, 1);
$num33 = round($num1, 2);

$num2 = sqrt(587);
$array = ['floor' => floor($num2), 'ceil' => ceil($num2)];

echo "Число 379:",
"\n$sqrtNum0", "\n$sqrtNum1", "\n$sqrtNum2";
echo "\nЧисло 587: ";
var_dump($array);


$array = [4, -2, 5, 19, -130, 0, 10];
echo "Минимальное число: ", min($array),
"\nМаксимальное число: ", max($array), "\n";


echo "Случайное число: ", rand(1, 100), "\n";

$array = [];
for ($i = 0; $i < 10; $i++) {
    $array[$i] = rand(1, 100);
}
var_dump($array);


$a = 100;
$b = 200;
echo 'Модуль разности a и b: ', abs($a - $b), "\n";

$array = [1, 2, -1, -2, 3, -3];
$newArray = array_map('abs', $array);
var_dump($newArray);


echo "Введите число для вывода делителей введённого числа: ";
$a = fgets(STDIN);

$arrayDivisor = [];
for ($d = 1; $d <= $a/2; $d++) {
    if ($a % $d == 0) {
        $arrayDivisor[] = $d;
    }
}

$arrayDivisor[] = intval($a);
echo "Делители числа {$a}:\n";
var_dump($arrayDivisor);

$array = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
$sum = 0;
$count = 0;
foreach ($array as $value) {
    if ($sum <= 10) {
        $sum += $value;
        $count++;
    }
}
echo "{$count} чисел нужно, чтобы их сумма была больше десяти.";