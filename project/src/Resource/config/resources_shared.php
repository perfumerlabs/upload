<?php

return [
    'propel' => [
        'bin'           => 'vendor/bin/propel',
        'project'       => 'upload',
        'database'      => 'pgsql',
        'dsn' => 'pgsql:host=postgresql;port=5432;dbname=upload',
        'db_user' => 'postgres',
        'db_password' => 'postgres',
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
        'max_dimension' => '',
        'digest_length' => 10
    ]
];
