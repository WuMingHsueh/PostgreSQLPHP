<?php

namespace PostgreSQLTutorial;

class StoreProcedure 
{
    private $pdo ;

    private function connect() {
        $parameter = parse_ini_file('database.ini');
        if ($parameter === false)
            throw new \Exception("Error reading database configuration file");
        
        $dsn = sprintf('pgsql:host=%s;port=%d;dbname=%s' , $parameter['host'] , $parameter['port'] , $parameter['database']);
        return new \PDO($dsn , $parameter['user'] , $parameter['password']);
    }

    public function __construct()
    {
        $this -> pdo = $this -> connect();
        $this -> pdo -> setAttribute(\PDO::ATTR_ERRMODE , \PDO::ERRMODE_EXCEPTION);
    }

    public function add($a , $b)
    {
        $sql = 'select * from add(:a , :b)';
        $pdoState = $this -> pdo -> prepare($sql);
        $pdoState -> setFetchMode (\PDO::FETCH_ASSOC);
        $pdoState -> execute( [':a' => $a  , ':b' => $b]);
        return $pdoState -> fetchColumn(0);
    }

    public function getAccounts()
    {
        $sql = 'select * from get_accounts()';
        $pdoState = $this -> pdo -> prepare($sql);
        $pdoState -> setFetchMode(\PDO::FETCH_ASSOC);
        $pdoState -> execute();
        return $pdoState -> fetchAll();
    }

}
