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


function inOrder(array $root)
{
    // We extract a possible left and right node for clarity.
    $left = $root['children'][0] ?? null;
    $right = $root['children'][1] ?? null;

    // We'll apply the algorithm on the left node first.
    if ($left) {
        $output[] = inOrder($left);
    }

    // Now we visit the node itself.
    $output[] = getValue($root);

    // And apply the algorithm on the right node.
    if ($right) {
        $output[] = inOrder($right);
    }

    return implode(', ', $output);
}

// 1,2,3,4,5,6,7
echo "IN-ORDER: " .inOrder($root) .PHP_EOL;
