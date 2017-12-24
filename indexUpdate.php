<?php

include __DIR__ . './vendor/autoload.php';

use PostgreSQLTutorial\Connection as Connection;
use PostgreSQLTutorial\PostgreSQLPHPUpdate as PostgreSQLPHPUpdate;

try {
    $updateDemo = new PostgreSQLPHPUpdate( (new Connection()) -> connect() ); 

    $affectedRows = $updateDemo -> updateStock(2, 'GOOGL', 'Alphabet Inc.');

    echo 'Number of row affected ' . $affectedRows;
} catch (\PDOException $e) {
    echo $e -> getMessage();
}