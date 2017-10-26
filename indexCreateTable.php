<?php

include __DIR__ . '/vendor/autoload.php';

use PostgreSQLTutorial\Connection as Connection;
use PostgreSQLTutorial\PostgreSQLCreateTable as PostgreSQLCreateTable;

try {
    $tableCreator = new PostgreSQLCreateTable( (new Connection) -> connect() );

    $tables = $tableCreator -> createTables() -> getTables();

    foreach ($tables as $table) {
        echo $table . '<br>';
    }


} 
catch (\PDOException $e)
{
    echo $e->getMessage();
}