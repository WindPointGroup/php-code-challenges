<?php

const SUM_FILTER_VALUE = 15;
$input = [2,3,1,1,5,8,10,7];
//$input = [1,2,3];

class Combination{
    public $values;

    function __construct($values) {
        $this->values = $values;

    }

    function getValues(){
        return $this->values;
    }

    function getSum(){
        return array_sum($this->values);
    }
}

function findCombinations($array, $include_empty = false) {

    // initialize by adding the empty set
    $results = [new Combination([])];

    // add each combination
    foreach ($array as $element){
        foreach ($results as $combination) {
            array_push($results, (new Combination(array_merge(array($element), $combination->getValues()))));
        }
    }

    // remove empty set if need be
    if(!$include_empty){
        array_splice($results, 0,1);
    }
    return $results;
}

function filterCombinations($combinations, $value){
    $filtered = [];
    foreach ($combinations AS $combination){
        if($combination->getSum() >= $value){
            $filtered[] = $combination;
        }
    }
    return $filtered;
}

// get combos
$combinations = findCombinations($input);

//echo "combinations: " .json_encode($combinations) . PHP_EOL;

// filter by value
$filtered = filterCombinations($combinations, SUM_FILTER_VALUE);

// results
echo "TOTAL COUNT: " .count($combinations) . PHP_EOL;
echo "FILTER COUNT: " .count($filtered) . PHP_EOL;
