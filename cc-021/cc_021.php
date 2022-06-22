<?php

// example inputs
$numbers = [2, 3, 1,3,4,5,6,7,7,3,3,3,2];

function findOccurrences($numbers){
    $occurrences = [];

    foreach ($numbers AS  $number) {
        if(!isset($occurrences[$number])){
            $occurrences[$number] = 0;
        }
        $occurrences[$number] += 1;
    }

    return $occurrences;
}

echo "OCCURRENCES: " .json_encode(findOccurrences($numbers)).PHP_EOL;
