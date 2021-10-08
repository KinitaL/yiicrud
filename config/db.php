<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => ('pgsql:host=postgre;port=5432;dbname='.env('POSTGRES_DB')),
    'username' => env('POSTGRES_USER'),
    'password' => env('POSTGRES_PASSWORD'),
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
