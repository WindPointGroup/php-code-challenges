<?php

// example input
$edges = [[0, 1], [1, 2], [1, 3], [2, 3], [3, 0]];

function adjacentList($graph, $pretty = true)  {

    $list = [];

    // iterate
    foreach ($graph ?? [] as $child) {
        if(!isset($list[$child[0]])){
            $list[$child[0]] = [];
        }
        $list[$child[0]][] = $child[1];
    }

    $string = '';
    foreach ($list as $vertex => $adjacents) {
        if(!empty($string)){
            $string .= ", ";
        }
        $string .= $vertex ." -> " . implode(',', $adjacents);
    }

    return $pretty ? $string : $list;
}

echo "ADJACENT LIST: " .adjacentList($edges) .PHP_EOL;

