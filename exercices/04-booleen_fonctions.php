<?php

function displayBooleanValue($parameter, $language)
{
    if (($language == "fr") || ($language == 'en')) {
        if ($language == "fr") {
            $parameterMessage = "La valeur de mon parametre est : ";
            $trueMessage = "C'est vrai";
            $falseMessage = "C'est faux";
        } else {
            $parameterMessage = "The value of parameter is : ";
            $trueMessage = "It's true";
            $falseMessage = "It's false";
        }

        echo $parameterMessage;
        var_dump($parameter);

        if ($parameter == true) {
            echo $trueMessage;
        } else {
            echo $falseMessage;
        }
        echo "\n\n";
    } else {
        // Il y a une erreur
        echo "Erreur: langue inconnue!!!\n\n";
    }
}
