<?php

namespace PostgreSQLTutorial;

class PostgreSQLPHPInsert {
    
    private $pdo;

    public function __construct($pdo)
    {
        $this -> pdo = $pdo;
    }

    public function insertStockList($stocks)
    {
        $sql = 'insert into stocks(symbol,company) values (:symbol , :company)';

        $pdoStat = $this -> pdo -> prepare ($sql);

        $idList = [];
        foreach ($stocks as $stock) {
            $pdoStat -> bindValue(':symbol' , $stock['symbol']);
            $pdoStat -> bindValue(':company' , $stock['company']);
            $pdoStat -> execute();
            $idList[] = $this -> pdo -> lastInsertId('stocks_id_seq');
        }
        return $idList;
    }

    public function insertStock($symbol , $company)
    {
        $sql = 'insert into stocks(symbol,company) values (:symbol , :company)';
        $pdoStat = $this -> pdo -> prepare ($sql);

        $pdoStat -> bindValue(':symbol' , $symbol);
        $pdoStat -> bindValue(':company' , $company);
        $pdoStat -> execute();

        return $this->pdo->lastInsertId('stocks_id_seq');
    }

}