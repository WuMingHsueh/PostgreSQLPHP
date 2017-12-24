<?php

namespace PostgreSQLTutorial;

class PostgreSQLPHPUpdate {

    private $pdo;

    public function __construct($pdo)
    {
        $this -> pdo = $pdo;
    }

    public function updateStock($id , $symbol , $company)
    {
        $sql = 'update stocks 
                set company = :company,
                    symbol = :symbol
                where id = :id';
        $pdoStat = $this -> pdo -> prepare($sql);

        $pdoStat -> bindValue(':company' , $company);
        $pdoStat -> bindValue(':symbol' , $symbol);
        $pdoStat -> bindValue(':id' , $id);

        $pdoStat -> execute();

        return $pdoStat -> rowCount();
    }
}