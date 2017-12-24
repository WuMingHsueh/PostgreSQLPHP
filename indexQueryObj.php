<?php

include __DIR__ . './vendor/autoload.php';

use PostgreSQLTutorial\StockDB ;

try {
    $stockDemo = new StockDB();

    $stock = $stockDemo -> findByPK(1);

    var_dump($stock);

} catch (\PDOException $e) {
    echo $e -> getMessage();
}
