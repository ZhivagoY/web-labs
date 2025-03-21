<?php
function increaseEnthusiasm($string): string {
    return $string . "!";
}

echo increaseEnthusiasm("string") . "\n";

function repeatThreeTimes($string): string {
    return $string . $string . $string;
}

echo repeatThreeTimes("string!") . "\n";

echo increaseEnthusiasm(repeatThreeTimes("string")) . "\n";

function cut($string, $length = 10): string {
    return substr($string, 0, $length);
}

echo cut("enthusiastic"), "\n";

function printArrayRecursively($arr, $index = 0) {
    if ($index < count($arr)) { 
        echo $arr[$index] . " "; 
        printArrayRecursively($arr, $index + 1);
    }
}

$arr = [1, 2, 3, 4, 5];
printArrayRecursively($arr);

echo "\n";

function sumDigitsRecursively($num) {
    if ($num <= 9) {
        return $num;
    }

    return sumDigitsRecursively(array_sum(str_split($num)));
}

echo sumDigitsRecursively(45367); 