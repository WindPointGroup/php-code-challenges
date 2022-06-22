<?php

// example inputs
$arrayA = [3, 1, 2];
$arrayB = [2, 3, 1];


function isSubset($parentArray, $subsetArray)
{

    $parentArray_count = count($parentArray);
    $subsetArray_count = count($subsetArray);

    for ($arr2_index = 0; $arr2_index < $subsetArray_count; $arr2_index++) {

        for ($arr1_index = 0; $arr1_index < $parentArray_count; $arr1_index++) {

            // we found a match so break
            if($subsetArray[$arr2_index] == $parentArray[$arr1_index])
                break;
        }

        // If the above inner loop was not broken at all then arr2[i], is not present in arr1[]
        if ($arr1_index == $parentArray_count)
            return false;
    }

    return true;
}


function doExactMatch($arrayA, $arrayB)
{
    if(count($arrayA) != count($arrayB)){
        return false;
    }

    for ($indexA = 0; $indexA < count($arrayA); $indexA++) {

        if($arrayA[$indexA] != $arrayB[$indexA]){
            return false;
        }

    }

    return true;
}

echo "DO EXACTLY MATCH: " .(doExactMatch($arrayA, $arrayB) ? 'Y':'N').PHP_EOL;
echo "DO MATCH (SUBSET METHOD): " .(isSubset($arrayA, $arrayB, ) ? 'Y':'N').PHP_EOL;
