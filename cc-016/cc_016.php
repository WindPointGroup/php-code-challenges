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

function runDFS($startVertex, &$visited, $adjacentList){

    $visited[$startVertex] = 1;

    foreach($adjacentList AS $vertex => $adjacents){
        if(in_array($vertex, $adjacentList[$startVertex]) && !isset($visited[$vertex])){
            echo $startVertex." -> " . $vertex.PHP_EOL;
            echo " <- ".runDFS($vertex, $visited, $adjacentList);
        }
    }
    $visited[$startVertex] = 2;
    return $startVertex;
}

function dfsForUndirectedGraph($graph, $startVertex =0){

    $visited = [];
    $adj = adjacentListForCUG($graph, false);

    echo " <- ".runDFS($startVertex, $visited, $adj);
}

echo dfsForUndirectedGraph($connect_undirected_graph, 1) .PHP_EOL;
