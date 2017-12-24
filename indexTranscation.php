<?php

include __DIR__ . './vendor/autoload.php';

use PostgreSQLTutorial\AccountDB as AccountDB;

try {
    $transcationDemo = new AccountDB();

    $transcationDemo -> addAccount('John' , 'Doe' , 1 , date('Y-m-d'));
    $transcationDemo -> addAccount('Linda' , 'Williams' , 2 , date('Y-m-d'));
    $transcationDemo -> addAccount('Maria' , 'Miller' , 3 , date('Y-m-d'));

    echo "The new accounts have been added . <br>";

    $transcationDemo -> addAccount('Susan', 'Wilson', 99, date('Y-m-d'));

} catch (\PDOExcetion $e) {
    echo $e -> getMessage();
}