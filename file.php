<?php

include __DIR__ . './vendor/autoload.php';

use PostgreSQLTutorial\BlobDB as BlobDB;

$blobDB = new BlobDB();

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);


$file = $blobDB -> read($id);

