<?php

for ($number = 1; $number <= 42; $number++) {
    $divisors = array();       // autre syntaxe: $divisors = [];

    if ($number % 2 == 0) {
        $divisors[] = "2";
    }
    if ($number % 3 == 0) {
        $divisors[] = "3";
    }
    if ($number % 5 == 0) {
        $divisors[] = "5";
    }

    $message = "";

    switch (count($divisors)) {
        case 1:
            // Est divisible par 2
            $message = "Est divisible par " . $divisors[0];
            break;
        case 2:
            // Est divisible par 2 et 3
            $message = "Est divisible par " . $divisors[0] . " et " . $divisors[1];
            break;
        case 3:
            // Est divisible par 2, 3 et 5
            $message = "Est divisible par 2, 3 et 5";
            break;

        default:
            break;
    }

    echo $number . " " . $message . "\n";
}
