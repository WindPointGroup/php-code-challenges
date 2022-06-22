<?php

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

// example inputs
$arr1 = array(11, 1, 13, 21, 3, 7);
$arr2 = array(11, 3, 7, 5);


if(isSubset($arr1, $arr2)) {
    echo "arr2[] is subset of arr1[] " . PHP_EOL;
}else {
    echo "arr2[] is not a subset of arr1[]" . PHP_EOL;
}
