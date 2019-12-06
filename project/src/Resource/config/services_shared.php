<?php

return [
    'imagick' => [
        'class' => 'Imagine\\Imagick\\Imagine'
    ],

    'picture' => [
        'class' => 'Upload\\Service\\Picture',
        'arguments' => ['#imagick', '@file/max_dimension']
    ],

    'view.status' => [
        'class' => 'Upload\\Service\\View\\StatusView',
        'arguments' => ['@host/upload', '@host/port', '@server/digest']
    ]
];