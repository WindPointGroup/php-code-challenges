<?php

// example input
$root = [
    'value' => 4,
    'children' => [
        [
            'value' => 2,
            'children' => [
                ['value' => 1],
                ['value' => 3],
            ],
        ],
        [
            'value' => 6,
            'children' => [
                ['value' => 5],
                ['value' => 7],
            ],
        ],
    ],
];

// Helper function to visualize the visiting of a node.
function getValue($node){
    return isset($node['value']) ? $node['value'] : null;
}


function sumTree(array &$root)  {

    $childSum = 0;

    // Add any children to the queue.
    foreach ($root['children'] ?? [] as &$child) {
        $childSum +=  sumTree($child);
    }


    // stores the current value of the root node
    $old = getValue($root);

    // update root to the sum of left and right subtree
    $root['value'] =  $childSum;

    // the root node)
    return getValue($root) + $old;
}

// 28
echo "SUM-TREE: " .sumTree($root) .PHP_EOL;

