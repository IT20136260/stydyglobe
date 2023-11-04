<?php
session_start();

if (isset($_SESSION["user"]) && isset($_GET["id"])) {
    $title = "DashBoard";
    require('./header.php');

    $id =  $_GET["id"];

    //load student data
    $get_studentData_rs = Database::search("SELECT * FROM `studentdata` INNER JOIN gender ON
    studentdata.gender_id =  gender.id INNER JOIN country ON 
    studentdata.country_id = country.id INNER JOIN university ON
    studentdata.university_id =  university.id INNER JOIN program ON
    studentdata.program_id =  program.id INNER JOIN `level` ON
    studentdata.level_id  = level.id INNER JOIN mode ON 
    studentdata.mode_id = mode.id
    WHERE studentdata.id='" . $id . "' ");
    $get_studentData_data = $get_studentData_rs->fetch_assoc();

    //load document
    $get_document_rs = Database::search("SELECT * FROM `studentdata_has_document` INNER JOIN document ON 
    studentdata_has_document.document_id = document.id
     WHERE studentdata_id='" . $id . "' ");
    $get_document_num = $get_document_rs->num_rows;


?>

    <style>
        .pdf-container {
            height: 50vh;
            overflow-y: auto;
        }

        .pdf-iframe {
            border: none;
            width: 100%;
            height: 100%;
        }
    </style>

    <div class="d-flex flex-row justify-content-between align-items-center">
        <h1 class="fw-bold fs-2 m-3 text-center"> Student Profile </h1>
    </div>


    <div class="row">
        <div class="d-flex flex-column flex-lg-row align-items-start my-3">
            <div class="row">

                <!-- student images -->
                <div class="col-12 col-md-5">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center mx-auto text-center mb-4">
                            <img src="../document/img/<?php echo $get_studentData_data["imagepath"] ?>" class="bg-transparent img-thumbnail border-0 w-75" id="img-update-0">
                        </div>
                    </div>
                </div>

                <!-- student data form -->
                <div class="col-12 col-md-7 d-flex flex-column">
                    <div>
                        <h3 class="fw-bold">Personal Details</h3>
                    </div>

                    <!-- form -->
                    <div class="d-flex flex-column">

                        <!-- name -->
                        <div class="row">
                            <div class="col-5 col-md-3"><label for="">Frist Name</label></div>
                            <div class="col-7 col-md-9 text-secondary">: <?php echo $get_studentData_data["name"] ?></div>
                        </div>

                        <!-- email -->
                        <div class="row">
                            <div class="col-5 col-md-3">
                                <label for="">Email</label>
                            </div>
                            <div class="col-7 col-md-9 text-secondary">
                                : <?php echo $get_studentData_data["email"] ?>
                            </div>
                        </div>

                        <!-- nic/passport -->
                        <div class="row">
                            <div class="col-5 col-md-3">
                                <label for="">NIC Number</label>
                            </div>
                            <div class="col-7 col-md-9 text-secondary">
                                : <?php echo $get_studentData_data["nic"] ?>
                            </div>
                        </div>

                        <!-- passport number -->
                        <div class="row">
                            <div class="col-5 col-md-3">
                                <label for="">Passport Number</label>
                            </div>
                            <div class="col-7 col-md-9 text-secondary">
                                : <?php echo $get_studentData_data["passportnumber"] ?>
                            </div>
                        </div>

                        <!-- passport expire date -->
                        <div class="row">
                            <div class="col-5 col-md-3">
                                <label for="">Passport expire date</label>
                            </div>
                            <div class="col-7 col-md-9 text-secondary">
                                : <?php echo $get_studentData_data["passport_exday"] ?>
                            </div>
                        </div>
                        <!-- gender select -->
                        <div class="row">
                            <div class="col-5 col-md-3">
                                <label for="">Gender</label>
                            </div>
                            <div class="col-7 col-md-9 text-secondary">
                                : <?php echo $get_studentData_data["gender"] ?>
                            </div>
                        </div>

                        <!-- contact number -->
                        <div class="row">
                            <div class="col-5 col-md-3">
                                <label for="">Contact Number 1</label>
                            </div>
                            <div class="col-7 col-md-9 text-secondary">
                                : <?php echo $get_studentData_data["student_contact"] ?>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="row">
                            <div class="col-5 col-md-3">
                                <label for="">Address</label>
                            </div>
                            <div class="col-7 col-md-9 text-secondary">
                                : <?php echo $get_studentData_data["address"] ?>
                            </div>
                        </div>
                        <!-- Extra information -->
                        <div class="row">
                            <div class="col-5 col-md-3">
                                <label for="">Extra Information</label>
                            </div>
                            <div class="col-7 col-md-9 text-secondary">
                                 : <?php echo $get_studentData_data["einformation"] ?>
                            </div>
                        </div>

                        <div class="row mt-5 mb-2">
                            <h3 class="fw-bold">Abroad Details</h3>
                        </div>

                        <!-- country/university select -->
                        <div class="row">
                            <div class="col-5 col-md-3">
                                <label for="">Contry</label>
                            </div>
                            <div class="col-7 col-md-9 text-secondary">
                                : <?php echo $get_studentData_data["country"] ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-5 col-md-3">
                                <label for="">university</label>
                            </div>
                            <div class="col-7 col-md-9 text-secondary">
                                : <?php echo $get_studentData_data["university"] ?>
                            </div>
                        </div>

                        <!-- Degree program -->
                        <div class="row">
                            <div class="col-5 col-md-3">
                                <label for="">Preferred program</label>
                            </div>
                            <div class="col-7 col-md-9 text-secondary">
                                : <?php echo $get_studentData_data["program"] ?>
                            </div>
                        </div>

                        <!-- level/mode select -->
                        <div class="row">
                            <div class="col-5 col-md-3">
                                <label for="">Preferred level</label>
                            </div>
                            <div class="col-7 col-md-9 text-secondary">
                                : <?php echo $get_studentData_data["level"] ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-5 col-md-3">
                                <label for="">Mode</label>
                            </div>
                            <div class="col-7 col-md-9 text-secondary">
                                : <?php echo $get_studentData_data["mode"] ?>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                if ($get_document_num > 0) {
                ?>
                    <div class="row col-12 my-5 d-flex text-center">
                        <div class="pdf-container">
                            <?php
                            for ($i = 0; $i < $get_document_num; $i++) {
                                $get_document_data = $get_document_rs->fetch_assoc();
                            ?>
                                <iframe src="../document/doc/<?php echo $get_document_data["path"]; ?>" frameborder="0" class="m-1 border border-0 h-100"></iframe>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                <?php
                }
                ?>

                <div class="row col-12 d-flex flex-column flex-md-row my-3">
                    <div class="row ">

                        <!-- inputs -->
                        <div class="col-12 col-md-4 d-flex flex-column">
                            <div class="mt-5 mb-2">
                                <h3 class="fw-bold">Payment Details</h3>
                            </div>

                            <!-- Amount -->
                            <div class="d-flex flex-column w-100 my-1">
                                <label for="">Amount<span class="text-danger ms-1 fw-bold">*</span></label>
                                <input type="text" class="rounded-pill form-control py-2" id="paymentAmount" oninput="setTotal(this)">
                            </div>

                            <!-- discount -->
                            <div class="d-flex flex-column w-100 my-1">
                                <label for="">discount(%)</label>
                                <input type="text" value="0" class="rounded-pill form-control py-2" id="paymentDiscount" oninput="setDiscount(this)">
                            </div>

                            <!-- Total -->
                            <div class="d-flex flex-column w-100 my-1">
                                <label for="">Total</label>
                                <input type="text" disabled class="rounded-pill form-control py-2" id="paymentTotal">
                            </div>

                            <!-- detail -->
                            <div class="d-flex flex-column w-100 my-1">
                                <label for="">Description<span class="text-danger ms-1 fw-bold">*</span></label>
                                <textarea cols="30" rows="2" class="rounded form-control py-2" id="paymentDescription"></textarea>
                            </div>

                            <!-- payment method -->
                            <div class="d-flex flex-column w-100 my-3">
                                <label for="">payment Method<span class="text-danger ms-1 fw-bold">*</span></label>
                                <select class="form-select rounded-pill text-center" id="paymentType">
                                    <option value="" selected disabled>---Select payment Method---</option>
                                    <?php
                                    $set_paymettype_rs = Database::search("SELECT * FROM paymenttype");
                                    while ($set_paymettype_data = $set_paymettype_rs->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $set_paymettype_data["id"] ?>"><?php echo $set_paymettype_data["paymenttype"] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>



                            <div class="row mt-3">
                                <div class="d-flex col-12 flex-row justify-content-center align-items-center mx-auto align-items-center">

                                    <div class="col-4 ">
                                        <p>Select <span id="paymentProofCount">0</span> files</p>
                                    </div>

                                    <div class="col-6 ">
                                        <input type="file" class="d-none" accept=".jpg, .jpeg, .png , .pdf" id="paymentProof">
                                        <label for="paymentProof" class=" btn btn-dark col-12 rounded" onclick="paymentProofimage()">Add Proof</label>
                                    </div>

                                </div>

                                <div class="col-12 mt-3 mx-auto d-flex flex-row">
                                    <button class="btn btn-sm rounded-pill btn-dark w-100 px-3 py-2" onclick="paymentInvoice(<?php echo $id ?>)">Invoice</button>
                                </div>
                            </div>
                        </div>

                        <!-- table -->
                        <div class="col-12 col-md-8 ">
                            <div class="col-12 mx-auto p-2 ">
                                <div class="row ">
                                    <div class="col-12 d-flex flex-row bg-dark text-white  mt-5 py-3 text-center rounded-top">
                                        <div class="col-6">
                                            <h3>Total</h3>
                                        </div>
                                        <div class="col-6">
                                            <?php
                                            $getSumTotal =  Database::search("SELECT SUM(total) AS sumTotal FROM payment WHERE studentdata_id = '" . $id . "'");
                                            $getSumTotal_data = $getSumTotal->fetch_assoc();
                                            ?>
                                            <h3>RS: <?php echo number_format($getSumTotal_data["sumTotal"]) ?></h3>
                                        </div>
                                    </div>
                                    <div class="col-12 rounded-bottom overflow-auto" style="height: 80vh; overflow: scroll;">
                                        <table class="table overflow-auto">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th scope="col">date</th>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Amount</th>
                                                    <th scope="col">Discount</th>
                                                    <th scope="col">Total</th>
                                                    <th scope="col">Description</th>
                                                    <th scope="col">proof</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $getInvoiceData_rs = Database::search("SELECT * FROM payment INNER JOIN paymenttype ON payment.paymenttype_id = paymenttype.id WHERE studentdata_id = '" . $id . "' ORDER BY payment.id ASC");
                                                $getInvoiceData_num = $getInvoiceData_rs->num_rows;

                                                for ($i = 0; $i < $getInvoiceData_num; $i++) {
                                                    $getInvoiceData_data = $getInvoiceData_rs->fetch_assoc();
                                                ?>
                                                    <td><?php echo $getInvoiceData_data["date"] ?></td>
                                                    <td><?php echo $getInvoiceData_data["paymenttype"] ?></td>
                                                    <td><?php echo $getInvoiceData_data["amount"] ?></td>
                                                    <td><?php echo ($getInvoiceData_data["amount"] * $getInvoiceData_data["discountpr"] / 100) . " (" . $getInvoiceData_data["discountpr"] . "%)" ?></td>
                                                    <td><?php echo $getInvoiceData_data["total"] ?></td>
                                                    <td><?php echo $getInvoiceData_data["discription"] ?></td>
                                                    <td>
                                                        <?php
                                                        $filePath = $getInvoiceData_data["path"];
                                                        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);

                                                        if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif'])) {
                                                            echo '<a href="../document/payinvoice/' . $filePath . '"" data-toggle="modal" data-target="#imageModal">
                                                                    <img class="w-75" src="../document/payinvoice/' . $filePath . '" alt="">
                                                                 </a>';
                                                        } elseif (strtolower($fileExtension) === 'pdf') {
                                                            echo '<a href="../document/payinvoice/' . $filePath . '" target="_blank">View PDF</a>';
                                                        } else {
                                                            echo 'File type not supported';
                                                        }
                                                        ?>
                                                    </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>

                                        <button class="btn btn-dark float-end" onclick="printStudentInvoice(<?php echo $id ?>)">print invoice</button>
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>


<?php
    require('./footer.php');
} else {
    header('Location: ./dashboard.php');
    exit();
}
?>