<?php

// Algorithme récursif
function factorielle($n)
{
    if ($n == 1) {
        return 1;
    }

    return $n * factorielle($n - 1);
}

echo "factorielle de 5 = " . factorielle(5) . PHP_EOL;
