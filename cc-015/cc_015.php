<?php

// example input
$connect_undirected_graph = [[1,4], [4,2], [4,5], [2,5], [3,5]];

function adjacentListForCUG($graph, $pretty = true)  {

    $list = [];

    // iterate
    foreach ($graph ?? [] as $child) {
        if(!isset($list[$child[0]])){
            $list[$child[0]] = [];
        }
        $list[$child[0]][] = $child[1];

        if(!isset($list[$child[1]])){
            $list[$child[1]] = [];
        }
        $list[$child[1]][] = $child[0];
    }

    $string = '';
    foreach ($list as $vertex => $adjacents) {
        if(!empty($string)){
            $string .= ", ";
        }
        $string .= $vertex ." <-> " . implode(',', $adjacents);
    }

    return $pretty ? $string : $list;
}
echo "ADJACENT LIST CUG: " .adjacentListForCUG($connect_undirected_graph) .PHP_EOL;

