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


function levelOrder(array $queue, array $output = [])
{
    // If the queue is empty, return the output.
    if (count($queue) === 0) {
        return implode(', ', $output);
    }

    // Take the first item from the queue and visit it.
    $node = array_shift($queue);
    $output[] = getValue($node);

    // Add any children to the queue.
    foreach ($node['children'] ?? [] as $child) {
        $queue[] = $child;
    }

    // Repeat the algorithm with the rest of the queue.
    return levelOrder($queue, $output);
}

// Put the root on the queue.
$queue = [$root];

// 4, 2, 6, 1, 3, 5, 7
echo "LEVEL-ORDER: " .levelOrder($queue) .PHP_EOL;

