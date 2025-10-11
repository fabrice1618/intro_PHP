<?php

require_once "04-booleen_fonctions.php";

$language = "ita";

$value = -13; //true
displayBooleanValue($value, "fr");

$value = 0;     //false
displayBooleanValue($value, $value);

$value = 0.0;   //false
displayBooleanValue($value, 'en');

$value = 0.1;   //true
displayBooleanValue($value, $language);

$value = "0";   //false
displayBooleanValue($value, $language);
displayBooleanValue("1", $language);

displayBooleanValue("", $language);

displayBooleanValue('0', $language);


$hasError = false;

if (!$hasError) {
    echo "Tout va bien";
} else {
    echo "Il y a une erreur";
}
