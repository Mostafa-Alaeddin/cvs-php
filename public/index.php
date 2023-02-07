<?php

declare(strict_types=1);

$assets = 'http://csv.local' . DIRECTORY_SEPARATOR;
$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILE_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);

define('PROJECT_DIRECTORY', $root);

define('ASSETS_PATH', $assets . 'assets' . DIRECTORY_SEPARATOR);

require APP_PATH . "App.php";

$files = getTransactionFiles(FILE_PATH);

$transactions = [];

foreach ($files as $file) {
    $transactions = array_merge($transactions, getTransaction($file, 'extractTransaction'));
}

$totals = calculateTotals($transactions);



require VIEWS_PATH . 'transaction.php';



