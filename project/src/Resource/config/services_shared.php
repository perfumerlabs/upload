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
    ],

    'gateway' => [
        'shared' => true,
        'class' => 'Upload\\Gateway',
        'arguments' => ['#application', '#gateway.http', '#gateway.console']
    ],

    'propel.connection_manager' => [
        'class' => 'Propel\\Runtime\\Connection\\ConnectionManagerSingle',
        'after' => function(\Perfumer\Component\Container\Container $container, \Propel\Runtime\Connection\ConnectionManagerSingle $connection_manager) {
            $configuration = [
                'dsn' => $container->getParam('propel/dsn'),
                'user' => $container->getParam('propel/db_user'),
                'password' => $container->getParam('propel/db_password'),
                'settings' => [
                    'charset' => 'utf8',
                ]
            ];

            $schema = $container->getParam('propel/db_schema');

            if ($schema !== 'public' && $schema !== null) {
                $configuration['settings']['queries'] = [
                    'schema' => "SET search_path TO " . $schema
                ];
            }

            $connection_manager->setConfiguration($configuration);
        }
    ],
];