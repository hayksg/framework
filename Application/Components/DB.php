<?php

namespace Application\Components;

class DB
{
    const DB_CONFIG_PATH = ROOT . 'config/db_params.php';
    public static $className;

    public static function setClassName($class)
    {
        self::$className = $class;
    }

    public static function getConnection()
    {
        $dbConfig = include(self::DB_CONFIG_PATH);

        try {
            $dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['name']}";
            $db = new \PDO($dsn, $dbConfig['user'], $dbConfig['pass']);
            $db->setAttribute(\PDO::ATTR_EMULATE_PREPARES, TRUE);
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            echo 'Database error';
            exit;
        }


        return $db ?: false;
    }

    public static function persist($sql, $params)
    {
        $db = DB::getConnection();

        $stmt = $db->prepare($sql);
        return $stmt->execute($params) ?: false;
    }
}
