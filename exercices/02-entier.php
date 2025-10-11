<?php

$a = 1.5;
$a = (int) (3 / 2);
$a = intval(3 / 2);

$a = 13 / 3;
var_dump($a);

$a = 4.505;
$b = round($a, 2, PHP_ROUND_HALF_DOWN);
var_dump($b);


echo "max:" . PHP_INT_MAX . "\n";
echo "size:" . PHP_INT_SIZE . PHP_EOL;  // Taille en octets

$large_number = 9223372036854775807;
var_dump($large_number);                     // int(9223372036854775807)

$large_number = 9223372036854775808;
var_dump($large_number);                    // float(9.2233720368548E+18)
