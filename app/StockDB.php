<?php

namespace PostgreSQLTutorial;

class StockDB {

    private $pdo;

    private function connect() {
        $parsem = parse_ini_file('database.ini');
        if ($parsem === false)
            throw new \Exception("Error reading database configuration file");

        $dns = sprintf("pgsql:host=%s;port=%d;dbname=%s",$parsem['host'] , $parsem['port'] , $parsem['database']);

        $this -> pdo = new \PDO($dns , $parsem['user'] , $parsem['password']);
        $this -> pdo -> setAttribute(\PDO::ATTR_ERRMODE , \PDO::ERRMODE_EXCEPTION);
    }

    public function __construct()
    {
        $this -> connect();
    }

    public function all()
    {
        $sql = 'select id , symbol , company
                from stocks 
                order by symbol';
        $pdoStat = $this -> pdo -> query($sql);
        
        return $pdoStat -> fetchAll();
    }

    public function findByPK($id)
    {
        $sql = "select id , symbol ,company
                from stocks
                where id = :id";
        $pdoStat = $this -> pdo -> prepare($sql);
        $pdoStat -> bindValue(':id' , $id);
        $pdoStat -> execute();

        return $pdoStat -> fetchObject();
    }

    public function delete($id)
    {
        $sql = 'delete from stocks where id = :id ';
        $pdoState = $this -> pdo -> prepare($sql);
        $pdoState -> bindValue(':id' , $id);
        $pdoState -> execute();

        return $pdoState -> rowCount();
    }

    public function deleteAll()
    {
        $sql = 'delete from stocks ;';
        $pdoState = $this -> pdo -> prepare($sql);
        $pdoState -> execute();
        return $pdoState -> rowCount();
    }
}