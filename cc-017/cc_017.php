<?php

// example input
$connect_undirected_weighted_graph = [[1,4,1], [4,2,3], [4,5,2], [2,5,1], [3,5,1]];

function adjacentListForCUWG($graph, $pretty = true)  {

    $list = [];

    // iterate
    foreach ($graph ?? [] as $child) {
        if(!isset($list[$child[0]])){
            $list[$child[0]] = [];
        }
        $list[$child[0]][] = [$child[1], $child[2]];

        if(!isset($list[$child[1]])){
            $list[$child[1]] = [];
        }
        $list[$child[1]][] = [$child[0], $child[2]];
    }

    $string = '';
    foreach ($list as $vertex => $adjacents) {
        if(!empty($string)){
            $string .= ", ";
        }
        $string .= $vertex ." <-> " ;
        foreach ($adjacents as $adjacent) {
            $string .= $adjacent[0] ." (" . $adjacent[1]."), ";
        }
    }

    return $pretty ? $string : $list;
}
echo "ADJACENT LIST CUWG: " .adjacentListForCUWG($connect_undirected_weighted_graph) .PHP_EOL;
