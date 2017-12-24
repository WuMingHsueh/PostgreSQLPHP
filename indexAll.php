<?php
include __DIR__ . './vendor/autoload.php';

use PostgreSQLTutorial\StockDB;

try {
    $stockDemo = new StockDB();
    $stocks = $stockDemo -> all();
} catch (\PDOException $e) {
    echo $e -> getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PostgreSQL PHP Querying Data Demo</title>
    <link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">
</head>
<body>
    <div class="container">
        <h1>Stock List</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Symbol</th>
                    <th>Company</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($stocks as $stock) :?>
                    <tr>
                        <td><?= $stock['id']?></td>
                        <td><?= $stock['symbol']?></td>
                        <td><?= $stock['company']?></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</body>
</html>