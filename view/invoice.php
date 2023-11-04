<?php
session_start();
//connection
require_once('../connection.php');
if (isset($_SESSION["user"]) && isset($_GET["id"])) {

    $id = $_GET["id"];

    $customer_rs = Database::search("SELECT * FROM studentdata WHERE id = '" . $id . "'");
    $customer_data = $customer_rs->fetch_assoc();

    //invoice data
    $pay_rs = Database::search("SELECT * FROM payment WHERE studentdata_id = '" . $id . "' ORDER BY id DESC LIMIT 1");
    $pay_data = $pay_rs->fetch_assoc();


?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <title>INVOICE </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    
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
                opacity: 0.8;
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
                background: url('../src/img//waterMark.png') center center no-repeat;
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
                                    <img src="../src/img/logo.png" class="img-fluid w-75">
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
                        </div>

                        <div class="col-6 mt-3 text-end">
                            <div class="row">
                                <div class="col-12">
                                    <span class=" fw-bold fs-5 ">Invoice Details</span><br>
                                </div>
                                <div class="col-8 text-end fw-bold">
                                    <span>Invoice Number:</span><br>
                                    <span>Invoice Date:</span><br>
                                </div>

                                <div class="col-4 text-end fw-bold text-black-50">
                                    <span><?php echo $pay_data["uniqid"] ?></span><br>
                                    <span><?php echo $pay_data["date"] ?></span><br>
                                </div>
                            </div>
                        </div>
                        <!-- detail section -->

                        <!-- bill tabel section -->
                        <div class="col-12 mt-4">
                            <table class="table">
                                <thead>
                                    <tr class=" header-bg text-light text-center">
                                        <th class="col-8 text-center">Description</th>
                                        <th class=" col-4 text-center">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="col-8 p-3 text-center"><?php echo $pay_data["discription"] ?></td>
                                        <td class="col-4 p-3 pe-0 fw-semibold border-start text-center "> Rs: <?php echo number_format($pay_data["amount"]) ?>.00</td>
                                    </tr>

                                    <?php

                                    if ($pay_data["discountpr"] == 0) {
                                    ?>
                                        <!-- total and discount -->
                                        <tr class=" border-0">
                                            <th class="text-end border-0 p-0 pt-1 fs-5"> Total:</th>
                                            <th class="text-end border-0 p-0 pt-1 fs-5"> Rs: <?php echo number_format($pay_data["amount"]) ?>.00</th>
                                        </tr>
                                        <!-- total and discount -->

                                    <?php
                                    } else {
                                    ?>
                                        <!-- total and discount -->
                                        <tr class=" border-0">
                                            <th class="text-end border-0 p-0 pt-1 fs-6"> Sub Total:</th>
                                            <th class="text-end border-0 p-0 pt-1 fs-6"> Rs: <?php echo number_format($pay_data["amount"]) ?>.00</th>
                                        </tr>
                                        <tr class=" border-0">
                                            <th class="text-end border-0 p-0 pt-1 fs-6"> Discount Precentage:</th>
                                            <th class="text-end border-0 p-0 pt-1 fs-6"><?php echo $pay_data["discountpr"] ?>%</th>
                                        </tr>
                                        <tr class=" border-0">
                                            <th class="text-end border-0 p-0 pt-1 fs-6"> Discount:</th>
                                            <th class="text-end border-0 p-0 pt-1 fs-6"> Rs:<?php echo number_format(($pay_data["amount"] * $pay_data["discountpr"] / 100)) ?>.00</th>
                                        </tr>
                                        <tr class=" border-0">
                                            <th class="text-end border-0 p-0 pt-1 fs-5"> Total:</th>
                                            <th class="text-end border-0 p-0 pt-1 fs-5">Rs: <?php echo number_format($pay_data["total"]) ?>.00</th>
                                        </tr>
                                        <!-- total and discount -->

                                    <?php
                                    }

                                    ?>

                                </tbody>
                            </table>
                        </div>
                        <!-- bill tabel section -->

                        <!-- transaction section -->
                        <div class="col-12 d-none">
                            <div class="row">
                                <div class="col-12 fw-bold fs-5 color-green">Transactions</div>
                            </div>
                            <div class="col-12 mt-3">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Transcation Date</th>
                                            <th>Payment Method</th>
                                            <th>Transcation For</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- previous payments -->
                                        <tr class="bg-light-dark">
                                            <td colspan="4" class="text-center fw-bold ">Previous Transactions</td>
                                        </tr>
                                        <tr>
                                            <td class=" text-black-50">25 Jun 2023</td>
                                            <td class=" text-black-50">Bank Deposit</td>
                                            <td class=" text-black-50">Advanced Paymnet</td>
                                            <td class=" text-black-50 text-end">Rs:5000.00</td>
                                        </tr>
                                        <!-- previous payments -->
                                        <!-- Current payments -->
                                        <tr>
                                            <td> 25 Jun 2023</td>
                                            <td> Cash Payment </td>
                                            <td> Visa Payment </td>
                                            <td class=" text-end"> Rs:20000.00 </td>
                                        </tr>
                                        <!-- Current payments -->

                                        <tr>
                                            <td colspan="3" class=" text-end fw-bold">Total:</td>
                                            <td class=" text-end fw-bold">Rs:25000.00</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- transaction section -->


                        <div class="col-12 mt-4 text-center text-black">
                            If the visa is rejected, 50% of the payment will be returned. If the student says they cannot go after being approved, they will not refund. And the other points of the agreement are relevant.
                        </div>

                        <!-- sign section -->
                        <div class="col-12 mt-5 pt-5 mb-5">
                            <div class="row">
                                <div class="col-3">
                                    <div class="col-12 border-bottom p-2"></div>
                                    <div class="col-12 text-center mt-2">Applicant</div>
                                </div>

                                <div class="col-3  offset-6">
                                    <div class="col-12 border-bottom p-2"></div>
                                    <div class="col-12 text-center mt-2">SN Asia Education Consultation</div>
                                </div>
                            </div>
                        </div>
                        <!-- sign section -->



                    </div>
                </div>

                <div class="col-10 p-0 fixed-bottom offset-2">
                    <img src="../src/img/footer.png" class="img-fluid" alt="">
                </div>

            </div>
        </div>


        <script>
           function redirectToStudentPage() {
                window.location.href = './studentProfile.php';
            }
            window.addEventListener('afterprint', redirectToStudentPage);
            window.onload = print;
        </script>

    </body>

    </html>
<?php

} else {
    header('Location: ./index.php');
    exit();
}
?>