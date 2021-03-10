<?php

return [
    'propel' => [
        'bin'           => 'vendor/bin/propel',
        'project'       => 'upload',
        'database'      => 'pgsql',
        'dsn'           => 'pgsql:host=PG_HOST;port=PG_PORT;dbname=PG_DATABASE',
        'db_schema'     => 'PG_SCHEMA',
        'db_user'       => 'PG_USER',
        'db_password'   => 'PG_PASSWORD',
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
        'auth' => '',
        'auth_salt' => '',
    ],

    'file' => [
        'max_size' => '',
        'max_dimension' => '',
        'digest_length' => 10
    ]
];
