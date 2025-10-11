<?php

function isValidPassword($password)
{
    $isPasswordValid = false;

    $hasDigit = false;  // Chiffres
    $hasSymbol = false;  // Symboles presents
    $hasLowerCase = false;  // Minuscules
    $hasUpperCase = false;  // Majuscules
    $hasForbiddenChar = false;

    // Faire tous les tests
    $index = 0;
    $passwordLength = 0;

    while (($index < strlen($password)) && ($hasForbiddenChar == false)) {
        // Lire le caractere pointé par index
        $char = $password[$index];

        // Verifier si le caractere est un chiffre
        if (isDigit($char)) {        // Si le caractere est un chiffre
            $hasDigit = true;               // Alors la condition1 est vraie
            $passwordLength++;              // Et j'ajoute un a la Longueur du mot de passe
        }

        // Verifier si le caractere est un symbole
        if (isSymbol($char)) {
            $hasSymbol = true;
            $passwordLength++;
        }

        // Verifier si le caractere est une lettre minuscule
        if (isLowerCase($char)) {
            $hasLowerCase = true;
            $passwordLength++;
        }

        // Verifier si le caractere est un chiffre majuscule
        if (isUpperCase($char)) {
            $hasUpperCase = true;
            $passwordLength++;
        }

        if (
            (isDigit($char) == false) &&
            (isSymbol($char) == false) &&
            (isLowerCase($char) == false) &&
            (isUpperCase($char) == false)
        ) {
            $hasForbiddenChar = true;
        }

        $index++;
    }


    if (
        ($passwordLength >= 8) &&
        ($hasDigit == true) &&
        ($hasSymbol == true) &&
        ($hasLowerCase == true) &&
        ($hasUpperCase == true)
    ) {
        $isPasswordValid = true;
    }

    return $isPasswordValid;
}


function isDigit($char)
{
    $result = false;

    if (($char >= '0') && ($char <= '9')) {
        $result = true;
    }

    return $result;
}

// Verifier si le caractere est un symbole
function isSymbol($char)
{
    $result = false;

    if (
        ($char == '@') ||
        ($char == '/') ||
        ($char == '-') ||
        ($char == ':') ||
        ($char == '=')
    ) {
        $result = true;
    }

    return $result;
}


// Verifier si le caractere est une lettre minuscule
function isLowerCase($char)
{
    $result = false;

    if (($char >= 'a') && ($char <= 'z')) {
        $result = true;
    }

    return $result;
}


// Verifier si le caractere est un chiffre majuscule
function isUpperCase($char)
{
    $result = false;

    if (($char >= 'A') && ($char <= 'Z')) {
        $result = true;
    }

    return $result;
}


function isEmpty($string)
{
    $result = false;

    if (($string == '') || ($string == "")) {
        echo "La chaine est vide\n\n";
        $result = true;
    } else {
        echo "La chaine n'est pas vide\n\n";
        $result = false;
    }

    return $result;
}
