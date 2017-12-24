<?php

namespace PostgreSQLTutorial;

class AccountDB
{
    private $pdo ;

    public function __construct()
    {
        $this -> pdo = (new Connection()) -> connect();
    }

    public function addAccount($firstName ,$lastName , $planId , $effectiveData)
    {
        try{
            $this -> pdo -> beginTransaction();
            
            $accountId =  $this -> insertAccount($firstName , $lastName);
            $this -> insertPlan($accountId ,$planId , $effectiveData);

            $this -> pdo -> commit();
        }catch(\PDOException $e) {
            $this -> pdo -> rollBack();
            throw $e;
        }
    }

    private function insertPlan($accountId ,$planId , $effectiveDate)
    {
        $sql = 'insert into account_plans (account_id , plan_id , effective_date)
                values (:account_id , :plan_id , :effective_date)';

        $pdoStat = $this -> pdo -> prepare($sql);
        $pdoStat -> execute(
            [':account_id' => $accountId ,
             ':plan_id' => $planId ,
             ':effective_date' => $effectiveDate]
        );
    }

    private function insertAccount($firstName , $lastName)
    {
        $sql = 'insert into accounts(first_name , last_name) 
                values (:first_name , :last_name) ';
        $pdoStat = $this -> pdo -> prepare($sql);

        $pdoStat -> execute(
            [':first_name' => $firstName , 
             ':last_name' => $lastName ]
        );
        return $this -> pdo -> lastInsertId('accounts_id_seq');
    }
}
