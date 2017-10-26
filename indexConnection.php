<?php

include 'vendor/autoload.php';

use PostgreSQLTutorial\Connection as Connection;
use PostgreSQLTutorial\PostgreSQLCreateTable as PostgreSQLCreateTable;

try {
    //Connection::get() -> connect();
    $provider = new Connection();
    $provider->connect();
    echo 'A connection to the Postgresql database server has been establish successfully.';
} catch (\PDOException $e) {
    echo $e->getMessage();
}