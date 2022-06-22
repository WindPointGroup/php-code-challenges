<?php

// example input
$graph = [[0, 1], [0, 2], [1, 2], [2, 0], [2, 3], [3, 3]];


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


function bfsForDirectedGraph($graph, $startVertex =0){

    $visited = [];
    $adj = adjacentList($graph, false);
    $queue = [];

    $visited[$startVertex] = true;
    $queue[] = $startVertex;

    while (count($queue) != 0){
        $s = array_shift($queue);
        echo $s ;


        foreach($adj[$s] AS $adjacent){
            if(!isset($visited[$adjacent]) || !$visited[$adjacent]){
                $visited[$adjacent] = true;
                $queue[] = $adjacent;
            }
        }

        echo (count($queue) > 0 ? " -> " : "");
    }
    echo PHP_EOL;
}

bfsForDirectedGraph($graph, 2);

