<?php
include __DIR__ . './vendor/autoload.php';

use PostgreSQLTutorial\StoreProcedure as StoreProcedure;

try {
    $storeProDemo = new StoreProcedure();

    //echo $storeProDemo -> add(77 ,88);
    $Data =  $storeProDemo->getAccounts();
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
    <title>PostgreSQL PHP : calling stored prcedure demo</title>
    <link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">
</head>
<body>
    <div class="container">
        <h1>Account List</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Plan</th>
                    <th>Effective Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($Data as $rowData) :?>
                <tr>
                    <td><?= $rowData['id'] ;?></td>
                    <td><?= $rowData['firstname'] ;?></td>
                    <td><?= $rowData['lastname'] ;?></td>
                    <td><?= $rowData['plan'] ;?></td>
                    <td><?= $rowData['effectivedate'] ;?></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</body>
</html>