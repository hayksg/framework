<?php

namespace Application\Components;

class DB
{
    const DB_CONFIG_PATH = ROOT . 'config/db_params.php';

    public static function getConnection()
    {
        $dbConfig = include(self::DB_CONFIG_PATH);

        $dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['name']}";
        $db = new \PDO($dsn, $dbConfig['user'], $dbConfig['pass']);

        return $db ?: false;
    }
}
