<?php

include __DIR__ . '/vendor/autoload.php';

use PostgreSQLTutorial\Connection as Connection;
use PostgreSQLTutorial\PostgreSQLPHPInsert as PostgreSQLPHPInsert;


try {
    $insertDemo = new PostgreSQLPHPInsert( (new Connection()) -> connect() );

    $id = $insertDemo -> insertStock('MSFT' , 'Microsoft Corporation');
    echo 'The stock has been inserted with the id ' . $id . '<br>';

    $stockArray = [
        ['symbol' => 'GOOG', 'company' => 'Google Inc.'],
        ['symbol' => 'YHOO', 'company' => 'Yahoo! Inc.'],
        ['symbol' => 'FB', 'company' => 'Facebook, Inc.'],
    ];

    $list = $insertDemo -> insertStockList($stockArray);

    foreach ($list as $id) {
        echo 'The stock has been inserted with the id ' . $id . '<br>';
    }

} catch (\PDOException $e) {
    echo $e -> getMessage();
}