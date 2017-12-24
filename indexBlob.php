<?php

include __DIR__ . './vendor/autoload.php';

use PostgreSQLTutorial\BlobDB as BlobDB;

try {
    $blobDemo = new BlobDB();
    //$fileId = $blobDemo->insert(7, 'logo', 'image/jpg', 'assets/yahoo.jpg');
    $fileId = $blobDemo -> delete(4);
    echo 'A file has been inserted with id ' . $fileId;
} catch (\PDOException $e) {
    echo $e -> getMessage();
}

?>