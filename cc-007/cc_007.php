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

function preOrder(array $root){

    // First we visit the node itself
    $output[] = getValue($root);

    // Then apply the algorithm to every child from left -> right
    foreach ($root['children'] ?? [] as $child) {
        $output[] = preOrder($child);
    }

    return implode(', ', $output);
}

// 4, 2, 1, 3, 6, 5, 7
echo "PRE-ORDER: " .preOrder($root) .PHP_EOL;
