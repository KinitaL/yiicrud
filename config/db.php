<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=postgre;port=5432;dbname=news',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
