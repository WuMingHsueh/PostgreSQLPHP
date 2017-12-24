<?php
require __DIR__ . './vendor/autoload.php';

use Monolog\Logger ;
use Monolog\Handler\StreamHandler;

$log = new Logger('name');
$log->pushHandler(new StreamHandler('./wuminghsueh.log' , Logger::WARNING) );

$log->warning('foo');
$log->error('Bar');