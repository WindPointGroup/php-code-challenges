<?php

// example inputs
$arrayA = [3, 1, 2];
$arrayB = [2, 3, 1];


function findMatches($arrayA, $arrayB)
{

    $matches = [];
    for ($indexA = 0; $indexA < count($arrayA); $indexA++)
    {

        // method 1
        $match = array_search($arrayA[$indexA], $arrayB);
        if($match !== false){
            $matches[$arrayA[$indexA]] = $match;
            //echo $arrayA[$indexA] . " is match index " . $match .PHP_EOL;
        }

        // method 2
//        for ($indexB = 0; $indexB < count($arrayB); $indexB++)
//        {
//            // we found a match so break
//            if($arrayA[$indexA] == $arrayB[$indexB]){
//
//                echo $arrayA[$indexA] . " is index " . $indexB .PHP_EOL;
//                break;
//            }
//        }

    }

    return $matches;
}

echo "MATCHES: " .json_encode(findMatches($arrayA, $arrayB)).PHP_EOL;
