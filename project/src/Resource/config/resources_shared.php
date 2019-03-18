<?php

return [
    '_domains' => [
        [
            'domain' => 'upload',
            'bundle' => 'upload',
        ],
    ],

    'propel' => [
        'bin'           => 'vendor/bin/propel',
        'project'       => 'upload',
        'database'      => 'pgsql',
        'dsn'           => 'pgsql:host=localhost;port=5432;dbname=upload',
        'db_user'       => 'postgres',
        'db_password'   => 'postgres',
        'platform'      => 'pgsql',
        'config_dir'    => 'src/Resource/propel/connection',
        'schema_dir'    => 'src/Resource/propel/schema',
        'model_dir'     => 'src/Model',
        'migration_dir' => 'src/Resource/propel/migration',
    ],

    'host' => [
        'upload' => 'http://upload',
        'port' => 80,
    ],

    'server'      => [
        'digest' => '',
    ],

    'file' => [
        'max_size' => '',
        'digest_length' => 10
    ]
];
