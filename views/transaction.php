<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cars</title>
    <link rel="stylesheet" href="<?= ASSETS_PATH ?>css/bootstrap.css">
    <link rel="stylesheet" href="<?= ASSETS_PATH ?>css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-12 my-2">
            <!--===================================================================-->
            <!----------------------------- cars table ------------------------------>
            <!--===================================================================-->
            <table class="table table-responsive-lg table-hover table-bordered table-borderless text-center">
                <!--=========================Table header===========================-->
                <!--    car_make,car_model,car_model_year,car_vin,credit_card,credit_card_type-->
                <thead class="table-success">
                <tr>
                    <td>car make</td>
                    <td>car model</td>
                    <td>car model year</td>
                    <td>car vin</td>
                    <td>price</td>
                </tr>
                </thead>
                <tbody>
                <?php if (!empty($transactions)) : ?>
                    <?php foreach ($transactions as $transaction) : ?>
                        <tr>
                            <td><?= $transaction['car_make'] ?></td>
                            <td><?= $transaction['car_model'] ?></td>
                            <td><?= $transaction['car_model_year'] ?></td>
                            <td><?= $transaction['car_vin'] ?> | <?= $transaction['credit_card_type'] ?></td>
                            <td>
                                <?php if ($transaction['price'] >= 0) : ?>
                                    <span class="text-success">
                                        <i class="fa-solid fa-arrow-up-long"></i>
                                        <?= $transaction['price'] ?>
                                    </span>
                                <?php elseif ($transaction['price'] <= 0) : ?>
                                    <span class="text-danger">
                                        <i class="fa-solid fa-arrow-down-long"></i>
                                        <?= $transaction['price'] ?>

                                    </span>
                                <?php else : ?>
                                    <span class="text-dark"><?= $transaction['price'] ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="4">totals income</td>
                    <td colspan="1"><?= $totals['totalsIncome'] ?? 0 ?></td>
                </tr>
                <tr>
                    <td colspan="4">totals expense</td>
                    <td colspan="1"><?= $totals['totalsExpense'] ?? 0 ?></td>
                </tr>
                <tr>
                    <td colspan="4">net totals</td>
                    <td colspan="1"><?= $totals['netTotals'] ?? 0 ?></td>
                </tr>
                </tfoot>
            </table>
            <!--===================================================================-->
            <!---------------------------- /cars table ------------------------------>
            <!--===================================================================-->
        </div>
    </div>
</div>
</body>
</html>