<?php
declare(strict_types=1);

require '../vendor/autoload.php';

use JetBrains\PhpStorm\ArrayShape;

/**
 * @param string $dir_path
 * @return array
 */
function getTransactionFiles(string $dir_path): array
{
    $files = [];

    foreach (scandir($dir_path) as $file) {
        if (is_dir($file)) {
            continue;
        }
        $files[] = $dir_path . $file;

        return $files;
    }
}

/**
 * @param string $file_name
 * @param callable|null $transactionHandler
 * @return array
 */
function getTransaction(string $file_name, ?callable $transactionHandler = null): array
{
    if (!file_exists($file_name)) {
        trigger_error('File dose not exists :: name file :' . $file_name . E_USER_ERROR);
    }

    $file = fopen($file_name, 'r');
    fgetcsv($file);
    $transactions = [];

    while (($transaction = fgetcsv($file)) !== false) {
        if ($transactionHandler !== null) {
            $transactions[] = $transactionHandler($transaction);
        }
        $transactions[] = extractTransaction($transaction);
    }
    return $transactions;

}

/**
 * @param array $transaction_row
 * @return array
 */
#[ArrayShape([
    'car_make' => "mixed",
    'car_model' => "mixed",
    'car_model_year' => "mixed",
    'car_vin' => "mixed",
    'price' => "float",
    'credit_card_type' => "mixed"
])]
function extractTransaction(array $transaction_row): array
{
    [$car_make, $car_model, $car_model_year, $car_vin, $price, $credit_card_type] = $transaction_row;
    $price = (float)str_replace(['$', ','], '', $price);
    return [
        'car_make' => $car_make,
        'car_model' => $car_model,
        'car_model_year' => $car_model_year,
        'car_vin' => $car_vin,
        'price' => $price,
        'credit_card_type' => $credit_card_type,
    ];
}

/**
 * @param array $transactions
 * @return int[]
 */
#[ArrayShape([
    'netTotals' => "int|mixed",
    'totalsIncome' => "int|mixed",
    'totalsExpense' => "int|mixed"
])]
function calculateTotals(array $transactions): array
{
    $totals = [
        'netTotals' => 0,
        'totalsIncome' => 0,
        'totalsExpense' => 0
    ];
    foreach ($transactions as $transaction) {
        $totals['netTotals'] += $transaction['price'];
        if ($transaction['price'] >= 0) {
            $totals['totalsIncome'] += $transaction['price'];
        } else {
            $totals['totalsExpense'] += $transaction['price'];
        }
    }
    return $totals;
}