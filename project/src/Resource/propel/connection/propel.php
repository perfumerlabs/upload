<?php

return [
    'propel' => [
        'database' => [
            'connections' => [
                'upload' => [
                    'adapter' => 'pgsql',
                    'dsn' => 'pgsql:host=postgresql;port=5432;dbname=upload',
                    'user' => 'postgres',
                    'password' => 'postgres',
                    'settings' => [
                        'charset' => 'utf8',
                        'queries' => [
                            'utf8' => "SET NAMES 'UTF8'"
                        ]
                    ],
                    'attributes' => []
                ]
            ]
        ],
        'runtime' => [
            'defaultConnection' => 'upload',
            'connections' => ['upload']
        ],
        'generator' => [
            'defaultConnection' => 'upload',
            'connections' => ['upload']
        ]
    ]
];
