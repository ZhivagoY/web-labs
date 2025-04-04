<?php
$str = 'a1b2c3';
$result = preg_replace_callback('/\d+/', function($matches) {
    $number = intval($matches[0]);
    $divided = $number / 2;
    return $divided;
}, $str);
echo $result; // Выведет: a0.5b1c1.5