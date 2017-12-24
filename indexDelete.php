<?php

include __DIR__ . "./vendor/autoload.php";

use PostgreSQLTutorial\StockDB as StockDB;

try {
    $deleteDemo = new StockDB();
    // $deleteRows = $deleteDemo -> delete(4);
    // echo 'The number of row(s) deleted: ' . $deleteRows . '<br>';
    $deleteDemo -> deleteAll();
    echo "delete all record of stocks";
} catch (\PDOException $e) {
    echo $e -> getMessage();
}