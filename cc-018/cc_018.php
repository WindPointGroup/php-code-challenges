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


function bfsForCUWGraph($graph, $startVertex =0){

    $visited = [];
    $adj = adjacentListForCUWG($graph, false);
    $queue = [];

    $visited[$startVertex] = true;
    $queue[] = $startVertex;
    $weight = 0;

    echo "BFS DG STARTING AT " . $startVertex.PHP_EOL;

    $foundEnd = false;
    while (count($queue) != 0 && !$foundEnd){
        $s = array_shift($queue);
        echo $s ;

        $foundAdjacent = false;
        foreach($adj[$s] AS $adjacent){
            if(!isset($visited[$adjacent[0]]) || !$visited[$adjacent[0]]){
                $visited[$adjacent[0]] = true;
                $queue[] = $adjacent[0];
                $weight += (int) $adjacent[1];
                $foundAdjacent = true;
            }
            if($foundAdjacent){
                break;
            }
        }

        if(!$foundAdjacent){
            $foundEnd = true;
            echo PHP_EOL;
        }else{
            echo " -> ";
        }
    }
    return $weight;
}

echo "BFS CUWG: " .bfsForCUWGraph($connect_undirected_weighted_graph, 1) .PHP_EOL;
