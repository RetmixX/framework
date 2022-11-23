<?php

return [
    'driver' => 'pgsql',
    'host' => 'postgres',
    'port'=>getenv("PORT_DB"),
    'database' => getenv("DB_NAME"),
    'username' => getenv("DB_USER"),
    'password' => getenv("DB_PASSWORD"),
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
];


