<?php

require_once "06-chaine_fonctions.php";

$result1 = isEmpty('');

$result2 = isEmpty("");

$result3 = isEmpty("A");

$result4 = isEmpty(" ");

$result5 = isValidPassword(" ");
if ($result5 == true) {
    echo "password OK\n";
} else {
    echo "password NOK\n";
}
$result6 = isValidPassword("Aa1-Bb2@");
if ($result6 == true) {
    echo "password OK\n";
} else {
    echo "password NOK\n";
}
$result7 = isValidPassword("Aa1- Bb2");
if ($result7 == true) {
    echo "password OK\n";
} else {
    echo "password NOK\n";
}
$result8 = isValidPassword("Aa-Bb@CcTtY");
if ($result8 == true) {
    echo "password OK\n";
} else {
    echo "password NOK\n";
}
$result9 = isValidPassword("Aa1-Bb2");
if ($result9 == true) {
    echo "password OK\n";
} else {
    echo "password NOK\n";
}
