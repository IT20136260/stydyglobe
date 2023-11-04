<?php

session_start();
//connection
require_once('../connection.php');
if (isset($_SESSION["user"]) && isset($_GET["id"])) {

    $id = $_GET["id"];

    //date
    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d"); //reg dat

    $customer_rs = Database::search("SELECT * FROM studentdata WHERE id = '" . $id . "'");
    $customer_data = $customer_rs->fetch_assoc();

    //invoice data
    $pay_rs = Database::search("SELECT * FROM payment INNER JOIN paymenttype ON
    paymenttype.id = payment.paymenttype_id WHERE studentdata_id = '" . $id . "' ORDER BY payment.id ASC");

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

    <title>INVOICE </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    
        <link rel="shortcut icon" href="../img/logo.ico" type="image/x-icon">
        <style type="text/css">
            @page {
                size: auto;
                /* auto is the initial value */
                margin: 0
            }


            body {
                font-size: 14px;
            }

            .invoice-label {
                font-size: 30px;
                font-weight: bold;
                color: rgb(9, 124, 5);
            }

            .color-green {
                color: rgb(9, 124, 5);

            }

            .header-bg {
                background-color: rgb(31, 28, 71);
            }

            .bg-light-dark {
                background-color: rgb(212, 212, 212);
            }

            .watermark {
                position: fixed;
                opacity: 0.5;
                pointer-events: none;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 24px;
                z-index: 9999;
                background: url('../img//waterMark.png') center center no-repeat;
            }
        </style>
    </head>

    <body>

        <div class="container-fluid">
            <div class="row">

                <div class="watermark"></div>

                <div class="col-12 col-lg-8 offset-lg-2 ">
                    <div class="row">

                        <!-- header section -->
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 header-bg p-2 mb-3">
                                </div>
                                <div class="col-4">
                                    <img src="../src/img/logo.png" class="img-fluid">
                                </div>
                                <div class="col-8 text-end">
                                    <span>SN Asia Education Consultation,</span><br>
                                    <span>No: 404/B/1,</span><br>
                                    <span>Katugasthota Road,</span><br>
                                    <span>Kandy.</span><br>
                                </div>

                            </div>
                        </div>
                        <div class="col-12  invoice-label pb-1 mt-3 pt-1 border-top border-bottom">
                            INVOICE
                        </div>
                        <!-- header section -->
                        <!-- detail section -->
                        <div class="col-6 mt-3">
                            <span class=" fw-bold fs-5 ">Invoice To:</span><br>
                            <span><?php echo $customer_data["name"] ?>,</span><br>
                            <span><?php echo $customer_data["address"] ?></span><br>
                            <span class="fw-bold">Passport number : <?php echo $customer_data["passportnumber"] ?></span><br>

                        </div>

                        <div class="col-6 mt-3 text-end">
                            <div class="row">
                                <div class="col-12">
                                    <span class=" fw-bold fs-5 ">Invoice Details</span><br>
                                </div>
                                <div class="col-8 text-end fw-bold">
                                    <span>Invoice Date:</span><br>
                                </div>

                                <div class="col-4 text-end fw-bold text-black-50">
                                    <span><?php echo $date ?></span><br>
                                </div>
                            </div>
                        </div>
                        <!-- detail section -->

                        <!-- transaction section -->
                        <div class="col-12 my-5">
                            <div class="row">
                                <div class="col-12 fw-bold fs-5 color-green">Transactions</div>
                            </div>
                            <div class="col-12 mt-3 mb-5">
                                <table class="table">
                                    <thead>

                                        <tr class="text-center">
                                            <th>Invoice Number</th>
                                            <th>Date</th>
                                            <th>Method</th>
                                            <th>Transcation For</th>
                                            <th>Amount</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <!-- previous payments -->
                                        <tr class="bg-dark">
                                            <td colspan="5" class="text-center fw-bold ">Previous Transactions</td>
                                        </tr>

                                        <?php
                                        while ($pay_dataset = $pay_rs->fetch_assoc()) {
                                        ?>
                                            <tr>
                                                <td class="text-black"><?php echo $pay_dataset["uniqid"] ?></td>
                                                <td class="text-black"><?php echo $pay_dataset["date"] ?></td>
                                                <td class="text-black"><?php echo $pay_dataset["paymenttype"] ?></td>
                                                <td class="text-black"><?php echo $pay_dataset["discription"] ?></td>
                                                <td class="text-black text-end">Rs:<?php echo $pay_dataset["total"] ?>.00</td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                        <!-- previous payments -->

                                        <tr class="fs-3 ">
                                            <?php 
                                                $getSumTotal =  Database::search("SELECT SUM(total) AS sumTotal FROM payment WHERE studentdata_id = '".$id."'");
                                                $getSumTotal_data = $getSumTotal->fetch_assoc();
                                            ?>
                                            <td colspan="3" class=" text-end fw-bold">Total:</td>
                                            <td class=" text-end fw-bold ">Rs:<?php echo number_format($getSumTotal_data["sumTotal"]) ?>.00</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- transaction section -->

                    </div>
                </div>

                <div class="col-10 p-0 fixed-bottom offset-2">
                    <img src="../src/img/footer.png" class="img-fluid" alt="">
                </div>

            </div>
        </div>


        <script>
            window.onload(print());
        </script>

    </body>

    </html>
<?php
}

?>