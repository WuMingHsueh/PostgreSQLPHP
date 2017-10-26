<?php

namespace PostgreSQLTutorial;

class Connection {
    private static $conn;

    public function connect() {
        $params = parse_ini_file('database.ini');
        if ($params === false)
            throw new \Exception("Error reading database configuration file");
        
        $dns = sprintf("pgsql:host=%s;port=%d;dbname=%s;",$params['host'] , $params['port'] , $params['database']);

        $pdo = new \PDO($dns , $params['user'] , $params['password']);
        $pdo -> setAttribute(\PDO::ATTR_ERRMODE , \PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }

    public static function get()
    {
        if (static::$conn === null)
            static::$conn = new static();
        return static::$conn;
    }

    public function __construct()
    {
        # code...
    }

    public function __clone()
    {
        # code...
    }

    public function __wakeup()
    {
        # code...
    }
}