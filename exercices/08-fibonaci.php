<?php

$previous2 = 1;
$previous1 = 1;
printf("%3d\n", $previous2);
printf("%3d %8.5f\n", $previous1, $previous1 / $previous2);

while ($previous2 + $previous1 <= 100) {
    $current = $previous2 + $previous1;
    printf("%3d %8.5f\n", $current, $current / $previous1);
    $previous2 = $previous1;
    $previous1 = $current;
}
