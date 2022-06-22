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


function postOrder(array $root)
{
    // First we'll apply the algorithm on every child from left -> right.
    foreach ($root['children'] ?? [] as $child) {
        $output[] = postOrder($child);
    }

    // Then we visit the node itself.
    $output[] = getValue($root);

    return implode(', ', $output);
}

// 1, 3, 2, 5, 7, 6, 4
echo "POST-ORDER: " .postOrder($root) .PHP_EOL;
