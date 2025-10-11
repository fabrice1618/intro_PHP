<?php

$language = 'fr';

if ($language == 'fr') {
    echo "C'est en francais\n";
} elseif ($language == 'en') {
    echo "C'est en anglais\n";
} else {
    echo "Bachibouzouk";
}


$value = 3;

if (($value == 2) || ($value == 3)) {
    echo "La variable vaut 2 ou 3\n";
} elseif (($value == 5) || ($value == 6)) {
    echo "La variable vaut 5 ou 6\n";
} else {
    echo "La variable vaut autre chose\n";
}


$age = 25;
$hasLicense = true;

if (($age >= 18) && ($hasLicense == true)) {
    echo "Vous pouvez conduire\n";
} elseif (($age >= 18) && ($hasLicense == false)) {
    echo "Vous avez l'âge mais pas le permis\n";
} else {
    echo "Vous êtes trop jeune pour conduire\n";
}
